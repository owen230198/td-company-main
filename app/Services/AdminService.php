<?php
namespace App\Services;
use App\Services\BaseService;
use App\Constants\VariableConstant;
use \App\Models\NDetailTable;
class AdminService extends BaseService
{
    function __construct()
    {
    	parent::__construct();
        $this->quote_service = new \App\Services\QuoteService;
    }

    public function checkPermissionAction($param)
    {
        if($this->group_user::isAdmin());
            return ['allow' => true];
    }

    public function checkListGroup($group, $list_group)
    {
        $ret = false;
        foreach ($list_group as $item) {
            if ($item['id']==$group) {
                $ret = true;
                break;
            }
        }
        return $ret;
    }

    public function checkRoleUpdatePermission($module, $dataRole)
    {
        $admin = getSessionUser();
        if (@$admin['super_admin']) {
            return true;
        }
        $permissions = $this->roles->select('json_data_role')->where('module_id', $module)
        ->where('n_group_user_id', @$admin['n_group_user_id'])->first();
        if ($permissions == null) {
            return false;
        }
        $arrRole = !empty($permissions['json_data_role'])?json_decode($permissions['json_data_role'], true):[];
        if (empty($arrRole)) {
            return false;
        }
        $ret = true;
        foreach ($dataRole as $key => $value) {
            if (!array_key_exists($key, $arrRole) || empty($arrRole[$key])) {
                $ret = false;
                break;
            }
        }
        return $ret;
    }

    public function getTableItem($table)
    {
        $data = \App\Models\NTable::where('name', $table)->first();
        if (!empty($data)) {
            $data['insert'] = json_decode($data['insert'], true);
            $data['update'] = json_decode($data['update'], true);
            $data['remove'] = json_decode($data['remove'], true);
            $data['copy'] = json_decode($data['copy'], true);
        }
        return $data;
    }

    public function getFieldAction($table, $action = 'view')
    {
        return NDetailTable::where(['act' => 1, 'table_map'=> $table, $action => 1])->orderBy('ord', 'asc')->get();
    }

    public function handleDataFieldShow($field_shows)
    {
        $rowspan = 1;
        foreach ($field_shows as $key => $field) {
            if($field['parent'] == 0 && $field['type'] == 'group'){
                $rowspan = 2;
                $field_shows[$key]['child'] = NDetailTable::where(['act' => 1, 'parent' => $field['id']])->orderBy('ord', 'asc')->get()->toArray();
                $field_shows[$key]['colspan'] = !empty($field_shows[$key]['child']) ? count($field_shows[$key]['child']) : 1;
            }
        }
        return ['rowspan' => $rowspan, 'field_shows' => $field_shows];
    }

    public function getDataActionView($table, $action, $action_name, $param = [])
    {
        $data['tableItem'] = $this->getTableItem($table);
        $data['title'] = $action_name.' '.$data['tableItem']['note'];
        $data['field_list'] = $this->getFieldAction($table, $action);
        $data['action_name'] = $action_name;
        $data['default_field'] = $param;
        $data['regions'] = $this->regions->getRegionOfTable($table);
        return $data;
    }

    public function getBaseTable($table)
    {
        $field_shows = $this->getFieldAction($table);
        $data = $this->handleDataFieldShow($field_shows);
    	$data['tableItem'] = $this->getTableItem($table);
        return $data;
    }

    public function getDataBaseView($table, $name='')
    {
        $data = $this->getBaseTable($table);
        $data['page_item'] = @$data['tableItem']['admin_paginate'] ?? 10;
        $data['view_type'] = @$data['tableItem']['view_type'] ?? 'view';
        $name = @$data['view_type'] == 'config' ? 'Cài đặt':$name;
        $data['title'] = $name.' '.$data['tableItem']['note'];
        if ($data['view_type']=='config') {
            $data['regions'] = $this->regions->getRegionOfConfig($table);
        }else{
            $data['field_searchs'] = NDetailTable::where(['act' => 1,'table_map' => $table, 'search' => 1])->orderBy('ord', 'asc')->get();
        }
        return $data;
    }

    public function getConditionTable($table, $field_name, $value)
    {
        $field = NDetailTable::select('id', 'name', 'type')->where(['act' => 1, 'table_map' => $table, 'name' =>$field_name])->get();
            $name = $field['name'];
            $type = $field['type'];
            if ($type == 'text') {
                $tmp = array('key'=>$name, 'compare'=>'like', 'value'=>'%'.$where.'%');
                array_push($arrWhere, $tmp);
            }elseif ($type == 'date_time') {
                $dateRange = explode(' - ', $where);
                if (is_array($dateRange)){
                    foreach ($dateRange as $key => $str) {
                        $timstamp = strtotime(trim($str));
                        $date_time = date('Y-m-d H:i', $timstamp);
                        $compareTime = $key==0?'>=':'<=';
                        $tmp = array('key'=>$name, 'compare'=>$compareTime, 'value'=>$date_time);
                        array_push($arrWhere, $tmp);
                    }
                }
            }else {
                if ($where != '') {
                    $tmp = array('key'=>$name, 'compare'=>"=", 'value'=>$where);
                    array_push($arrWhere, $tmp);
                }
            }
        return $data;
    }

    public function doInsertTable($table, $data)
    {
        $this->processDataBefore($data, $table);
        return \DB::table($table)->insertGetId($data);
    }

    public function doUpdateTable($id, $table, $data)
    {
        $this->processDataBefore($data, $table);
        $update =  \DB::table($table)->where('id', $id)->update($data);
        return $update;
    }

    public function removeDataTable($table, $id)
    {
        $remove = \DB::table($table)->where('id', $id)->delete();
        if ($remove && in_array($table, \App\Models\NTable::$specific['insert'])) {
            $objService = getServiceByTable($table);
            if (method_exists($objService, 'afterRemove')) {
                $objService->afterRemove($id);
            }
        }
        return $remove;
    }
}
