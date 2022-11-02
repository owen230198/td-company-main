<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\NameConstant;
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
            $data['listPaperSubs'] = getDataTable('p_substances', ['id', 'name'], 
            [['key'=>'act', 'compare'=>'=', 'value'=>1]], 0, 'name', 'asc', true);
            return view('orders.insert', $data);    
        }else{
            dd($request->all());
        }   
    }

    public function setListProductView(Request $request)
    {
        if (!$this->admins->checkPermissionAction('orders', 'insert')) {
            return '403 : Lỗi quyền truy cập !';
        }
        $data['proQuantity'] = (int)@request('qty');
        $data['proName'] = !empty(request('name'))?request('name'):'Sản phẩm';
        $data['cDesignContacter'] = getFieldDataById('contacter', 'Customer', (int)@request('customer_id'));
        $data['listTypeProcate'] = NameConstant::PRO_CATE_TYPE;
        $data['listProCate'] = getDataTable('product_categories', '*', 
        [['key'=>'act', 'compare'=>'=', 'value'=>1]], 0, 'name', 'asc', true);
        return view('orders.list_products', $data);
    }
}
?>