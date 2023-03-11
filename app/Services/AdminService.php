<?php
namespace App\Services;

use App\Constants\OrderConstant;
use App\Services\BaseService;
use Illuminate\Support\Facades\Schema;
use App\Constants\VariableConstant;
class AdminService extends BaseService
{
    function __construct()
    {
    	parent::__construct();
        $this->quote_service = new \App\Services\QuoteService;
    }

    public function checkPermissionAction($table, $action, $id=0)
    {
        $table = in_array($table, \App\Models\Quote::$tableChild)?'quotes':$table;
        $admin = getSessionUser();
        if (@$admin['super_admin']) {
            return true;
        }
        $permissions = $this->roles->getPermissionAction('json_data_role', $table, @$admin['n_group_user_id']);
        $roles = !empty($permissions['json_data_role'])?json_decode($permissions['json_data_role'], true):[];
        if($action == 'view'){
            $viewWhere = [];
            if(empty($roles['view'])){
                if (@$roles['view_my'] == 1) {
                    array_push($viewWhere, ['key'=>'created_by', 'compare'=>'=', 'value'=>$admin['id']]);
                }
            }
            if(@$roles['accept']==1){
                $viewWhere = [['key'=>'status', 'compare'=>'=', 'value'=>OrderConstant::ORDER_NOT_ACCEPTED]];
            }
            $allow = @$roles['view'] == 1|| @$roles['view_my'] == 1 
                    || @$roles['update']==1 || @$roles['update_my']==1
                    || @$roles['accept'] == 1 || @$roles['receive'] == 1;
            return ['allow'=>$allow, 'viewWhere'=>$viewWhere];
        }else{
            if(!@$roles[$action]&&@$roles[$action.'_my']&&Schema::hasColumn($table, 'created_by')){
                $object = getModelByTable($table)->select('created_by')->find($id);
                return @$object['created_by']==$admin['id'];
            }else{
                return @$roles[$action];
            }
        }

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
        $data = $this->list_tables->where('name', $table)->first();
        return $data;
    }

    public function getFieldAction($table, $action = 'view')
    {
        $data = $this->detail_tables->where('table_map', $table)->where('act', 1)->where($action, 1)->orderBy('ord', 'asc')->get();
        return $data;
    }

    public function getBaseTable($table)
    {
    	$data['tableItem'] = $this->getTableItem($table);
        $data['field_shows'] = $this->getFieldAction($table);
        return $data;
    }

    public function getDataBaseView($table, $name='')
    {
        $data = $this->getBaseTable($table);
        $data['page_item'] = @$data['tableItem']['admin_paginate']??10;
        $data['view_type'] = @$data['tableItem']['view_type']??'view';
        $data['field_searchs'] = $this->detail_tables->where('table_map', $table)->where('act', 1)->where('search', 1)->orderBy('ord', 'asc')->get();
        $name = @$data['view_type']=='configs'?'Cài đặt':$name;
        $data['title'] = $name.' '.$data['tableItem']['note'];
        if ($data['view_type']=='configs') {
            $data['regions'] = $this->regions->getRegionOfConfig($table);
        }
        return $data;
    }

    public function getDataSearchTable($table, $arrWhere = array(), $get, $paginate = 10, $order = 'id', $order_by='desc')
    {
        if(!empty($get)){
            if (@$get['page']) {
                unset($get['page']);
            }
            foreach ($get as $key => $where) {
                if (!empty($where)) {
                    $field_id = (int)$key;
                    $field = $this->detail_tables->select('id', 'name', 'view_type')->find($field_id);
                    $name = $field['name'];
                    $type = $field['view_type'];
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
                }
            }
        }
        $data = getDataTable($table, '*', $arrWhere, $paginate, $order, $order_by, false, true);
        return $data;
    }

