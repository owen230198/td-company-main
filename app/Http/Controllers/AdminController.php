<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
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

    public function insertTable($table)
    {
        return view($table.'insert'], $data);
    }   
}

