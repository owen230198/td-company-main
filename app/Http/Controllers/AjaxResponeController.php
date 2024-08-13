<?php
namespace App\Http\Controllers;

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
                'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'product_warehouses']],
            ];
        }
        return view('view_update.view', $field);
    }
}

