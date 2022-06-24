<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service = new \App\Services\AdminService;
    }

    public function index()
    {
        return redirect('/');
    }

    public function permissionError()
    {
        return view('403');
    }

    private function getDataBaseView($table, $name='')
    {
        $data = $this->service->getBaseTable($table);
        $data['page_item'] = isset($data['tableItem']['admin_paginate'])?$data['tableItem']['admin_paginate']:10;
        $data['view_type'] = isset($data['tableItem']['view_type'])?$data['tableItem']['view_type']:'view';
        $data['field_searchs'] = $this->detail_tables->where('table_map', $table)->where('act', 1)->where('search', 1)->orderBy('ord', 'asc')->get();
        $data['title'] = $name.' '.$data['tableItem']['note'];
        if ($data['view_type']=='config') {
            $data['regions'] = $this->regions->getRegionOfConfig($table);   
        }
        return $data;
    }

    public function view($table)
    {
        $data = $this->getDataBaseView($table, 'Danh sách');
        $data_tables = getDataTable($table, '*', array(), $data['page_item']);
        $data['data_tables'] = $data_tables;
        return view('table.'.$data['view_type'], $data);
    }

    private function getDataActionView($table, $action, $action_name)
    {
        $data['tableItem'] = $this->service->getTableItem($table);
        $data['title'] = $action_name.' '.$data['tableItem']['note'];
        $data['field_list'] = $this->service->getFieldAction($table, $action);
        $data['action'] = $action;
        $data['action_name'] = $action_name;
        $data['regions'] = $this->regions->getRegionOfTable($table);
        return $data;
    }

    public function insert($table)
    {
        $data = $this->getDataActionView($table, 'insert', 'Thêm mới');
        return view('action.view', $data);
    }

    public function doInsert($table, Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $insertID = $this->service->doInsertTable($table, $data);
        if (@$insertID) {
            $route = $table=='quotes'?'action-quote-views/insert/'.$insertID:'view/'.$table;
            return redirect($route)->with('message','Thêm dữ liệu thành công !');  
        }else {
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    }  
}

