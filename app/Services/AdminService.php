<?php
namespace App\Services;

use App\Models\COrder;
use App\Services\BaseService;
use App\Models\NDetailTable;
use App\Models\NLogAction;
use App\Models\NTable;
use App\Models\ProductWarehouse;

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

    public function getFieldAction($table, $action = 'view', $where = [])
    {
        $list = NDetailTable::where(['act' => 1, 'table_map'=> $table, $action => 1])->orderBy('ord', 'asc')->get()->toArray();
        NDetailTable::handleField($list, $action, $where);
        return $list;
    }

    public function getDataActionView($table, $action, $action_name, $param = [], $where = [])
    {
        $data['tableItem'] = $this->getTableItem($table);
        $data['title'] = $action_name.' '.$data['tableItem']['note'];
        $data['parent_url'] = ['link' => getBackUrl(), 'note' => $data['tableItem']['note']];
        $data['field_list'] = $this->getFieldAction($table, $action, $where);
        $data['action_name'] = $action_name;
        $data['default_field'] = $param;
        $data['regions'] = $this->regions->getRegionOfTable($table, $action);
        return $data;
    }

    public function getBaseTable($table)
    {
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
            }
            return $data;
        }
    }

    public function handleFieldView(&$data, $table, $where = [])
    {
        $data_field = $this->getFieldAction($table, 'view', $where);
        $data = $data + $data_field;
        $data['field_searchs'] = $this->getFieldAction($table, 'search', $where);
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
                $name = $field['name'];
                $type = $field['type'];
                if ($type == 'text') {
                    $type_input = @$attr['type_input'] ?? 'text';
                    if (in_array($type_input, ['price', 'number'])) {
                        if (!empty($value['from'])) {
                            $from = (float) $value['from'] - 0.1;
                            $tmp = ['key' => $name, 'compare' => '>=', 'value' => $from];
                            $where[] = $tmp;
                        }
                        if (!empty($value['to'])) {
                            $to = (float) $value['to'] + 0.1;
                            $tmp = ['key' => $name, 'compare' => '<=', 'value' => $to];
                            $where[] = $tmp;
                        }
                    }else{
                        if ($name == 'width' || $name == 'length') {
                            $from_size = (float) $value - 2; 
                            $tmp = ['key' => $name, 'compare' => '>=', 'value' => $from_size];
                            $where[] = $tmp; 

                            $to_size = (float) $value + 3;
                            $tmp = ['key' => $name, 'compare' => '<=', 'value' => $to_size];
                            $where[] = $tmp;   
                        }else{
                            $tmp = ['key' => $name, 'compare' => 'like', 'value' => '%'.$value.'%'];
                            $where[] = $tmp;
                        }
                    }
                }elseif($type == 'child_linking'){
                    $linking_data = @$other_data['data'] ?? [];
                    $field_title = @$linking_data['field_title'] ?? 'name';
                    $field_query = @$linking_data['field_query'];
                    $arr_id = \DB::table($linking_data['table'])->where('act', 1)->where($field_title, 'like', '%'.$value.'%')->pluck($field_query)->all();
                    $where[] = ['key' => 'id', 'compare' => 'in', 'value' => array_unique($arr_id)];
                }elseif($type == 'link_data'){
                    $link_data = @$other_data['data'] ?? [];
                    $link_table = $link_data['table_get'];
                    $condition = $this->getConditionTable($link_table, $link_data['field_get'], $value);
                    $link_obj = getDataTable($link_table, $condition, [], true);
                    $arr_id = $link_obj->pluck('id')->all();
                    $where[] = ['key' => $link_data['field_data'], 'compare' => 'in', 'value' => array_unique($arr_id)];
                }elseif ($type == 'group_product') {
                    if (!empty($value['group'])) {
                        if (!empty($other_data['field_pluck'])) {
                            $product_obj = \DB::table('products')->where(['category' => $value['group']]);
                            if (!empty($value['style'])) {
                                $product_obj->where('product_style', $value['style']);
                            }
                            $arr_id = $product_obj->pluck($other_data['field_pluck'])->all();
                            $where[] = ['key' => 'id', 'compare' => 'in', 'value' => array_unique($arr_id)];
                        }else{
                            $where[] = ['key' => 'category', 'value' => $value['group']];
                            if (!empty($value['style'])) {
                                $where[] = ['key' => 'style', 'value' => $value['style']];
                            }
                        }
                        
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
                        $key_pluck = !empty($other_data['data']['key_pluck']) ? $other_data['data']['key_pluck'] : 'id';
                        $arr_id = $product_obj->pluck($key_pluck)->all();
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
        $process = $this->processDataBefore($data, $table);
        if (@$process['code'] == 100) {
            return $process;
        }
        $id = \DB::table($table)->insertGetId($process['data']);
        if (method_exists($model, 'getInsertCode')) {
            $model::getInsertCode($id);
        }
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
            logActionUserData('remove', $table, $id, $dataItem);
        }
        if ($remove && $except_remove) {
            $objModel = getModelByTable($table);
            if (method_exists($objModel, 'afterRemove')) {
                $objModel->afterRemove($id);
            }
        }
        return $remove;
    }

    public function arrayToCondition($table, $array, &$where)
    {
        foreach ($array as $field_name => $field_value) {
            $conditions = $this->getConditionTable($table, $field_name, $field_value);
            if (!empty($conditions)) {
                foreach ($conditions as $condition) {
                    $where[] = $condition;
                }
            }
        }
        return $where;
    }
    private function getFieldSearchDebt($table, $type, $group_target)
    {
        $ret = [];
        if ($table == 'c_orders') {
            if (in_array($type, [COrder::ADVANCE, COrder::ORDER, COrder::SELL])) {
                $ret[] = NDetailTable::where(['table_map' => $table, 'name' => 'group_customer'])->get()->first();
                if ($type == COrder::ORDER && !$group_target) {
                    $ret[] = NDetailTable::where(['table_map' => $table, 'name' => 'order'])->get()->first();
                    $ret[] = NDetailTable::where(['table_map' => 'orders', 'name' => 'list_product'])->get()->first();
                }
            }
        }else{
            $ret[] = NDetailTable::where(['table_map' => $table, 'name' => 'provider'])->get()->first();
        }
        $ret[] =  [
            'name' => 'created_at',
            'attr' => '{"class_on_search":"change_submit"}',
            'note' => 'Ngày chứng từ',
            'type' => 'datetime',
            'parent' => 0
        ];
        $ret[] = [
            'name' => 'created_by',
            'attr' => '{"class_on_search":"change_submit"}',
            'note' => 'Người lập ',
            'type' => 'linking',
            'other_data' => '{"config":{"search":1},"data":{"table":"n_users"}}',
            'parent' => 0
        ];
        NDetailTable::handleField($ret, 'search');
        return $ret;
    }
    public function getDataDebt($table, $where, $type = '')
    {
        $data = $this->getBaseTable($table);
        $data['table'] = $table;
        $data['field_searchs'] = $this->getFieldSearchDebt($table, $type, !empty($where['group']));
        $this->processDataDebt($table, $where, $data);
        return $data;
    }

    public function processDataDebt($table, $where, &$data){
        $data['data_search'] = $where;
        if (!empty($where['group'])) {
            $group_target = $where['group'];
            unset($where['group']);
            if (!empty($where['order'])) {
                unset($where['order']);
            }
            $data['title_rows'] = '3';
        }else{
            $group_target = false;
        }
        if (!empty($where['list_product'])) {
            $product_sname = $where['list_product'];
            unset($where['list_product']);
        }
        if ($table == 'supply_buyings') {
            $status = \StatusConst::SUBMITED;
            $field_target = 'provider';
        }else{
            $status = \StatusConst::ACCEPTED;
            $field_target = 'customer';
        }
        if (!empty($where[$field_target])) {
            $data['table_template'] = $table . '.template_excel';
            $data['title_rows'] = '3';
        }
        if (!empty($where['created_at'])) {
            $created_at = $where['created_at'];
            unset($where['created_at']);
        }
        $condition = $this->handleDebtCondition($where);
        $obj = getModelByTable($table)::where('status', $status);
        if (!empty($condition)) {
            $obj = $obj->where($condition);
        }
        if (!empty($product_sname) && !$group_target) {
            $q_product = trim($product_sname);
            $arr_pid = ProductWarehouse::where('name', 'like', '%'.$q_product.'%')->pluck('id')->toArray();
            $obj->where(function ($query) use ($arr_pid) {
                foreach ($arr_pid as $id) {
                    $query->orWhereJsonContains('object', ['id' => (string) $id]);
                }
            });
            $obj->orWhere('note', 'like', '%'.$q_product.'%');
        }
        if (!empty($created_at)) {
            $arr_time = getDateRangeToQuery($created_at);
            $obj = $obj->whereBetween('created_at', $arr_time);
            $old_obj = getModelByTable($table)::where('status', $status)->where($condition)->where('created_at', '<', $arr_time[0]);
            $old_total = $old_obj->sum('total');
            $old_advance = $old_obj->sum('advance');
            $old_rest = $old_total - $old_advance;
        }else{
            $old_total = $old_advance = $old_rest = 0;     
        }
        $data['old_total'] = $old_total;
        $data['old_advance'] = $old_advance;
        $data['old_rest'] = $old_rest;
        $data['total_amount'] = $obj->sum('total') + $old_total;
        $data['total_advance'] = $obj->sum('advance') + $old_advance;
        $data['total_rest'] = ($data['total_amount'] - $data['total_advance']);
        $data_tables = $obj->orderBy('id', 'DESC')->take(200);
        if (!empty($group_target)) {
            $data['data_tables'] = $data_tables->groupBy($field_target)->get()->map(
                function($data_table) use ($table, $status, $condition, $field_target){
                    $obj_with_target = getModelByTable($table)::where('status', $status)
                    ->where($condition)->where($field_target, $data_table->{$field_target});
                    $data_table->total = $obj_with_target->sum('total');
                    $data_table->advance = $obj_with_target->sum('advance');
                    return $data_table;
                }
            );
            $data['range_time'] = !empty($created_at) ? $created_at : 'Toàn bộ thời gian'; 
            $data['group_target'] = true; 
        }else{
            $data['data_tables'] = $data_tables->get();
        }
    }

    private function handleDebtCondition($where)
    {
        $condition = [];
        foreach ($where as $key => $value) {
            if (!empty($value)) {
                $condition[] = [$key, '=', $value];
            } 
        }
        return $condition;
    }

    public function tableDataInventoryDetail($wheres, $table, &$data)
    {
        $where = [];
        foreach ($wheres as $key => $value) {
            if (!empty($value)) {
                if ($key == 'price'){
                    if (!empty($value['from'])) {
                        $where[] = [$key, '>=', $value['from']];
                    }
                    if (!empty($value['to'])) {
                        $where[] = [$key, '<=', $value['to']];
                    }
                }elseif($key == 'created_at'){
                    $arr_time = getDateRangeToQuery($value); 
                    $where[] = [$key, '>=', $arr_time[0]];
                    $where[] = [$key, '<=', $arr_time[1]];   
                }else{
                    $where[] = [$key, '=', $value];
                }
            }
        }
        $obj = getModelByTable($table)::where($where);
        $data['data_item'] = $wheres;
        $list_data = $obj->orderBy('id', 'DESC')->get();
        $data['count'] = $list_data->count();
        $data['price'] = $list_data->sum('price');
        $data['imported'] = $list_data->sum('imported');
        $data['exported'] = $list_data->sum('exported');
        $data['inventory'] = $list_data->sum('inventory');
        $data['list_data'] = $list_data;
    }

    public function CSupplyInsertView($action)
    {
        $data = $this->getDataActionView('c_supplies', $action, $action == 'insert' ? 'Thêm mới' : 'Chi tiết');
        $field_list = $data['field_list'];
        $data['field_type'] = array_slice($field_list, 0, 1);
        $data['field_action'] = array_slice($field_list, 1);
        return $data;
    }
}
