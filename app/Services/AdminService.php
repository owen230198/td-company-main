<?php
namespace App\Services;
use App\Constants\StattusConstant;
use App\Services\BaseService;
class AuthService extends BaseService
{ 
    function __construct()
    {
    	parent::__construct();
    }

    public function getBaseTable($table)
    {
    	$data['tableItem'] = $this->list_tables->where('name', $table)->first();
        $data['field_shows'] = $this->getFieldShow($table);
        return $data;
    }
}
