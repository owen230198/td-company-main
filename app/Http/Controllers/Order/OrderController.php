<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\NameConstant;
use App\Constants\OrderConstant;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->order_service =  new \App\Services\OrderService;
    }

    private function getOrderActionViewData($action, $actioName)
    {
        $data = $this->getDataActionView('orders', $action, $actioName);
        return $data;
    }

    public function insert(Request $request)
    {
        if (!$request->isMethod('POST')) {
            $data = $this->getOrderActionViewData('insert', 'Thêm');
            return view('orders.view', $data);    
        }else{
            if (!$this->admins->checkPermissionAction('orders', 'insert')) {
                echoJson(110, 'Bạn không có quyền thực hiện thao tác này!');
                return;
            }
            $dataInsert = $request->all();
            $dataInsertOrder = @$dataInsert['order']??[];
            if (count($dataInsertOrder)>0) {
                $orderId = $this->order_service->insertOrder($dataInsertOrder);
            }
            if ($orderId) {
                $status = $this->order_service->insertOrderDetail($dataInsert, $orderId);
                if ($status) {
                    echoJsonRedirect('view/orders', 200, 'Thêm thành công đơn hàng!');
                    return;
                }else{
                    echoJson(110, 'Đã xảy ra lỗi khi cấu hình lệnh!');
                    return;
                }
            }else{
                echoJson(110, 'Có lỗi khi thêm mới đơn hàng!');
                return;
            }
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
        $data['cDesignContacter'] = getFieldDataById('contacter', 'Customer', (int)@request('customer_id'));
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
        $data = $this->getDataActionView($table, 'view', 'Chi tiết');
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