<?php
namespace App\Services;
class BaseService
{
 	function __construct(){
		$this->group_user = new \App\Models\NGroupUser;
 	}

	public function configBaseDataAction(&$data)
	{
		if (empty($data['id'])) {
			$data['act'] = !empty($data['act']) ? $data['act'] : 1;
			$data['created_by'] = @getSessionUser()['id'];
			$data['created_at'] = !empty($data['created_at']) ? $data['created_at'] : date('Y-m-d H:i', Time());
		}
		$data['updated_at'] = !empty($data['updated_at']) ? $data['updated_at'] : date('Y-m-d H:i', Time());
	}

	public function processDataBefore($data)
	{
		$this->configBaseDataAction($data);
		foreach ($data as $key => $value) {
			if (str_contains($key, 'date') || str_contains($key, 'expired') || str_contains($key, '_at')) {
				$data[$key] = getDataDateTime($value);
			}
			if (str_contains($key, 'json_data') && is_array($value)) {
				$data[$key] = json_encode($value);
			}
		}
		return $data;
	}
}