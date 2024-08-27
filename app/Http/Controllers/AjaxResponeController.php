<?php
namespace App\Http\Controllers;

use App\Models\COrder;
use App\Models\Order;
use App\Models\ProductHistory;
use App\Models\ProductWarehouse;
use App\Models\Represent;
use Illuminate\Http\Request;

class AjaxResponeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $method)
    {
        if(!$method){
            return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
        }else{
            return $this->$method($request);
        }
    }

    public function ajaxFieldImportProductByAction($request)
    {
        $action = $request->input('action');
        if (empty($action)){
            return '';
        }
        if ($action == 'insert') {
            $field = [
               'name' => 'warehouse[unit]',
               'note' => 'ĐVT',
               'type' => 'select',
               'other_data' => ['data' => ['options' => ['' => 'Chọn ĐVT', 'combo' => 'Bộ', 'box' => 'Hộp', 'unit' => 'Chiếc']]]
            ];
        }else{
            $field = [
                'name' => 'data[target]',
                'note' => 'Đối tượng cập nhật',
                'type' => 'linking',
                'other_data' => ['config' => ['search' => 1, 'except_linking' => 1], 'data' => ['table' => 'product_warehouses']],
            ];
        }
        return view('view_update.view', $field);
    }

    public function ajaxFieldCOrderByType($request){
        $type = $request->input('type');
        if ($type != COrder::ORDER){
            return '';
        }
        $data = $request->all();
        $field = COrder::getFieldOrdered($data);
        return view('view_update.view', $field);
    }

    public function checkRepreSentPermission($request)
    {
        $represent = $request->input('represent');
        $ret_true = ['code' => 200];
        if (empty($represent)) {
            return $ret_true;
        }
        if (\GroupUser::isAdmin()) {
            return $ret_true;
        }
        $represent = Represent::find($represent);
        $arr_sale = !empty($represent->sale) ? json_decode($represent->sale, true) : array();
        $code = in_array(\User::getCurrent('id'), $arr_sale) ? 200 : 100;
        return ['code' => $code];
    }

    public function returnItemJson(Request $request)
    {
        return view($request->table.'.json_item', $request->all());
    }

    public function getPriceProductWarehouse($request)
    {
        $product_id = @$request->input('id') ?? 0;
        $product = ProductWarehouse::find($product_id);
        if (empty($product)) {
            return returnMessageAjax(100, 'Sản phẩm trong kho không tồn tại hoặc đã bị xóa !');
        }
        $rqty = $request->input('qty');
        if ((int) @$product->qty < $rqty) {
            return returnMessageAjax(100, 'Sản phẩm trong kho không đủ để xuất !');
        }
        return !empty($request->input('check_qty')) ? true : $product->price;
    }

    public function getAdvanceOrder($request)
    {
        $id = @$request->input('id') ?? 0;
        $order = Order::find($id);
        return !empty($order->advance) ? $order->advance : 0;    
    }

    public function confirmTakeSelling($request)
    {
        if (\GroupUser::isAdmin() || \GroupUser::isProductWarehouse()) {
            $id = @$request->input('id') ?? 0;
            $c_order = COrder::find($id);
            if (@$c_order->status != \StatusConst::NOT_ACCEPTED) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
            }
            if (empty($request->input('receipt'))) {
                return returnMessageAjax(100, 'Bạn chưa upload phiếu xuất kho !');
            }
            $arr_products = !empty($c_order->object) ? json_decode($c_order->object, true) : [];
            if (empty($arr_products)) {
                return returnMessageAjax(100, 'Dữ liệu thành phẩm trống !');
            }
            foreach ($arr_products as $key => $object) {
                $temp_name = 'mặt hàng '.$key + 1;
                $validate = COrder::validateArrObject($object, $temp_name);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $arr_products[$key]['obj'] = $validate;
            }
            $receipt = $request->input('receipt');
            foreach ($arr_products as $product) {
                $obj = $product['obj'];
                $inventory = (int) $obj->qty;
                $ex_qty = (int) $product['qty'];
                $new_qty = $inventory - $ex_qty;
                $product_id = $product['id'];
                ProductWarehouse::where('id', $product_id)->update(['qty' => $new_qty]);
                $arr_log = ['c_order' => $id, 'receipt' => $receipt, 'price' => $product['price']];
                ProductHistory::doLogWarehouse($product_id, 0, $ex_qty, $inventory, 0, $arr_log);  
            }
            $c_order->receipt = $receipt;
            $c_order->status = \StatusConst::ACCEPTED;
            $c_order->save();
            return returnMessageAjax(200, 'Đã xác nhận xuất kho thành công!', getBackUrl());
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền xác nhận xuất kho !');
        }
        
    }
}

