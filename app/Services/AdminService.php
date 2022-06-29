<?php
namespace App\Services;
use App\Constants\StattusConstant;
use App\Services\BaseService;
class AdminService extends BaseService
{ 
    function __construct()
    {
    	parent::__construct();
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
        $data['page_item'] = isset($data['tableItem']['admin_paginate'])?$data['tableItem']['admin_paginate']:10;
        $data['view_type'] = isset($data['tableItem']['view_type'])?$data['tableItem']['view_type']:'view';
        $data['field_searchs'] = $this->detail_tables->where('table_map', $table)->where('act', 1)->where('search', 1)->orderBy('ord', 'asc')->get();
        $data['title'] = $name.' '.$data['tableItem']['note'];
        if ($data['view_type']=='config') {
            $data['regions'] = $this->regions->getRegionOfConfig($table);   
        }
        return $data;
    }

    public function getDataSearchTable($table, $get, $paginate = 10, $order = 'id', $order_by='desc')
    {
        $arrWhere = array();
        foreach ($get as $key => $where) {
            if (strpos($key, 'from_')!==false) {
                $field_id = str_replace('from_', '', $key);
                $compareTime = '>=';    
            }elseif (strpos($key, 'to_')!==false) {
                $field_id = str_replace('to_', '', $key);
                $compareTime = '<=';        
            }else {
                $field_id = (int)$key;   
            }
            $field = $this->detail_tables->select('id', 'name', 'view_type')->find($field_id);
            $name = $field['name'];
            $type = $field['view_type'];
            if ($type == 'text') {
                $tmp = array('key'=>$name, 'compare'=>'like', 'value'=>'%'.$where.'%');
                array_push($arrWhere, $tmp);       
            }elseif ($type == 'date_time') {
                $timstamp = strtotime($where);
                $date_time = date('y-m-d h:i:s', $timstamp);
                $tmp = array('key'=>$name, 'compare'=>$compareTime, 'value'=>$date_time);
                array_push($arrWhere, $tmp);       
            }else {
                if ($where != '') {
                    $tmp = array('key'=>$name, 'compare'=>"=", 'value'=>$where);
                    array_push($arrWhere, $tmp);        
                }    
            }
        }
        $data = getDataTable($table, '*', $arrWhere, $paginate);
        return $data;
    }

    public function doInsertTable($table, $data)
    {
        if (@$data['password']) {
            $data['password'] = md5($data['password']);    
        }
        $data['created_at'] = date('y-m-d h:i:s', Time());
        $data['updated_at'] = date('y-m-d h:i:s', Time());
        $insertID = $this->db::table($table)->insertGetId($data);
        return $insertID;
    }

    private function getPasswordUpdate($table, $id, $password)
    {
        $data = $this->db::table($table)->find($id);
        $new_pass = $password==$data->password?$password:md5($password);
        return $new_pass;
    }

    public function doUpdateTable($id, $table, $data)
    {
        if (@$data['password']) {
            $data['password'] = $this->getPasswordUpdate($table, $id, $data['password']);    
        }
        $created_at = @$data['created_at']?strtotime($data['created_at']):Time();
        $data['created_at'] = date('y-m-d h:i:s',$created_at);
        $data['updated_at'] = date('y-m-d h:i:s', Time());
        $update = $this->db::table($table)->where('id', $id)->update($data);
        return $update;
    }

    private function removeRole($group_user_id)
    {
        $this->roles->where('n_group_user_id', $group_user_id)->delete();
    }

    public function removeDataTable($table, $id)
    {
        if ($table == 'n_group_users') {
            $this->removeRole($id);     
        }
        $remove = $this->db::table($table)->where('id', $id)->delete();
        return $remove;
    }

}
