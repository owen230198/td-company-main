<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
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
            if ($arr_order['status'] = Order::NOT_ACCEPTED) {
                $data['stage'] = Order::NOT_ACCEPTED;
            }
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
            if ($arr_order != \StatusConst::NOT_ACCEPTED) {
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

    public function applyOrder(Request $request, $stage, $id)
    {
        $data = $request->except('_token');
        switch ($stage) {
            case Order::NOT_ACCEPTED:
                return $this->applyToDesign($data, $id);
            default:
                return returnMessageAjax(100, 'Lỗi không xác định !');
        }
    }

    public function receiveCommand($table, $id)
    {
        $model = getModelByTable($table);
        $command = $model::find($id);
        if ($command['status'] != \StatusConst::NOT_ACCEPTED || empty($command['assign'])) {
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
}
?>