<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\NDetailTable;
use App\Models\NLogAction;
use App\Models\NTable;
class AdminService extends BaseService
{
    function __construct()
    {
    	parent::__construct();
        $this->quote_service = new \App\Services\QuoteService;
    }

    public function checkPermissionAction($table, $action, $data = new \stdClass())
    {
        if(\GroupUser::isAdmin()){
            return ['allow' => true];   
        }
        $model = getModelByTable($table);
        $role = method_exists($model, 'getRole') ? $model::getRole() : [];
        if(count($role) == 0){
            return ['allow' => false];
        }
        if (!empty($role[$action]['all']) || (!empty($role[$action]) && $role[$action] == 1)) {
            return ['allow' => true];
        }
        if (!empty($role[$action]['with'])) {
            if ($action == 'view') {
                return ['allow' => true, 'where' => $role[$action]['with']];
            }else{
                return ['allow' => getBoolByCondArr($role[$action]['with'], $data)];
            }
        }
        
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
        $list = NDetailTable::where(['act' => 1, 'table_map'=> $table, $action => 1])->orderBy('ord', 'asc')->get()->toArray();
        NDetailTable::handleField($list, $action);
        return $list;
    }

    public function getDataActionView($table, $action, $action_name, $param = [])
    {
        $data['tableItem'] = $this->getTableItem($table);
        $data['title'] = $action_name.' '.$data['tableItem']['note'];
        $data['parent_url'] = ['link' => getBackUrl(), 'note' => $data['tableItem']['note']];
        $data['field_list'] = $this->getFieldAction($table, $action);
        $data['action_name'] = $action_name;
        $data['default_field'] = $param;
        $data['regions'] = $this->regions->getRegionOfTable($table);
        return $data;
    }

    public function getBaseTable($table)
    {
        $data = $this->getFieldAction($table);
    	$data['tableItem'] = $this->getTableItem($table);
        $data['parent_url'] = !empty($data['tableItem']['parent']) ? json_decode($data['tableItem']['parent'], true) : [];
        return $data;
    }

    public function getDataBaseView($table, $name='')
    {
        $data = $this->getBaseTable($table);
        if (!empty($data['tableItem'])) {
            $data['page_item'] = @$data['tableItem']['admin_paginate'] ?? 10;
            $data['view_type'] = @$data['tableItem']['view_type'] ?? 'view';
            $name = @$data['view_type'] == 'config' ? 'Cài đặt' : $name;
            $data['title'] = $name.' '.$data['tableItem']['note'];
            if ($data['view_type']=='config') {
                $data['regions'] = $this->regions->getRegionOfConfig($table);
            }else{
                $data['field_searchs'] = $this->getFieldAction($table, 'search');
            }
            return $data;
        }
    }

