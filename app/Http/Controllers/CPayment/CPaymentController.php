<?php

namespace App\Http\Controllers\CPayment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CPaymentController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'c_payments';
    }
    public function getDataView($action)
    {
        $data = $this->admins->getDataActionView($this->table, $action, $action == 'insert' ? 'Thêm mới' : 'Chi tiết');
        $field_list = collect($data['field_list']);
        $fields = $field_list->pluck(null, 'name')->toArray();
        dd($fields);
        $data['field_customers'] = array_slice($field_list, 0, 2);
        $data['field_costs'] = array_slice($field_list, 2);
        return $data;
    }
    public function insert($request)
    {
        $table = $this->table;
        if (!$request->isMethod('POST')) {
            $data = $this->getDataView(__FUNCTION__);
            $data['action_url'] = url('insert/'.$table);
            $data['dataItem'] = $request->except(['nosidebar']);
            return view('c_orders.view', $data);
        }else{
            
        }
    }
}
