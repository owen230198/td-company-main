<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use App\Models\CSupply;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Quote;

class OrderController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\OrderService;
        $this->quote_services = new \App\Services\QuoteService;
    }

    public function insert(Request $request)
    {
        $quote_id = $request->input('quote');
        $arr_quote = Quote::find($quote_id);
        if (!$request->isMethod('POST')) {
            if (empty($arr_quote) || @$arr_quote['status'] == \StatusConst::NOT_ACCEPTED) {
                return back()->with('error', 'Dữ liệu báo giá không hợp lệ!');
            }
            $data = $this->services->getBaseDataAction($arr_quote, $quote_id);
            $data['title'] = 'Thêm đơn hàng - Mã báo giá : '.$arr_quote['seri'];
            $data['link_action'] = url('insert/orders');
            return view('orders.view', $data);
        }else{
            if (!empty($request['order']['status'])) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
            }
            return $this->services->processDataOrder($request, $arr_quote); 
        }   
    }

    public function update(Request $request, $id){
        $arr_order = Order::find($id);
        $arr_quote = Quote::find($arr_order['quote']);
        if (!$request->isMethod('POST')) {
            if (empty($arr_order)) {
                return back()->with('error', 'Dữ liệu Đơn hàng không hợp lệ!');
            }
            $data = $this->services->getBaseDataAction($arr_quote, $arr_quote['id']);
            $data['data_order'] = $arr_order;
            $data['title'] = 'Cập nhật & Xác nhận đơn - '.$arr_order['code'];
            $data['link_action'] = url('update/orders/'.$id);
            $data['id'] = $id;
            $data['stage'] = $arr_order['status'];
            if (view()->exists('orders.users.'.\GroupUser::getCurrent().'.view')) {
                return view('orders.users.'.\GroupUser::getCurrent().'.view', $data);
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

    public function applyToDesign($data, $id)
    {
        if (\GroupUser::isTechApply()) {
            $arr_order = Order::find($id);
            if (@$arr_order['status'] != \StatusConst::NOT_ACCEPTED) {
                returnMessageAjax(100, 'Lỗi không xác định !');
            }
            $arr_quote = Quote::find($data['quote']);
            if (!empty($arr_quote)) {
                $product_process = $this->quote_services->processDataProduct($data, $arr_quote, \TDConst::ORDER_ACTION_FLOW);
                if (!empty($product_process['code']) && $product_process['code'] == 100) {
                    return returnMessageAjax(100, $product_process['message']);  
                }
            }
            $status = $this->services->insertDesignCommand($arr_order);
            if ($status) {
                return returnMessageAjax(200, 'Đã thêm lệnh thiết kế cho đơn hàng '.$arr_order['code'].' !', getBackUrl());
            }    
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền duyệt sản xuất!');
        }
    }

    public function applyToHandlePlan($data, $id)
    {
        if (\GroupUser::isTechHandle()) {
            $arr_order = Order::find($id);
            if (@$arr_order['status'] != Order::DESIGN_SUBMITED) {
                returnMessageAjax(100, 'Lỗi không xác định !');
            }
            $arr_quote = Quote::find($data['quote']);
            if (!empty($arr_quote)) {
                $product_process = $this->quote_services->processDataProduct($data, $arr_quote, \TDConst::ORDER_ACTION_FLOW);
                if (!empty($product_process['code']) && $product_process['code'] == 100) {
                    return returnMessageAjax(100, $product_process['message']);  
                }
            }
            $status = Order::where('id', $id)->update(['status' => Order::TECH_SUBMITED, 'apply_plan_by' => \User::getCurrent('id')]);
            if ($status) {
                return returnMessageAjax(200, 'Đã gửi yêu cầu thành công tới P. Kế hoạch SX cho đơn '.$arr_order['code'].' !', getBackUrl());
            }    
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền duyệt sản xuất!');
        }
    }

    public function applyOrder(Request $request, $stage, $id)
    {
        $data = $request->except('_token');
        switch ($stage) {
            case Order::NOT_ACCEPTED:
                return $this->applyToDesign($data, $id);
            case Order::DESIGN_SUBMITED:
                return $this->applyToHandlePlan($data, $id);   
            default:
                return returnMessageAjax(100, 'Lỗi không xác định !');
        }
    }

    public function receiveCommand($table, $id)
    {
        $model = getModelByTable($table);
        $command = $model::find($id);
        if ($command['status'] != \StatusConst::NOT_ACCEPTED || !empty($command['assign'])) {
            return returnMessageAjax(100, 'Lệnh này đã được nhận !');
        }
        if (\GroupUser::isAdmin() || \GroupUser::getCurrent() == $model::GR_USER) {
            $process = $model::where('id', $id)->update(['assign_by' => \User::getCurrent('id'), 'status' => $model::PROCESSING]);
            if ($process) {
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
            if (getHandleSupplyStatus($data_supply->product, $data_supply->id) != CSupply::NOT_HANDLE) {
                return back()->with('error', 'Vật tư đang được xử lí bởi kế toán kho !');
            }
            $data_supply->order = $request->input('order');
            $supp_size = !empty($data_supply->size) ? json_decode($data_supply->size, true) : [];
            if (!empty($data_supply)) {
                if ($request->isMethod('GET')) {
                        $data['supply_obj'] = $data_supply;
                        $data['title'] = 'Xử lí vật tư sản xuất sản phẩm '.getFieldDataById('name', 'products', $data_supply->product);
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
                    $data_elevate = $request->input('elevate');
                    $data_over_supp = $request->input('over_supply');
                    return $this->services->supplyHandleProcess($data_supply, $supp_size, $data_command, $data_elevate, $data_over_supp);
                } 
            }else{
                return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Dữ liệu không hợp lệ']);
            }      
        }else{
            return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Bạn không có quyền thực hiện hành động!']);
        }
    }
}
?>