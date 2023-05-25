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
            if (empty($arr_quote)) {
                return returnMessageAjax(100, 'Báo giá không tồn tại!');
            }
            if ($arr_quote == StatusConstant::NOT_ACCEPTED) {
                return returnMessageAjax(100, 'Báo giá chưa được khách hàng duyệt !');
            }
            $data = $request->except('_token');
            $arr_order = !empty($data['order']) ? $data['order'] : [];
            if (@$arr_order['status'] == StatusConstant::ACCEPTED) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ');
            }
            $process = $this->services->processDataOrder($arr_order);
            if ($process['valid']) {
                $this->quotes->processDataProduct($data, $arr_quote);
                return returnMessageAjax(200, $process['message'], @session()->get('back_url')); 
            }
            return returnMessageAjax(100, $process['message']); 
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
            
        }
    }

    public function getDataTableCommand(Request $request, $table){
        $permission = $this->admins->checkPermissionAction($table, 'view');
        if (!@$permission['allow']) {
            return redirect('permission-error');
        }
        $status = $request->input('status') == 0 ? StatusConstant::NOT_ACCEPTED : StatusConstant::ACCEPTED;
        $data = $this->admins->getDataBaseView($table, 'Danh sách');
        $data['data_tables'] = \DB::table($table)->where(['status'=>$status])->paginate(50);
        return view('table.'.$data['view_type'], $data);           
    }

    public function viewCommand(Request $request, $table, $id)
    {
        $permission = $this->admins->checkPermissionAction($table, 'view');
        if (!@$permission['allow']) {
            return redirect('permission-error');
        }
        $data = $this->admins->getDataActionView($table, 'view', 'Chi tiết');
        $data['dataItem'] = json_decode(json_encode(\DB::table($table)->find($id)), true);
        if ($table == 'c_processes') {
            $data['dataItemCProcess'] = $data['dataItem'];
            $processData = !empty($data['dataItem']['json_data_conf'])?json_decode($data['dataItem']['json_data_conf'], true):[];
            $data['listProcess'] = array_keys($processData);
            $data['dataConfProcess'] = $processData;
        }
        return view('orders.commands.view', $data);
    }
}
?>