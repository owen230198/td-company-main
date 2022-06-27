<?php
namespace App\Services;
use App\Constants\StattusConstant;
use App\Services\BaseService;
class AdminService extends BaseService
{ 
    function __construct()
    {
    	parent::__construct();
    }

    public function getTableItem($table)
    {
        $data = $this->list_tables->where('name', $table)->first();
        return $data;
    }

    public function getFieldAction($table, $action = 'view')
    {
        $data = $this->detail_tables->where('table_map', $table)->where('act', 1)->where($action, 1)->orderBy('ord', 'asc')->get();
        return $data;  
    }

    public function getBaseTable($table)
    {
    	$data['tableItem'] = $this->getTableItem($table); 
        $data['field_shows'] = $this->getFieldAction($table);
        return $data;
    }

    public function doInsertTable($table, $data)
    {
        if (@$data['password']) {
            $data['password'] = md5($data['password']);    
        }
        $insertID = $this->db::table($table)->insertGetId($data);
        return $insertID;
    }


    public function getDataBaseView($table, $name='')
    {
        $data = $this->getBaseTable($table);
        $data['page_item'] = isset($data['tableItem']['admin_paginate'])?$data['tableItem']['admin_paginate']:10;
        $data['view_type'] = isset($data['tableItem']['view_type'])?$data['tableItem']['view_type']:'view';
        $data['field_searchs'] = $this->detail_tables->where('table_map', $table)->where('act', 1)->where('search', 1)->orderBy('ord', 'asc')->get();
        $data['title'] = $name.' '.$data['tableItem']['note'];
        if ($data['view_type']=='config') {
            $data['regions'] = $this->regions->getRegionOfConfig($table);   
        }
        return $data;
    }
}
