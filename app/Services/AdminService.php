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

    public function getBaseTable($table)
    {
    	$data['tableItem'] = $this->list_tables->where('name', $table)->first();
        $data['field_shows'] = $this->detail_tables->where('table_map', $table)->where('act', 1)->where('view', 1)->orderBy('ord', 'asc')->get();
        return $data;
    }
}
