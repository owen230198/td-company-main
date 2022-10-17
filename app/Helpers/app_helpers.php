<?php
if(!function_exists('echoJson')){
    function echoJson($code,$message){
        $obj = new stdClass();
        $obj->code= $code;
        $obj->message= $message;
        echo json_encode($obj);
    }
}

if(!function_exists('getDataConfigs')){
    function getDataConfigs($classConfig, $keyword = ''){
        $configs = getModelByClass($classConfig);
        $data = $configs->where('keyword', $keyword)->first();
        return $data!=null?$data['value']:'';
    }
}

if (! function_exists('getModelByClass')) {
    function getModelByClass($class)
    {
        $useObject = '\App\Models\\'.$class;
        $models = new $useObject;
        return $models;
    }
}

if (!function_exists('getClassByTable')){
    function getClassByTable($table){
        $str = new \Illuminate\Support\Str;
        return $str::studly(Str::singular($table));
    }
}

if (! function_exists('getModelByTable')) {
    function getModelByTable($table)
    {
        $class = getClassByTable($table);
        $useObject = '\App\Models\\'.$class;
        $models = new $useObject;
        return $models;
    }
}

if (!function_exists('getObjectByTable')) {
    function getObjectByTable($table)
    {
        $class = getClassByTable($table);
        $useObject = '\App\Http\Controllers\\'.$class.'\\'.$class.'Controller';
        return new $useObject;
    }
}

if (! function_exists('getNameByDefaultData')) {
    function getNameByDefaultData($default_data, $value)
    {
        if (@$default_data->table) {
            $models = getModelByClass($default_data->table);
            $table = $models->select('name')->find($value);
            $title = @$table['name']?$table['name']:'Không xác định';
        }else {
            $list_option = $default_data->option;
            $title = @$list_option->$value?$list_option->$value:'Không xác định';
        }
        return $title;
    }
}

if (! function_exists('getNameTableById')) {
    function getNameTableById($model, $id)
    {
        $models = getModelByClass($model);
        $data = $models->find($id);
        return $data['name'];
    }
}

if (! function_exists('getDetailDataByID')) {
    function getDetailDataByID($model, $id)
    {
        $models = getModelByClass($model);
        $data = $models->find($id);
        return $data;
    }
}

if(!function_exists('getRoleByModule')){
    function getRoleByModule($group, $module){
        $roles = new \App\Models\NRole;
        $role = $roles::where('module_id', $module)->where('group_user_id', $group)->first();
        return $role;
    }
}

if(!function_exists('getFieldDataById')){
    function getFieldDataById($feild = '*', $class, $id){
        $models = getModelByClass($class);
        $data = $models::select($feild)->find($id);
        return $data[$feild];
    }
}

if (!function_exists('getIdByFeildValue')) {
    function getIdByFeildValue($class, $feild, $value)
    {
        $models = getModelByClass($class);
        $data = $models::select('id')->where($feild, $value)->first();
        return @$data['id']?$data['id']:0;
    }
}

if (!function_exists('hasChild')) {
    function hasChild($class, $id)
    {
        $models = getModelByClass($class);
        $count = $models::where('parent', $id)->count();
        return $count>0?true:false;
    }
}

if (!function_exists('getDataTable')) {
    function getDataTable($table, $select = "*", $where = array(), $paginate = 0, $order ='id', $order_by = 'desc')
    {
        $db = new \Illuminate\Support\Facades\DB;
        $table = $db::table($table)->select($select);
        if (count($where)>0) {
            foreach ($where as $w) {
                $table->where($w['key'], $w['compare'], $w['value']);
            }
        }
        if ($paginate>0) {
            $data = $table->orderBy($order, $order_by)->paginate($paginate);
        }else{
            $data = $table->orderBy($order, $order_by)->get();
        }
        return $data;
    }
}

if (!function_exists('getValueWithPlusPercent')) {
    function getValueWithPlusPercent($number = 0, $percent =0)
    {
        $add_percent = (int)$number*(int)$percent/100;
        $total = $number + $add_percent;
        return $total;
    }
}

if (!function_exists('getServiceByTable')) {
    function getServiceByTable($table)
    {
        $str = new \Illuminate\Support\Str;
        $class = $str::studly(Str::singular($table));
        $useObject = '\App\Services\\'.$class.'Service';
        $object = new $useObject;
        return $object;
    }
}

