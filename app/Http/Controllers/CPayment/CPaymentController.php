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
        $field_list = $data['field_list'];
        $fields = collect($field_list)->pluck(null, 'name')->toArray();
        $data['field_type'] = $fields['payment_to'];
        $data['field_infomations'] = array_slice($field_list, 2);
        return $data;
    }
    public function insert($request)
    {
        $table = $this->table;
        if (!$request->isMethod('POST')) {
            $data = $this->getDataView(__FUNCTION__);
            $data['action_url'] = url('insert/'.$table);
            $data['dataItem'] = $request->except(['nosidebar']);
            return view('c_payments.view', $data);
        }else{
            
        }
    }
}
