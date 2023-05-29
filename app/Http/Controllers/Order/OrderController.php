<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Product;
use App\Constants\StatusConstant;

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
            if (empty($arr_quote) || @$arr_quote['status'] == StatusConstant::NOT_ACCEPTED) {
                return back()->with('error', 'Dữ liệu báo giá không hợp lệ!');
            }
            $data['data_quote'] = $arr_quote;
            $data['products'] = Product::where(['act' => 1, 'quote_id' => $quote_id])->get();
            $data['product_qty'] = count($data['products']);
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
            $data['customer_info'] = false;
            $data['data_order'] = $arr_order;
            $data['data_quote'] = $arr_quote;
            $data['products'] = Product::where(['act' => 1, 'quote_id' => $arr_quote['id']])->get();
            $data['product_qty'] = count($data['products']);
            $data['title'] = 'Cập nhật & Xác nhận đơn - '.$arr_order['code'];
            $data['link_action'] = url('update/orders/'.$id);
            return view('orders.view', $data);
        }else{
            return $this->services->processDataOrder($request, $arr_quote);           
        }
    }

    
}
?>