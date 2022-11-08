<?php
namespace App\Services;
class BaseService
{
 	function __construct(){
 		$this->users = new \App\Models\NUser;
 		$this->roles = new \App\Models\NRole;
 		$this->modules = new \App\Models\NModule;
 		$this->group_users = new \App\Models\NGroupUser;
 		$this->users = new \App\Models\NUser;
 		$this->list_tables = new \App\Models\NTable;
        $this->detail_tables = new \App\Models\NDetailTable;
        $this->regions = new \App\Models\NRegion;
        $this->db = new \Illuminate\Support\Facades\DB;
 	}

	public function processDataBefore($data)
	{
		foreach ($data as $key => $value) {
			if (str_contains($key, 'date') || str_contains($key, 'expired') || str_contains($key, '_at')) {
				$data[$key] = getDataDateTime($value);
			}
		}
		$data['created_by'] = @getSessionUser()['id'];
		$data['created_at'] = !empty($data['created_at'])?$data['created_at']:date('Y-m-d H:i', Time()); 
		return $data;
	}
}