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
        $this->quotes = new \App\Services\QuoteService;
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
            return $this->services->processDataOrder($request, $arr_quote);           
        }
    }

    private function techApplyToDesign($arr_order, $data)
    {
        if (\GroupUser::isTechApply()) {
            $command = $this->services->ProcessDesignCommand($arr_order);    
        }else{
            return returnMessageAjax(100, 'Bạn không có quyền duyệt sản xuất!');
        }
    }

    public function applyOrder(Request $request, $id)
    {
        $arr_order = Order::find($id);
        $arr_quote = Quote::find($request->input('quote'));
        if (!empty($arr_quote)) {
            $this->services->processDataOrder($request, $arr_quote);
        }
        $data = $request->except('_token');
        switch (@$arr_order['status'] == Order::NOT_ACCEPTED) {
            case \TDConst::ORDER_APLLY_FLOW :
                return $this->techApplyToDesign($arr_order, $data);
            default:
                return returnMessageAjax(100, 'Lỗi không xác định !');
        }
    }
}
?>