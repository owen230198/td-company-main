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
    }

    public function insert(Request $request)
    {
        if (!$request->isMethod('POST')) {
            $qtote_id = $request->input('quote');
            $arr_quote = Quote::find($qtote_id);
            if (empty($arr_quote) || @$arr_quote['status'] == StatusConstant::NOT_ACCEPTED) {
                return back()->with('error', 'Dữ liệu báo giá không hợp lệ!');
            }
            $data['data_quote'] = $arr_quote;
            $data['products'] = Product::select(['name', 'qty', 'design', 'category', 'size'])->where(['act' => 1, 'quote_id' => $qtote_id])->get();
            $data['product_qty'] = count($data['products']);
            $data['title'] = 'Thêm đơn hàng - Mã báo giá : '.$arr_quote['seri'];
            $data['link_action'] = url('insert/orders');
            return view('orders.view', $data);
        }else{
                
        }   
    }

    public function setListProductView()
    {
        if (!$this->admins->checkPermissionAction('orders', 'insert')) {
            return '403 : Lỗi quyền truy cập !';
        }
        $data = getProductCategoryOption();
        $data['proQuantity'] = (int)@request('qty');
        $data['proName'] = !empty(request('name'))?request('name'):'Sản phẩm';
        $data['action'] = \App\Constants\VariableConstant::ACTION_INSERT;
        return view('orders.list_products', $data);
    }

    public function update(Request $request, $id){
        if (!$request->isMethod('POST')) {
            $data = $this->getOrderActionViewData('update', 'Chi tiết');
            $data['dataItemOrder'] = Order::find($id);
            if (@$data['dataItemOrder']['id']) {
                $data['dataViewProductList'] = $this->admins->getBaseTable('products');
                $data['listDataProduct'] = Product::where('order_id', $id)->get()->toArray();
            }
            return view('orders.view', $data);
        }else{
            if (!$this->admins->checkPermissionAction('orders', 'update')) {
                echoJson(110, 'Bạn không có quyền thực hiện thao tác này!');
                return;
            }
            $data = $request->except('_token');
            $data = @$data['order']??[];
            $status = $this->order_service->updateOrder($data, $id);
            if ($status) {
                $back_url = @session()->get('back_url')??'view/orders';
                echoJsonRedirect($back_url, 200, 'Cập nhật đơn hàng thành công !');
                return;
            }else{
                echoJson(110, 'Có lỗi xảy ra khi cập nhật đơn hàng !');
                return;
            }
        }
    }

    public function getDataTableCommand(Request $request, $table){
        $permission = $this->admins->checkPermissionAction($table, 'view');
        if (!@$permission['allow']) {
            return redirect('permission-error');
        }
        $status = $request->input('status') == 0 ? OrderConstant::ORDER_NOT_ACCEPTED : OrderConstant::ORDER_ACCEPTED;
        $data = $this->admins->getDataBaseView($table, 'Danh sách');
        $data['data_tables'] = $this->db::table($table)->where(['status'=>$status])->paginate(50);
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