<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Constants\VariableConstant;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct()
	{
		$this->detail_tables = new \App\Models\NDetailTable;
		$this->regions = new \App\Models\NRegion;
		$this->db = new \Illuminate\Support\Facades\DB;
		$this->admins = new \App\Services\AdminService;
	}

	public function getDataActionView($table, $action, $action_name)
    {
        $data['tableItem'] = $this->admins->getTableItem($table);
        $data['title'] = $action_name.' '.$data['tableItem']['note'];
        $action = $action=='clone'?'insert':$action;
        $data['field_list'] = $this->admins->getFieldAction($table, $action);
        $data['action'] = $action;
        $data['action_name'] = $action_name;
        if (!in_array($table, VariableConstant::ACTION_TABLE_SELF)) {
            $data['regions'] = $this->regions->getRegionOfTable($table);
        }
        return $data;
    }
}

