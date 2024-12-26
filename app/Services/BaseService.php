<?php
namespace App\Services;
class BaseService
{
 	function __construct(){
        $this->regions = new \App\Models\NRegion;
 	}

	public function configBaseDataAction(&$data, $key_login = 'user_login')
	{
		if (empty($data['id'])) {
			$data['created_by'] = @getSessionUser($key_login)['id'];
			$data['created_at'] = \Carbon\Carbon::now();
			$data['act'] = isset($data['act']) ? $data['act'] : 1;
		}
		$data['updated_at'] = \Carbon\Carbon::now();
	}

	public function validateDataTable($field, $attr, $value, $data)
	{
		$ret['code'] = 200;
		$note = mb_strtolower(@$field['note']);
		if (!empty($attr['required']) && $value == '') {
			$ret['code'] = 100;
			$ret['message'] = 'Dữ liệu '.$note.' không được để trống !';
			return $ret;
		}

		if (!empty($attr['unique'])) {
			$count = getCountDataTable($field['table_map'], [$field['name'] => $value]);
			$check_count = isset($data['id']) ? 1 : 0;
			if ($count > $check_count) {
				$ret['code'] = 100;
				$ret['message'] = $note. ' "'.$value.'" '.' đã tồn tại !';
				return $ret;
			}
		}
		return $ret;
	}

	public function processDataBefore($data, $table)
	{
		unset($data['created_at'], $data['updated_at']);
		$child_linkings = [];
		foreach ($data as $key => $item) {
            $field = \App\Models\NDetailTable::select(['type', 'attr', 'note', 'name', 'table_map', 'other_data'])->where(['table_map'=>$table, 'name'=>$key])->first();
			$attr = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
			$other_data = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
			$validation = $this->validateDataTable($field, $attr, $item, $data);
			if ($validation['code'] == 100) {
				return $validation;
				break;
			}
			if (@$field['type'] == 'datetime') {
				$data[$key] = getDataDateTime($item);
			}elseif (@$field['type'] == 'select' && !empty($other_data['config']['multiple'])) {
				$data[$key] = json_encode($item);
			}elseif (@$field['type'] == 'multiplelinking') {
				$data[$key] = json_encode($item);
			}elseif (@$field['type'] == 'text' && @$attr['type_input'] == 'password') {
				$data[$key] = md5($data['password']);
			}elseif (@$field['type'] == 'child_linking') {
				$data_other = $other_data['data'];
				$table_child = $data_other['table'];
				foreach ($item as $child_data) {
					$data_child = $this->processDataBefore($child_data, $table_child);
					if (@$data_child['code'] == 100) {
						return $data_child;
						break;
					}
					$data_child['table'] = $table_child;
					$data_child['field_parent'] = $data_other['field_query'];
					$child_linkings[] = $data_child;
				}
				unset($data[$key]);
			}else{
				$data[$key] = $item;	
			} 
        }
		$this->configBaseDataAction($data);
		return ['code' => 200, 'data' => $data, 'child_linkings' => $child_linkings];
	}
}