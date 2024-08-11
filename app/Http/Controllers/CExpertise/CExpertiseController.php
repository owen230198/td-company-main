<?php
    namespace App\Http\Controllers\CExpertise;
    use App\Http\Controllers\Controller;
    use App\Models\CExpertise;
    use App\Models\Product;
    use App\Models\ProductWarehouse;
    use Illuminate\Http\Request;
    class CExpertiseController extends Controller
    {
        function __construct()
        {
            parent::__construct();      
        }

        public function update($request, $id)
        {
            $table = 'c_expertises';
            $param = $request->all();
            $dataItem = getModelByTable($table)->find($id);
            if (!$request->isMethod('POST')) {
                $data = $this->admins->getDataActionView($table, 'update', 'Nhập kho thành phẩm', $param);
                $data['title'] = 'Nhập kho thành phẩm: '.@$dataItem['name'];
                $data['action_url'] = url('update/'.$table.'/'.$id);
                $data['field_logs'] = [];
                $data['dataItem'] = $dataItem;
                return view('warehouses.actions.view', $data);   
            }else{
                
                
            }
        }
        public function confirmProductWarehouse(Request $request, $id)
        {
            return returnMessageAjax(100, 'Chức năng đang phát triển !');
            if (!$request->isMethod('POST')) {
                return returnMessageAjax(100, 'Yêu cầu không hợp lệ !');
            }
            if (\GroupUser::isAdmin() || \GroupUser::isProductWarehouse()) {
                $data_expertise = CExpertise::find($id);
                if (@$data_expertise->status != \StatusConst::NOT_ACCEPTED) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                //insert product warehouse
                $product_id = $data_expertise->product;
                $product_obj = Product::find($product_id);
                if (empty($product_obj)) {
                    return returnMessageAjax(100, 'Sản phẩm không tồn tại hoặc đã bị xóa !');
                }
                $qty = (int) $data_expertise->qty;
                $data_insert['code'] = 'SP-'.getCodeInsertTable('product_warehouses');
                $data_insert['name'] = $product_obj->name;
                $data_insert['qty'] = $qty;
                $data_insert['category'] = $product_obj->category;
                $data_insert['product_style'] = $product_obj->product_style;
                $data_insert['length'] = $product_obj->length;
                $data_insert['width'] = $product_obj->width;
                $data_insert['height'] = $product_obj->height;
                $data_insert['price'] = (int) $product_obj->total_amount / (int) $product_obj->qty;
                $data_insert['specification'] = $product_obj->id;
                $data_insert['expertise_id'] = $id;
                (new \BaseService)->configBaseDataAction($data_insert);
                $pro_warehouse_id = ProductWarehouse::insertGetId($data_insert);

                //update status product
                $product_obj->status = \StatusConst::LAST_SUBMITED;
                $product_obj->save();

                //update expertise
                $data_expertise->qty = 0;
                $data_expertise->status = \StatusConst::ACCEPTED;
                $data_expertise->save();

                //log 
                $data_log['action'] = 'import';
                $data_log['qty'] = $qty;
                $data_log['old_qty'] = 0;
                $data_log['new_qty'] = $qty;
                $data_log['product'] = $pro_warehouse_id;
                (new \BaseService)->configBaseDataAction($data_log);
                $log = \DB::table('product_histories')->insert($data_log);
                if ($log) {
                    return returnMessageAjax(200, 'Đã nhập kho thành phẩm '.$qty.' sản phẩm'.$product_obj->name, \StatusConst::RELOAD);
                }
            }else{
                return returnMessageAjax(100, 'Bạn không có quyền thực hiện thao tác này !');
            }    
        }

        public function productWarehouseHistory($product_id)
        {
            $pro_warehouse = ProductWarehouse::find($product_id);
            if (empty($pro_warehouse)) {
                return false;
            }
            $data['title'] = 'Lịch sử xuất nhập sản phẩm '.$pro_warehouse->name;
            $data['nosidebar'] = true;
            $data['list_data'] = \DB::table('product_histories')->where('product', $product_id)->get();
            return view('products.history', $data); 
        }
    }
?>