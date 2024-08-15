<?php
namespace App\Http\Controllers;

use App\Models\COrder;
use App\Models\Order;
use App\Models\ProductWarehouse;
use App\Models\Represent;
use Illuminate\Http\Request;

class AjaxResponeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $method)
    {
        if(!$method){
            return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
        }else{
            return $this->$method($request);
        }
    }

    public function ajaxFieldImportProductByAction($request)
    {
        $action = $request->input('action');
        if (empty($action)){
            return '';
        }
        if ($action == 'insert') {
            $field = [
               'name' => 'warehouse[unit]',
               'note' => 'ĐVT',
               'type' => 'select',
               'other_data' => ['data' => ['options' => ['' => 'Chọn ĐVT', 'combo' => 'Bộ', 'box' => 'Hộp', 'unit' => 'Chiếc']]]
            ];
        }else{
            $field = [
                'name' => 'data[target]',
                'note' => 'Đối tượng cập nhật',
                'type' => 'linking',
                'other_data' => ['config' => ['search' => 1, 'except_linking' => 1], 'data' => ['table' => 'product_warehouses']],
            ];
        }
        return view('view_update.view', $field);
    }

    public function ajaxFieldCOrderByType($request){
        $type = $request->input('type');
        if ($type != COrder::ORDER){
            return '';
        }
        $where = ['status' => \StatusConst::IMPORTED];
        if (!empty($request->input('customer'))) {
            $where['customer'] = $request->input('customer');
        }

        if (!empty($request->input('represent'))) {
            $where['represent'] = $request->input('represent');
        }

        $field = [
            'name' => 'order',
            'note' => 'Chọn đơn khách đã đặt',
            'attr' => ['inject_class' => '__select_order_for_selling'],
            'type' => 'linking',
            'other_data' => [
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'orders',
                    'where' => $where,
                    'field_title' => 'code'
                ]
            ],
        ];
        return view('view_update.view', $field);
    }

    public function checkRepreSentPermission($request)
    {
        $represent = $request->input('represent');
        $ret_true = ['code' => 200];
        if (empty($represent)) {
            return $ret_true;
        }
        if (\GroupUser::isAdmin()) {
            return $ret_true;
        }
        $represent = Represent::find($represent);
        $arr_sale = !empty($represent->sale) ? json_decode($represent->sale, true) : array();
        $code = in_array(\User::getCurrent('id'), $arr_sale) ? 200 : 100;
        return ['code' => $code];
    }

    public function returnItemJson(Request $request)
    {
        return view($request->table.'.json_item', $request->all());
    }

    public function getPriceProductWarehouse($request)
    {
        $product_id = @$request->input('id') ?? 0;
        $product = ProductWarehouse::find($product_id);
        if (empty($product)) {
            return returnMessageAjax(100, 'Sản phẩm trong kho không tồn tại hoặc đã bị xóa !');
        }
        $rqty = (int) $request->input('qty');
        if ((int) @$product->qty < $rqty) {
            return returnMessageAjax(100, 'Sản phẩm trong kho không đủ để xuất !');
        }
        return !empty($request->input('check_qty')) ? true : $product->price;
    }

    public function getAdvanceOrder($request)
    {
        $id = @$request->input('id') ?? 0;
        $order = Order::find($id);
        return !empty($order->advance) ? $order->advance : 0;    
    }
}

