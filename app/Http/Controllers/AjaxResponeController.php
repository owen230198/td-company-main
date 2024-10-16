<?php
namespace App\Http\Controllers;

use App\Models\COrder;
use App\Models\Order;
use App\Models\ProductHistory;
use App\Models\ProductWarehouse;
use App\Models\Represent;
use App\Models\SupplyBuying;
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

    public function insertSupplyPayment($request)
    {
        if (\GroupUser::isAdmin() || \GroupUser::isAccounting()) {
            if (!$request->isMethod('POST')) {
                $data['title'] = 'Thêm Phiếu Thanh toán tiền vật tư ';
                $data['action_url'] = url('ajax-respone/insertSupplyPayment');
                $data['check_readonly'] = 1;
                $data['nosidebar'] = $request->input('nosidebar');
                if (!empty($request->input('provider'))) {
                    $dataItem['provider'] = $request->input('provider');
                }
                $dataItem['note'] = 'Thanh toán tiền vật tư';
                $data['fields'] = [
                    [
                        'name' => 'provider',
                        'note' => 'Nhà cung cấp',
                        'type' => 'linking',
                        'other_data' => ['config' => ['search' => 1], 'data'=> ['table' => 'warehouse_providers']],
                        'value' => @$request->input('provider')
                    ],
                    [
                        'name' => 'advance',
                        'type' => 'text',
                        'note' => 'Số tiền thanh toán',
                        'attr' => ['type_input' => 'price']
                    ],
                    [
                        'name' => 'bill',
                        'note' => 'Phiếu chuyển tiền',
                        'type' => 'filev2',
                        'table_map' => 'supply_buyings',
                        'other_data' => ['role_update' => [\GroupUser::ADMIN, \GroupUser::ACCOUNTING], 'field_name' => 'bill']
                    ],
                    [
                        'name' => 'note',
                        'type' => 'textarea',
                        'note' => 'Ghi chú',
                    ],
                ];
                return view('supply_buyings.payment', $data);
            }else{
                $data = $request->except('_token');
                if (empty($data['provider'])) {
                    return returnMessageAjax(100, 'Bạn chưa chọn nhà cung cấp cần thanh toán !');
                }
                if (empty($data['bill'])) {
                    return returnMessageAjax(100, 'Bạn chưa upload phiếu chuyển tiền !');
                }
                $data['payment_type'] = 1;
                $data['status'] = \StatusConst::SUBMITED;
                $data['name'] = 'Thanh toán công nợ - NCC : '.getFieldDataById('name', 'warehouse_providers', $data['provider']);
                (new \BaseService())->configBaseDataAction($data);
                $id = SupplyBuying::insertGetId($data);
                if ($id) {
                    SupplyBuying::where('id', $id)->update(['code' => 'CT-'.formatCodeInsert($id)]);
                    return returnMessageAjax(200, 'Thêm dữ liệu thành công!', \StatusConst::CLOSE_POPUP);
                }else {
                    return returnMessageAjax(100, 'Lỗi không xác định !');
                }
            }
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền xác nhận thanh toán !');
        }  
    }

    public function productMoveWarehouse($request)
    {
        $is_post = !$request->isMethod('GET');
        if (\GroupUser::isAdmin() || \GroupUser::isAccounting()) {
            $id = @$request->input('id') ?? 0;
            $product = ProductWarehouse::find($id);
            if (empty($product)) {
                return customReturnMessage(false, $is_post, ['Message' => 'Dữ liệu thành phẩm không tồn tại, hoặc đã bị xóa !']);
            }
            if (!$is_post) {
                $data['title'] = 'Chuyển kho thành phẩm '.$product->name;
                $data['action_url'] = url('ajax-respone/productMoveWarehouse');
                $data['nosidebar'] = 1;
                $data['fields'] = [
                    [
                        'name' => 'id',
                        'note' => 'Thành phẩm',
                        'type' => 'linking',
                        'other_data' => ['config' => ['search' => 1], 'data'=> ['table' => 'product_warehouses']],
                        'attr' => ['readonly' => 1],
                        'value' => $id
                    ],
                    [
                        'name' => 'qty',
                        'note' => 'Số lượng chuyển kho',
                        'type' => 'text',
                        'attr' => ['type_input' => 'number'],
                        'value' => $product->qty
                    ],
                    [
                        'name' => 'warehouse_type',
                        'note' => 'Kho vật tư',
                        'type' => 'linking',
                        'other_data' => [
                            'config' => ['search' => 1], 
                            'data'=> [
                                'table' => 'supply_extends',
                                'where' => ['type' => 'warehouse_type']
                            ]
                        ],
                        'value' => $product->warehouse_type
                    ],
                    [
                        'name' => 'note',
                        'note' => 'Ghi chú',
                        'type' => 'textarea',
                        'value' => 'Chuyển kho thành phẩm'
                    ],
                    [
                        'name' => 'receipt',
                        'note' => 'Phiếu chuyển kho',
                        'type' => 'filev2',
                        'other_data' => ['role_update' => [\GroupUser::ACCOUNTING]] 
                    ]
                ];
                return view('product_warehouses.move_warehouse', $data);
            }else{
                $data = $request->except('_token');
                $qty = (int) @$data['qty'];
                $product_qty = (int) @$product->qty;
                if (empty($qty) || $qty > $product_qty) {
                    return returnMessageAjax(100, 'Số lượng nhập kho không hợp lệ !');    
                }
                if (empty($data['warehouse_type'])) {
                    return returnMessageAjax(100, 'Bạn chưa chọn kho vật tư chuyển đến !');
                }
                $warehouse_type = $data['warehouse_type'];
                if ($warehouse_type == @$product->warehouse_type) {
                    return returnMessageAjax(100, 'Vui lòng chọn kho khác để chuyển đến !');
                }
                //Lấy hàng từ kho cũ
                $product->qty -= $qty;
                $export = $product->save();
                if (!$export) {
                    return returnMessageAjax(100, 'Đã có lỗi khi lấy hàng chuyển kho, vui lòng thử lại !');
                }
                $arr_log = ['receipt' => @$data['receipt'], 'note' => @$data['note']];
                ProductHistory::doLogWarehouse($id, 0, $qty, $product_qty, 0, $arr_log);
                //Đưa hàng vào kho mới
                $arr_keys = ['name', 'category', 'style', 'length', 'width', 'height', 'unit', 'made_by', 'produce_price', 'add_on', 'price'];
                foreach ($arr_keys as $key_name) {
                    $where[$key_name] = $product->{$key_name};
                }
                $where['warehouse_type'] = $warehouse_type;
                $exist_data = ProductWarehouse::where($where)->first();
                if (!empty($exist_data->id)) {
                    $exist_data->qty += $qty;
                    $import = $exist_data->save();
                    if ($import) {
                        $log_imp_id = @$exist_data->id;
                        $ex_inventory = (int) @$exist_data->qty;
                    }
                }else{
                    $data_insert = $where;
                    $data_insert['qty'] = $qty;
                    (new \BaseService())->configBaseDataAction($data_insert);
                    $log_imp_id = ProductWarehouse::insertGetId($data_insert);
                    $ex_inventory = 0;
                }
                if (!empty($log_imp_id)) {
                    ProductHistory::doLogWarehouse($log_imp_id, $qty, 0, $ex_inventory, 0, $arr_log);
                    return returnMessageAjax(200, 'Đã chuyển kho thành công !', \StatusConst::CLOSE_POPUP);
                }else{
                    return returnMessageAjax(100, 'Đã có lỗi xảy ra khi chuyển kho, vui lòng thử lại !');
                }
            }
        }else{
            return customReturnMessage(false, $is_post, ['Message' => 'Bạn không có quyền chuyển kho !']);
        }
    }
}

