<?php
namespace App\Http\Controllers;

use App\Models\COrder;
use App\Models\Order;
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
               'other_data' => ['data' => ['options' => ['' => 'Chọn ĐVT', 'combo' => 'Bộ', 'box' => 'Hộp', 'sheet' => 'Tờ', 'unit' => 'Chiếc']]]
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
        if (empty($type)) {
            return '';
        }
        $where = $request->all();
        $data['fields'] = COrder::getFieldAjaxByType($type, $where);
        if (empty($data['fields'])) {
            return '';
        }
        return view('c_orders.view_types.ajax', $data);
    }

    public function checkRepreSentPermission($request)
    {
        $represent = $request->input('represent');
        $ret_true = ['code' => 200];
        if (empty($represent)) {
            return $ret_true;
        }
        if (\GroupUser::isAdmin() || \GroupUser::isAccounting()) {
            return $ret_true;
        }
        $represent = Represent::find($represent);
        $arr_sale = !empty($represent->sale) ? json_decode($represent->sale, true) : array();
        $cur_user = \User::getCurrent('id');
        $code = in_array($cur_user, $arr_sale) || $cur_user == $represent->created_by  ? 200 : 100;
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
        if (\GroupUser::isAdmin() || \GroupUser::isAccounting()) {
            $id = @$request->input('id') ?? 0;
            $c_order = COrder::find($id);
            if (@$c_order->status != \StatusConst::NOT_ACCEPTED) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
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
                ProductWarehouse::takeOut($obj, $product, $id, $receipt);  
            }
            $c_order->receipt = $receipt;
            $c_order->status = \StatusConst::ACCEPTED;
            $c_order->save();
            return returnMessageAjax(200, 'Đã xác nhận xuất kho thành công!', getBackUrl());
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền xác nhận xuất kho !');
        }
    }

    public function confirmPaymentSelling($request)
    {
        if (\GroupUser::isAdmin() || \GroupUser::isAccounting()) {
            $id = @$request->input('id') ?? 0;
            $c_order = COrder::find($id);
            if (!in_array(@$c_order->type, COrder::TYPE_PAYMENT) && @$c_order->rest > 0) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !', \StatusConst::CLOSE_POPUP);
            }
            $is_post = $request->isMethod('POST');
            $c_controller = new \App\Http\Controllers\COrder\COrderController();
            if (!$is_post) {
                $data = $c_controller->getDataView('insert');
                $data['title'] = $c_order->name.' Thanh toán tiền hàng ';
                $data['action_url'] = url('insert/c_orders');
                $data['check_readonly'] = 1;
                $data['nosidebar'] = $request->input('nosidebar');
                $c_order->type = COrder::PAYMENT;
                $c_order->advance = $c_order->rest;
                $c_order->note = 'Thanh toán công nợ cho phiếu '.$c_order->code.' của ngày '.getDateTimeFormat($c_order->created_at);
                $c_order->status = '';
                $data['dataItem'] = $c_order;
                return view('c_orders.view', $data);
            }
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền xác nhận thanh toán !');
        }
    }
}

