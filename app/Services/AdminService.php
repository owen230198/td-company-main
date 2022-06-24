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
}
