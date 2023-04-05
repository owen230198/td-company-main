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
		$this->base_services = new \App\Services\BaseService;
        $this->admins = new \App\Services\AdminService;
        $this->group_users = new \App\Models\NGroupUser;
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

