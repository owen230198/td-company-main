<?php
    namespace App\Http\Controllers\CExpertise;
    use App\Http\Controllers\Controller;
    use App\Models\CExpertise;
    use App\Models\Order;
    use App\Models\Product;
    use Illuminate\Http\Request;
    class CExpertiseController extends Controller
    {
        function __construct()
        {
            parent::__construct();      
        }

        public function confirmProductWarehouse(Request $request, $id)
        {
            if (!$request->isMethod('POST')) {
                return returnMessageAjax(100, 'Yêu cầu không hợp lệ !');
            }
            if (\GroupUser::isAdmin() || \GroupUser::isProductWarehouse()) {
                $data_expertise = CExpertise::find($id);
                if (@$data_expertise->status != \StatusConst::NOT_ACCEPTED) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                //update product quantity
                $product_id = $data_expertise->product;
                $product_obj = Product::find($product_id);
                if (empty($product_obj)) {
                    return returnMessageAjax(100, 'Sản phẩm không tồn tại hoặc đã bị xóa !');
                }
                $qty = (int) $data_expertise->qty;
                $product_qty = (int) $product_obj->warehouse_qty;
                $product_obj->warehouse_qty = (int) $product_qty + $qty;
                $product_obj->status = \StatusConst::LAST_SUBMITED;
                $product_obj->save();
                if (checkUpdateOrderStatus($product_obj->order, \StatusConst::LAST_SUBMITED)) {
                    Order::where('id', $product_obj->order)->update(['status' => \StatusConst::LAST_SUBMITED]);
                }
                //update expertise
                $data_expertise->qty = 0;
                $data_expertise->status = \StatusConst::ACCEPTED;
                $data_expertise->save();
                //log 
                $data_log['action'] = 'import';
                $data_log['qty'] = $qty;
                $data_log['old_qty'] = $product_qty;
                $data_log['new_qty'] = Product::find($product_id)->qty;
                $data_log['product'] = $product_id;
                (new \BaseService)->configBaseDataAction($data_log);
                $log = \DB::table('product_histories')->insert($data_log);
                if ($log) {
                    return returnMessageAjax(200, 'Đã nhập kho thành phẩm '.$qty.' sản phẩm'.$product_obj->name, \StatusConst::RELOAD);
                }
            }else{
                return returnMessageAjax(100, 'Bạn không có quyền thực hiện thao tác này !');
            }    
        }
    }
?>