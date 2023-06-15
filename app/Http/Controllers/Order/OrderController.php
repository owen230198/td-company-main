<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Product;

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
            return view('orders.users.'.\GroupUser::getCurrent().'.view', $data);
        }else{
            if (!empty($request['order']['status'])) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
            }
            return $this->services->processDataOrder($request, $arr_quote);           
        }
    }

    public function applyOrder(Request $request, $id)
    {
        if (\GroupUser::isTechApply()) {
            $arr_order = Order::find($id);
            if ($arr_order != \StatusConst::NOT_ACCEPTED) {
                returnMessageAjax(100, 'Lỗi không xác định !');
            }
            $arr_quote = Quote::find($request->input('quote'));
            $data = $request->except('_token');
            if (!empty($arr_quote)) {
                $this->quote_services->processDataProduct($data, $arr_quote, \TDConst::ORDER_ACTION_FLOW);
            }
            $status = $this->services->insertDesignCommand($arr_order);
            if ($status) {
                return returnMessageAjax(200, 'Đã thêm lệnh thiết kế cho đơn hàng '.$arr_order['code'].' !', getBackUrl());
            }    
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền duyệt sản xuất!');
        }
    }
}
?>