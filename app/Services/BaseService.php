<?php
namespace App\Services;
use App\Models\NGroupUser;
class BaseService
{
 	function __construct(){
 		$this->users = new \App\Models\NUser;
 		$this->group_users = new NGroupUser;
 		$this->list_tables = new \App\Models\NTable;
        $this->detail_tables = new \App\Models\NDetailTable;
        $this->regions = new \App\Models\NRegion;
 	}

	public function processDataBefore($data)
	{
		foreach ($data as $key => $value) {
			if (str_contains($key, 'date') || str_contains($key, 'expired') || str_contains($key, '_at')) {
				$data[$key] = getDataDateTime($value);
			}
			if (str_contains($key, 'json_data') && is_array($value)) {
				$data[$key] = json_encode($value);
			}
		}
		$data['created_by'] = @getSessionUser()['id'];
		$data['created_at'] = !empty($data['created_at'])?$data['created_at']:date('Y-m-d H:i', Time());
		return $data;
	}
}