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
			$data['created_at'] = !empty($data['created_at']) ? $data['created_at'] : date('Y-m-d H:i', Time());
		}
		$data['act'] = !empty($data['act']) ? $data['act'] : 1;
		$data['updated_at'] = !empty($data['updated_at']) ? $data['updated_at'] : date('Y-m-d H:i', Time());
	}

	public function processDataBefore(&$data, $table)
	{
		foreach ($data as $key => $item) {
            $field = \App\Models\NDetailTable::where(['table_map'=>$table, 'name'=>$key])->first();
            if (@$field['view_type'] == 'date_time') {
                $data[$key] = getDataDateTime($item);
            }elseif (@$field['view_type'] == 'password') {
                $data[$key] = md5($data['password']);
            }  
        }
	}
}