    private function getDataCustomerType($customer_id, $data)
    {
        if ($customer_id!=0) {
            return \App\Constants\NameConstant::OLD_CUSTOMER;
        }else{
            $dataInsert['name'] = @$data['company_name'];
            $dataInsert['contacter'] = @$data['contacter'];
            $dataInsert['address'] = @$data['address'];
            $dataInsert['email'] = @$data['email'];
            $dataInsert['phone'] = @$data['phone'];
            $dataInsert['act'] = 1;
            $this->doInsertTable('customers', $dataInsert);
            return \App\Constants\NameConstant::NEW_CUSTOMER;
        }
    }

    private function actionRoleByParent($group_id, $id, $action)
    {
        $extend_roles = $this->roles->where('n_group_user_id', $group_id)->get()->toArray();
        $data_action = !empty($extend_roles)?$extend_roles:array();
        if (count($data_action)>0) {
            foreach ($data_action as $data) {
                unset($data['role_id']);
                if ($action=='insert') {
                    $data['n_group_user_id'] = $id;
                    $this->roles->insert($data);
                }else{
                    unset($data['n_group_user_id']);
                    $this->roles->where(['n_group_user_id'=>$id, 'module_id'=>$data['module_id']])->update($data);
                }
            }
        }
    }

    public function doInsertTable($table, $data)
    {
        $data = $this->getDataDoAction($data, $table);
        if (@$data['password']) {
            $data['password'] = md5($data['password']);
        }
        if ($table=='quotes'&&isset($data['customer_id'])) {
            $data['customer_type'] = $this->getDataCustomerType($data['customer_id'], $data);
        }
        if(Schema::hasColumn($table, 'created_by')){
            $data['created_by'] = getSessionUser()['id'];
        }
        $insertID = $this->db::table($table)->insertGetId($data);
        if ($table=='quotes') {
            $this->quote_service->refreshQuoteTotal($insertID);
        }
        if ($table == 'n_group_users' && @$data['parent']) {
            $this->actionRoleByParent($data['parent'], $insertID, 'insert');
        }
        return $insertID;
    }

    private function getPasswordUpdate($table, $id, $password)
    {
        $data = $this->db::table($table)->find($id);
        $new_pass = $password==$data->password?$password:md5($password);
        return $new_pass;
    }

    private function getDataDoAction($data, $table)
    {
        foreach ($data as $key => $item) {
            $field = $this->detail_tables->where(['table_map'=>$table, 'name'=>$key])->first();
            if (@$field['view_type']=='date_time') {
                $data[$key] = getDataDateTime($item);
            }  
        }
        return $data;
    }

    public function doUpdateTable($id, $table, $data)
    {
        $data = $this->getDataDoAction($data, $table);
        if (@$data['password']) {
            $data['password'] = $this->getPasswordUpdate($table, $id, $data['password']);
        }
        if ($table=='quotes'&&isset($data['customer_id'])) {
            $data['customer_type'] = $this->getDataCustomerType($data['customer_id'], $data);
        }
        if ($table == 'n_group_users' && @$data['parent']) {
            $this->actionRoleByParent($data['parent'], $id, 'update');
        }
        $update = $this->db::table($table)->where('id', $id)->update($data);
        if ($table=='quotes') {
            $this->quote_service->refreshQuoteTotal($id);
        }
        return $update;
    }

    public function removeDataTable($table, $id)
    {
        if ($table == 'n_group_users') {
            $this->roles->where('n_group_user_id', $id)->delete();
        }
        if (in_array($table, \App\Models\Quote::$tableChild)) {
        }
        $remove = $this->db::table($table)->where('id', $id)->delete();
        if ($remove && in_array($table, VariableConstant::ACTION_TABLE_SELF)) {
            $objService = getServiceByTable($table);
            $objService->afterRemove($id);
        }
        if ($remove&&in_array($table, \App\Models\Quote::$tableChild)) {
            $this->quote_service->refreshQuoteTotal($quote_id);
        }
        if($table == 'quotes'){
            $this->quote_service->removeDataChild($id);
        }
        return $remove;
    }
}
