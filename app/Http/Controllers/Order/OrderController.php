<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use App\Models\CSupply;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Quote;
use App\Models\SupplyWarehouse;
use App\Models\Product;

class OrderController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\OrderService;
        $this->quote_services = new \App\Services\QuoteService;
    }

    public function insertByQuote($request)
    {
        $quote_id = $request->input('quote');
        $arr_quote = Quote::find($quote_id);
        if (!$request->isMethod('POST')) {
            if (empty($arr_quote) || @$arr_quote['status'] == \StatusConst::NOT_ACCEPTED) {
                return back()->with('error', 'Dữ liệu báo giá không hợp lệ!');
            }
            if ($arr_quote['status'] == Quote::ORDER_CREATED) {
                return back()->with('error', 'Bạn đã tạo đơn hàng cho báo giá này rồi !');
            }
            $data = $this->services->getBaseDataAction();
            $data['order_cost'] = @$arr_quote['total_amount'];
            $data['products'] = Product::where(['act' => 1, 'quote_id' => $quote_id])->get();
            $data['product_qty'] = count($data['products']);
            $data['order_type'] = \OrderConst::INCLUDE;
            $data['title'] = 'Thêm đơn hàng - Mã báo giá : '.$arr_quote['seri'];
            $data['link_action'] = url('insert/orders?quote='.$quote_id);
            return view('orders.view', $data);
        }else{
            if (!empty($request['order']['status'])) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
            }
            return $this->services->processDataOrder($request, $arr_quote); 
        } 
    }

    public function insert(Request $request)
    {
        if (!empty($request->input('quote'))) {
            return $this->insertByQuote($request);
        }else{
            return $this->services->processDataOrder($request); 
        }  
    }

    public function update(Request $request, $id){
        $arr_order = Order::find($id);
        $arr_quote = Quote::find($arr_order['quote']);
        if (!$request->isMethod('POST')) {
            if (empty($arr_order)) {
                return back()->with('error', 'Dữ liệu Đơn hàng không hợp lệ!');
            }
            $data = $this->services->getBaseDataAction();
            $data['order_cost'] = @$arr_order['total_amount'];
            $data['products'] = Product::where(['act' => 1, 'order' => $id])->get();
            $data['product_qty'] = count($data['products']);
            $data['data_order'] = $arr_order;
            $data['order_type'] = \OrderConst::INCLUDE;
            $data['title'] = 'Cập nhật & Xác nhận đơn - '.$arr_order['code'];
            $data['link_action'] = url('update/orders/'.$id);
            $data['id'] = $id;
            $data['stage'] = $arr_order['status'];
            $blade_to = 'orders.users.'.\GroupUser::getCurrent().'.view';
            if (view()->exists($blade_to)) {
                return view($blade_to, $data);
            }else{
                return back()->with('error', 'Bạn không có quyền truy cập giao diện này !');
            } 
        }else{
            if (!empty($request['order']['status'])) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
            }
            return $this->services->processDataOrder($request, $arr_quote);           
        }
    }

    public function applyToDesign($data, $arr_order, $base_order_id, $quote_id)
    {
        if (\GroupUser::isTechApply()) {
            if (@$arr_order->status != \StatusConst::NOT_ACCEPTED) {
                return returnMessageAjax(100, 'Lỗi không xác định !');
            }
            
            $arr_quote = Quote::find($quote_id);
            $product_process = $this->quote_services->processDataProduct($data, $arr_quote, \TDConst::ORDER_ACTION_FLOW);
            if (!empty($product_process['code']) && $product_process['code'] == 100) {
                return returnMessageAjax(100, $product_process['message']);  
            }
            $status = $this->services->insertDesignCommand($data['product'], $base_order_id, $arr_order->code);
            if ($status) {
                return returnMessageAjax(200, 'Đã thêm lệnh thiết kế cho đơn hàng '.$arr_order->code.' !', getBackUrl());
            }    
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền duyệt sản xuất!');
        }
    }

    public function applyToHandlePlan($data, $arr_order, $base_order_id, $quote_id)
    {
        if (\GroupUser::isTechHandle()) {
            if (@$arr_order->status != Order::DESIGN_SUBMITED) {
                returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
            }
            $arr_quote = Quote::find($quote_id);
            $product_process = $this->quote_services->processDataProduct($data, $arr_quote, \TDConst::ORDER_ACTION_FLOW);
            if (!empty($product_process['code']) && $product_process['code'] == 100) {
                return returnMessageAjax(100, $product_process['message']);  
            }
            $arr_update = ['status' => Order::TECH_SUBMITED];
            foreach ($data['product'] as $product) {
                Product::where('id', $product['id'])->update($arr_update);
            }
            if (checkUpdateeOrderStatus($base_order_id, Order::TECH_SUBMITED)) {
                Order::where('id', $base_order_id)->update($arr_update);
            }
            return returnMessageAjax(200, 'Đã gửi yêu cầu thành công tới P. Kế hoạch SX cho đơn '.$arr_order->code.' !', getBackUrl()); 
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền duyệt sản xuất!');
        }
    }

    public function applyOrder(Request $request, $stage, $type, $id)
    {
        $data = $request->except('_token');
        $table = $type == \OrderConst::INCLUDE ? 'orders' : 'products';
        $arr_order = \DB::table($table)->find($id);
        $quote_id = $type == \OrderConst::INCLUDE ? @$arr_order->quote : @$arr_order->quote_id;
        $base_order_id = $type == \OrderConst::INCLUDE ? @$arr_order->id : @$arr_order->order;
        switch ($stage) {
            case Order::NOT_ACCEPTED:
                return $this->applyToDesign($data, $arr_order, $base_order_id, $quote_id);
            case Order::DESIGN_SUBMITED:
                return $this->applyToHandlePlan($data, $arr_order, $base_order_id, $quote_id);   
            default:
                return returnMessageAjax(100, 'Lỗi không xác định !');
        }
    }

    public function receiveCommand($table, $id)
    {
        $model = getModelByTable($table);
        $command = $model::find($id);
        if ($command['status'] != \StatusConst::NOT_ACCEPTED || !empty($command['assign_by'])) {
            $msg = 'Lệnh này đã được nhận ';
            if (!empty($command['assign_by'])) {
                $msg .= 'bởi '.getFieldDataById('name', 'n_users', $command['assign_by']);
            }
            return returnMessageAjax(100, $msg.' !');
        }
        if (\GroupUser::isAdmin() || \GroupUser::getCurrent() == $model::GR_USER) {
            $process = $model::where('id', $id)->update(['assign_by' => \User::getCurrent('id'), 'status' => $model::PROCESSING]);
            if ($process) {
                $arr_status = ['status' => $model::PROCESSING];
                Product::where('id', $command['product'])->update($arr_status);
                if (checkUpdateeOrderStatus($command['id'], $model::PROCESSING)) {
                    Order::where('id', $command['order'])->update($arr_status);
                }
                return returnMessageAjax(200, 'Đã tiếp nhận lệnh, vui lòng truy cập danh sách lệnh của bạn!', \StatusConst::RELOAD);
            }else{
                return returnMessageAjax(100, 'Có lỗi xảy ra, vui lòng thử lại!');
            }       
        }else{
            return returnMessageAjax(100, 'Bạn không thuộc bộ phận nhận lệnh này !');
        }    
    }

    public function supplyHandle(Request $request)
    {
        if (\GroupUser::isAdmin() || \GroupUser::isPlanHandle()) {
            $table = $request->input('table');
            $id = $request->input('id');
            $data_supply = \DB::table($table)->find($id);
            if (empty($data_supply)) {
                return back()->with('error', 'Dữ liệu không hợp lệ !');
            }
            if ($table == 'papers') {
                $data_supply->type = \TDConst::PAPER;    
            }elseif ($table == 'fill_finishes') {
                $data_supply->type = \TDConst::FILL_FINISH; 
            }
            if (getHandleSupplyStatus($data_supply->product, $data_supply->id, $data_supply->type) != CSupply::NOT_HANDLE) {
                return back()->with('error', 'Vật tư đang được xử lí bởi kế toán kho !');
            }
            $supp_size = !empty($data_supply->size) ? json_decode($data_supply->size, true) : [];
            if (!empty($data_supply)) {
                if ($request->isMethod('GET')) {
                    $data['supply_obj'] = $data_supply;
                    $data['title'] = 'Xử lí vật tư sản xuất sản phẩm '.getFieldDataById('name', 'products', $data_supply->product);
                    $data['parent_url'] = ['link' => 'update/products/'.$data_supply->product, 'note' => 'Danh sách vật tư cần xử lí'];
                    $prefix = !empty($data_supply->type) ? $data_supply->type : $table;
                    $data['pro_index'] = 0;
                    $data['supp_index'] = 0;
                    $data['table'] = $table;
                    $data['supply_size'] = $supp_size;
                    if (view()->exists('orders.users.6.supply_handles.'.$prefix)) {
                        return view('orders.users.6.supply_handles.'.$prefix, $data); 
                    }else{
                        return back()->with('error', 'Giao diện này không tồn tại!');
                    } 
                }else{
                    $data_command = $request->input('c_supply');
                    $data_over_supp = $request->input('over_supply');
                    $method_handle_name = 'supply_handle_'.$data_supply->type;
                    if (method_exists($this->services, $method_handle_name)) {
                        return $this->services->{$method_handle_name}($data_supply, $supp_size, $data_command, $data_over_supp);
                    }else{
                        return returnMessageAjax(100, 'Không thể xử lí vật tư !');
                    } 
                } 
            }else{
                return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Dữ liệu không hợp lệ']);
            }      
        }else{
            return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Bạn không có quyền thực hiện hành động!']);
        }
    }

    public function selectSupplyWarehouse(Request $request, $table)
    {
        $supply_id = $request->input('supply');
        $model = getModelByTable($table);
        $supply = $model::find($supply_id);
        $need = (float) $request->input('need');
        if (empty($supply)) {
            return returnMessageAjax(100, 'Vật tư không tồn tại hoặc đã bị xóa !');
        }
        return $model::getStructForPlan(['supply' => $supply, 'need' => $need]);
    }

    public function addSelectSupplyHandle(Request $request)
    {
        $data = $request->all();
        return view('orders.users.6.supply_handles.view_handles.'.$data['type'].'.item', $data);
    }

    public function takeOutSupply($id)
    {
        if (\GroupUser::isAdmin() || \GroupUser::isWarehouse()) {
            $command = \DB::table('c_supplies');
            $data_command = $command->find($id);
            if (@$data_command->status != CSupply::HANDLING) {
                return returnMessageAjax(110, 'Dữ liệu không hợp lệ!');
            } 
            $data_update = ['status' => CSupply::HANDLED, 
                            'assign_by' => \User::getCurrent('id'), 
                            'confirm_at' => \Carbon\Carbon::now()];
            $update = $command->where('id' , $id)->update($data_update);
            if ($update) {
                return returnMessageAjax(200, 'Bạn đã xác nhận xuất vật tư!', \StatusConst::RELOAD);
            }  
        }else{
            return returnMessageAjax(110, 'Bạn không có quyền duyệt xuất vật tư!');
        }
    }

    public function takeInSupply($id)
    {
        if (\GroupUser::isAdmin() || \GroupUser::isWarehouse()) {
            $warehouse_table = \DB::table('supply_warehouses');
            $warehouse = $warehouse_table->find($id);
            if (@$warehouse->status != SupplyWarehouse::WAITING) {
                return returnMessageAjax(110, 'Dữ liệu không hợp lệ!');
            } 
            $data_update = ['status' => SupplyWarehouse::IMPORTED, 
                            'confirm_by' => \User::getCurrent('id'), 
                            'confirm_at' => \Carbon\Carbon::now()];
            $update = $warehouse_table->where('id' , $id)->update($data_update);
            if ($update) {
                return returnMessageAjax(200, 'Bạn đã xác nhận nhập kho vật tư !', \StatusConst::RELOAD);
            }  
        }else{
            return returnMessageAjax(110, 'Bạn không có quyền duyệt nhập kho vật tư !');
        }
    }

    public function applyToWorkerHandle($table, $id)
    {
        $table_data = \DB::table($table)->where('id', $id);
        $obj_order = $table_data->first();
        if (\GroupUser::isPlanHandle()) {
            if ($obj_order->status != Order::TECH_SUBMITED) {
                return returnMessageAjax(110, 'DỮ liệu trạng thái đơn hàng không hợp lệ !');
            }
            $elements = getProductElementData($obj_order->category, $obj_order->id, true);
            foreach ($elements as $element) {
                if (!empty($element['data'])) {
                    foreach ($element['data'] as $key => $supply) {
                        $table = $element['table'];
                        $data_update = getStageActiveStartHandle($table, $supply->id);
                        if (!empty($data_update)) {
                            $data_update['code'] =  $obj_order->code.getCharaterByNum($key);
                            $update = getModelByTable($table)->where('id', $supply->id)->update($data_update);
                        }
                    }
                }
            }
            if (!empty($update)) {
                $arr_update = ['status' => Order::MAKING_PROCESS];
                $table_data->update($arr_update);
                if (checkUpdateeOrderStatus($obj_order->order, Order::MAKING_PROCESS)) {
                    Order::where('id', $obj_order->order)->update($arr_update);
                }
                return returnMessageAjax(200, 'Đã gửi lệnh sản xuất xuống xưởng !');
            }else{
                return returnMessageAjax(100, 'Đã có lỗi xảy ra, vui lòng thử lại !');
            }
        }else{
            return returnMessageAjax(110, 'Bạn không có quyền duyệt sản xuất !');    
        } 
    }
}
?>