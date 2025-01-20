<?php
namespace App\Http\Controllers;

use App\Models\BaseReceipt;
use App\Models\COrder;
use App\Models\MoveWarehouse;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\ProductWarehouse;
use App\Models\ProviderPrice;
use App\Models\Represent;
use App\Models\SupplyBuying;
use App\Models\SupplyPrice;
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
        $warehouse_type = $request->input('warehouse_type');
        if (empty($action) || empty($warehouse_type)){
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
                'note' => 'Thành phẩm cập nhật SL',
                'type' => 'linking',
                'other_data' => [
                    'config' => ['search' => 1, 
                    'except_linking' => 1], 
                    'data' => [
                        'table' => 'product_warehouses',
                        'where' => !empty($warehouse_type) ? ['warehouse_type' => $warehouse_type] : []
                    ]
                ],
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
        if (!empty($where['order'])) {
            $data['dataItem']['order'] = $where['order'];
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
        $data = $request->all();
        if (!empty($data['json'])) {
            $data['other_data'] = json_decode($data['json'], true);
        }
        return view($request->view_return.'.json_item', $data);
    }

    public function getPriceProductWarehouse($request)
    {
        $product_id = @$request->input('id') ?? 0;
        $product = ProductWarehouse::find($product_id);
        if (empty($product)) {
            return returnMessageAjax(100, 'Sản phẩm trong kho không tồn tại hoặc đã bị xóa !');
        }
        return !empty($request->input('check_qty')) ? true : ['price' => $product->price, 'name' => $product->name];
    }

    public function getAdvanceOrder($request)
    {
        $id = @$request->input('id') ?? 0;
        $order = Order::find($id);
        return !empty($order->advance) ? $order->advance : 0;    
    }

    public function confirmTakeSelling($request)
    {
        $id = @$request->input('id') ?? 0;
        $c_order = COrder::find($id);
        $warehouse_type = @$c_order->warehouse_type;
        if (\GroupUser::isAdmin() || 
        (\GroupUser::isAccounting() && $warehouse_type == COrder::WH_OFFICE) ||
        (\GroupUser::isProductWarehouse() && $warehouse_type == COrder::WH_FACTORY)) {
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
            $c_order->confirm_warehouse = \User::getCurrent('id');
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

    public function validateMoveWarehouse($product, $data)
    {
        $product_name = $product->name;
        if (empty($data['id'])) {
            return returnMessageAjax(100, 'Bạn chưa chọn sản phẩm để chuyển kho !');
        }
        if (empty($data['qty']) || (int) $data['qty'] > (int) @$product->qty) {
            return returnMessageAjax(100, 'Số lượng chuyển kho sản phẩm '.$product_name.' không hợp lệ !');    
        }
        if (empty($data['warehouse_to'])) {
            return returnMessageAjax(100, 'Bạn chưa chọn kho chuyển đến cho sản phẩm '.$product_name.' !');
        }
        $warehouse_to = $data['warehouse_to'];
        if ($warehouse_to == @$product->warehouse_type) {
            return returnMessageAjax(100, 'Vui lòng chọn kho khác cho sản phẩm '.$product_name.' để chuyển đến !');
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
                $fields = ProductWarehouse::getFieldMove($product);
                $data['fields'] = $fields['fields'];
                $data['fields'][] = $fields['receipt'];
                return view('product_warehouses.move_warehouse', $data);
            }else{
                $data = $request->except('_token');
                $validate = $this->validateMoveWarehouse($product, $data);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $receipt_id = BaseReceipt::insertWithHardData('', @$data['receipt']);
                $process = $this->processMoveWarehouse($product, $data, $receipt_id);
                if ($process) {
                    return returnMessageAjax(200, 'Đã chuyển kho thành công !', \StatusConst::CLOSE_POPUP);
                }else{
                    return returnMessageAjax(100, 'Đã có lỗi xảy ra khi chuyển kho, vui lòng thử lại !');
                }
            }
        }else{
            return customReturnMessage(false, $is_post, ['Message' => 'Bạn không có quyền chuyển kho !']);
        }
    }

    private function processMoveWarehouse($product, $data, $parent)
    {
        //Lấy hàng từ kho cũ
        $id = $data['id'];
        $qty = (int) $data['qty'];
        $product_qty = (int) $product->qty;
        $product->qty -= $qty;
        $product->save();
        $arr_log = ['receipt' => @$data['receipt'], 'note' => @$data['note']];
        ProductHistory::doLogWarehouse($id, 0, $qty, $product_qty, 0, $arr_log);
        //Đưa hàng vào kho mới
        $arr_keys = ['name', 'type', 'category', 'style', 'length', 'width', 'height', 'unit', 'made_by', 'produce_price', 'add_on', 'price'];
        foreach ($arr_keys as $key_name) {
            $where[$key_name] = $product->{$key_name};
        }
        $warehouse_to = $data['warehouse_to'];
        $where['warehouse_type'] = $warehouse_to;
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
            ProductWarehouse::getInsertCode($log_imp_id);
            $ex_inventory = 0;
        }
        ProductHistory::doLogWarehouse($log_imp_id, $qty, 0, $ex_inventory, 0, $arr_log);
        MoveWarehouse::doLogAction($product, $qty, $warehouse_to, $parent, @$data['note']);
        return true;
    }

    public function multipleProductMoveWarehouse($request)
    {
        $is_post = $request->isMethod('POST');
        if (!(\GroupUser::isAdmin() || \GroupUser::isAccounting())) {
            return customReturnMessage(false, $is_post, 'Bạn không có quyền chuyển kho !');
        }
        $data['title'] = 'Chuyển kho thành phẩm';
        $data['nosidebar'] = 1;
        $data['action_url'] = 'ajax-respone/multipleProductMoveWarehouse';
        $fields = ProductWarehouse::getFieldMove();
        $data['fields'] = $fields['fields'];
        $data['receipt_field'] = $fields['receipt'];
        $data['receipt_code'] = [
            'name' => 'receipt_code',
            'note' => 'Mã phiếu',
            'type' => 'text',
        ];
        if (!$is_post) {
            return view('product_warehouses.move_multiples.view', $data);
        }else{
            $data = $request->except('_token');
            if (empty($data['move_warehouse'])) {
                return returnMessageAjax(100, 'Vui lòng thêm 1 sản phẩm để chuyển kho !');
            }
            $move_warehouses = $data['move_warehouse'];
            $hard_receipt_code = $data['receipt_code'];
            $hard_receipt_file = $data['receipt'];
            $check_douplicate = [];
            foreach ($move_warehouses as $key => $move_warehouse) {
                $num = $key + 1;
                if (empty($move_warehouse['id'])) {
                    return returnMessageAjax(100, 'Bạn chưa chọn sản phẩm cho phiếu '.$num.' để chuyển kho !');
                }
                $product_id = $move_warehouse['id'];
                $product = ProductWarehouse::find($product_id);
                if (in_array($product_id, $check_douplicate)) {
                    return returnMessageAjax(100, 'Sản phẩm '.$product->name.' đã được chọn trước đó !');
                }
                $check_douplicate[] = $product_id;
                if (empty($product)) {
                    return returnMessageAjax(100, 'Sản phẩm của phiếu '.$num.' không tồn tại hoặc đã bị xóa !');
                }
                if (!empty($duplicateIds)) {
                    return returnMessageAjax(100, 'Sản phẩm của phiếu '.$num.' không tồn tại hoặc đã bị xóa !');
                }
                $validate = $this->validateMoveWarehouse($product, $move_warehouse);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $move_warehouses[$key]['product'] = $product;
                $move_warehouses[$key]['receipt'] = $hard_receipt_file;
                $move_warehouses[$key]['receipt_code'] = $hard_receipt_code;
            }
            $receipt_id = BaseReceipt::insertWithHardData($hard_receipt_code, $hard_receipt_file);
            foreach ($move_warehouses as $move_warehouse) {
                $process = $this->processMoveWarehouse($move_warehouse['product'], $move_warehouse, $receipt_id);
            }
            if (!empty($process)) {
                return returnMessageAjax(200, 'Đã chuyển kho thành công', \StatusConst::CLOSE_POPUP);
            }else{
                return returnMessageAjax(100, 'Đã có lỗi xảy ra, vui lòng thử lại !', \StatusConst::CLOSE_POPUP);
            }
        }
    }

    public function getDataProductMoveWarehouse($request)
    {
        $id = $request->id;
        $product = ProductWarehouse::find($id); 
        if (empty($product)) {
            return ['code' => 100, 'warehouse_type' => '', 'warehouse_label' => '', 'qty' => 0, 'note' => ''];
        }else{
            return ['code' => 200, 'warehouse_type' => $product->warehouse_type, 'warehouse_label' => getFieldDataById('name', 'supply_extends', $product->warehouse_type), 'qty' => $product->qty, 'note' => 'Chuyển kho '.$product->name];
        }
    }

    public function AjaxFieldSellByWarehouseType($request)
    {
        if (empty($request->input('id')) || $request->input('index') == '') {
            return '';
        }
        $data = ['index' => $request->input('index'), 'value' => ['warehouse_type' => $request->input('id')]];
        return view('product_warehouses.filed_json_item', $data);
    }

    public function insertItemChildLinking($request)
    {
        $data = $request->all();
        $data['dataItem'] = $data;
        return view('view_update.child_linkings.item', $data);     
    }

    public function getViewQtvByTarget($request)
    {
        if (empty($request->supp_type) || empty($request->target)) {
            return '';
        }
        $data['value']['target'] = $request->target;
        $data['supp_type'] = $request->supp_type;
        $data['index'] = $request->index;
        return view('supply_buyings.field_qtv', $data);
    }

    public function getViewQtvByMateral($request)
    {
        if (empty($request->materal)) {
            return '';
        }
        $data = $request->all();
        $data['materal'] = $request->materal;
        return view('quotes.products.field_qtv', $data);
    }
    public function getProviderSuggestBuying($request)
    {
        if (empty($request->supply_price)) {
            return [];
        }
        $provider_price = ProviderPrice::where(['supp_price' => $request->supply_price])->orderBy('price', 'asc')->first();
        if (!empty($provider_price)) {
            return [
                'price_purchase' => getFieldDataById('price_purchase', 'supply_prices', $request->supply_price),
                'id' => $provider_price->id, 
                'label' => ProviderPrice::getLabelLinking($provider_price), 
                'price' => $provider_price->price
            ];
        }else{
            return [];
        }
    }

    public function getPriceProviderById($request)
    {
        if (empty($request->id)) {
            return [];
        }
        $provider_price = ProviderPrice::find($request->id);
        if (!empty($provider_price)) {
            return ['price_purchase' => $provider_price->price];
        }else{
            return [];
        }
    }
}

