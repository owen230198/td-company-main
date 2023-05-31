<?php
namespace App\Services;
class BaseService
{
 	function __construct(){
		$this->group_user = new \App\Models\NGroupUser;
        $this->regions = new \App\Models\NRegion;
 	}

	public function configBaseDataAction(&$data)
	{
		if (empty($data['id'])) {
			$data['created_by'] = @getSessionUser()['id'];
			$data['created_at'] = !empty($data['created_at']) ? getDataDateTime($data['created_at']) : date('Y-m-d H:i:s', Time());
		}
		$data['act'] = !empty($data['act']) ? $data['act'] : 1;
		$data['updated_at'] = !empty($data['updated_at']) ? getDataDateTime($data['updated_at']) : date('Y-m-d H:i:s', Time());
	}

	public function validateDataTable($field, $attr, $value)
	{
		$ret['code'] = 200;
		$note = mb_strtolower(@$field['note']);
		if (!empty($attr['required']) && empty($value)) {
			$ret['code'] = 100;
			$ret['message'] = 'Dữ liệu '.$note.' không được để trống !';
			return $ret;
		}

		if (!empty($attr['unique'])) {
			$count = getCountDataTable($field['table_map'], [$field['name'] => $value]);
			if ($count > 1) {
				$ret['code'] = 100;
				$ret['message'] = $note. ' "'.$value.'" '.' đã tồn tại !';
				return $ret;
			}
		}
		return $ret;
	}

	public function processDataBefore($data, $table)
	{
		foreach ($data as $key => $item) {
            if ($key != 'created_at' && $key != 'updated_at') {
				$field = \App\Models\NDetailTable::select(['type', 'attr', 'note', 'name', 'table_map'])->where(['table_map'=>$table, 'name'=>$key])->first();
				$attr = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
				$validation = $this->validateDataTable($field, $attr, $item);
				if ($validation['code'] == 100) {
					return $validation;
					break;
				}
				if (@$field['type'] == 'datetime') {
					$data[$key] = getDataDateTime($item);
				}elseif (@$attr['type_input'] == 'password') {
					$data[$key] = md5($data['password']);
				}  
			}
        }
		$this->configBaseDataAction($data);
		return ['code' => 200, 'data' => $data];
	}
}