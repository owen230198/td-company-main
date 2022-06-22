<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::construct();
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
        $data['field_searchs'] = $this->service->getSearchTableField($table);
        $data['title'] = $name.' '.$data['tableItem']['note'];
        if ($data['view_type']=='config') {
            $data['regions'] = $this->regions->getRegionOfConfig($table);   
        }
        return $data;
    }

    public function view($table)
    {
        $data = $this->getDataBaseView($table, 'Danh sách');
        $data_tables = getDataTable($table, $data['page_item'], 0, 'id', 'desc', $where);
        $data['data_tables'] = $data_tables['data'];
        $data['paginate'] = $data_tables['paginate'];
        return view('table.'.$data['view_type'], $data);  
    }    
}