    public function getConditionTable($table, $field_name, $value)
    {
        if (isset($value)) {
            $field = NDetailTable::select('id', 'attr', 'name', 'type', 'other_data')->where(['act' => 1, 'table_map' => $table, 'name' =>$field_name])->first();
            if (empty($field)) {
                $where[] = ['key' => $field_name, 'value' => $value];
            }else{
                $other_data = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                $attr = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
                $type_input = @$attr['type_input'] ?? 'text';
                $name = $field['name'];
                $type = $field['type'];
                if ($type == 'text') {
                    if (in_array($type_input, ['price', 'number'])) {
                        if (!empty($value['from'])) {
                            $from = (float) $value['from'];
                            $tmp = ['key' => $name, 'compare' => '>=', 'value' => $from];
                            $where[] = $tmp;
                        }
                        if (!empty($value['to'])) {
                            $to = (float) $value['to'];
                            $tmp = ['key' => $name, 'compare' => '<=', 'value' => $to];
                            $where[] = $tmp;
                        }
                    }else{
                        $tmp = ['key' => $name, 'compare' => 'like', 'value' => '%'.$value.'%'];
                        $where[] = $tmp;
                    }
                }elseif($type == 'child_linking'){
                    $linking_data = @$other_data['data'] ?? [];
                    $field_title = @$linking_data['field_title'] ?? 'name';
                    $field_query = @$linking_data['field_query'];
                    $arr_id = \DB::table($linking_data['table'])->where('act', 1)->where($field_title, 'like', '%'.$value.'%')->pluck($field_query)->all();
                    $where[] = ['key' => 'id', 'compare' => 'in', 'value' => array_unique($arr_id)];
                }elseif ($type == 'group_product' && !empty($other_data['field_pluck'])) {
                    if (!empty($value['group'])) {
                        $product_obj = \DB::table('products')->where(['category' => $value['group']]);
                        if (!empty($value['style'])) {
                            $product_obj->where('product_style', $value['style']);
                        }
                        $arr_id = $product_obj->pluck($other_data['field_pluck'])->all();
                        $where[] = ['key' => 'id', 'compare' => 'in', 'value' => array_unique($arr_id)];
                    }
                }elseif ($type == 'product_size') {
                    $product_obj = \DB::table('products');
                    if (!empty($value['length'])) {
                        $product_obj->where('length', $value['length']);
                    }
                    if (!empty($value['width'])) {
                        $product_obj->where('width', $value['width']);
                    }
                    if (!empty($value['height'])) {
                        $product_obj->where('height', $value['height']);
                    }
                    if (!empty($value['length']) || !empty($value['width']) || !empty($value['height'])) {
                        $arr_id = $product_obj->pluck('quote_id')->all();
                        $where[] = ['key' => 'id', 'compare' => 'in', 'value' => array_unique($arr_id)];
                    }
                }elseif ($type == 'customer_city') {
                    if (!empty($value)) {
                        $customers = \DB::table('customers')->where('city', $value);
                        $arr_id = $customers->pluck('id')->all();
                        $where[] = ['key' => 'customer', 'compare' => 'in', 'value' => array_unique($arr_id)];
                    }
                    
                }elseif ($type == 'datetime') {
                    $date_range = explode(' - ', $value);
                    if (is_array($date_range)){
                        foreach ($date_range as $key => $str) {
                            $timstamp = strtotime(str_replace('/', '-', $str));
                            $date_time = date('Y-m-d H:i:s', $timstamp);
                            $compare_time = $key == 0 ? '>=' : '<=';
                            $tmp = ['key' => $name, 'compare' => $compare_time, 'value' => $date_time];
                            $where[] = $tmp;
                        }
                    }
                }else {
                    $where[] = ['key' => $field_name, 'value' => $value];
                }
            }
            return @$where ?? [];
        }
    }

    public function doInsertTable($table, $data)
    {
        $model = getModelByTable($table);
        if (method_exists($model, 'getInsertCode')) {
            $data['code'] = $model::getInsertCode();
        }
        $process = $this->processDataBefore($data, $table);
        if (@$process['code'] == 100) {
            return $process;
        }
        $id = \DB::table($table)->insertGetId($process['data']);
        return ['code' =>  200, 'id' => $id];
    }

    public function doUpdateTable($id, $table, $data)
    {
        $data['id'] = $id;
        $process = $this->processDataBefore($data, $table);
        if (@$process['code'] == 100) {
            return $process;
        }
        $object = \DB::table($table)->where('id', $id);
        $update = $object->update($process['data']);
        if ($update) {
            return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!');
        }else{
            return returnMessageAjax(100, 'Không có thay đổi dữ liệu !');
        }
    }

    public function removeDataTable($table, $id)
    {
        $except_remove = in_array($table, NTable::$specific['remove']);
        $dataItem = \DB::table($table)->find($id);
        if ($except_remove) {
            $objModel = getModelByTable($table);
            if (method_exists($objModel, 'beforeRemove')) {
                $objModel->beforeRemove($id, $dataItem);
            }
        }
        $remove = \DB::table($table)->where('id', $id)->delete();
        NLogAction::where('target', $id)->delete();
        if ($remove) {
            logActionUserData(__FUNCTION__, $table, $id, $dataItem);
        }
        if ($remove && $except_remove) {
            $objModel = getModelByTable($table);
            if (method_exists($objModel, 'afterRemove')) {
                $objModel->afterRemove($id);
            }
        }
        return $remove;
    }
}
