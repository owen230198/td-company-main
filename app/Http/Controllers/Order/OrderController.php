<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->admins = new \App\Services\AdminService;
    }

    public function insert(Request $request, $data = array())
    {
        if (!$request->isMethod('POST')) {
            return view('orders.insert', $data);    
        }else{

        }   
    }

    public function setListProductView(Request $request)
    {
        if (!$this->admins->checkPermissionAction('orders', 'insert')) {
            return '403 : Lỗi quyền truy cập !';
        }
        $data= ['proQuantity'=>(int)@request('qty'), 'proName'=>!empty(request('name'))?request('name'):'Sản phẩm'];
        return view('orders.list_products', $data);
    }
}
?>