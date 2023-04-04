<?php
if (!function_exists('returnMessageAjax')) {
    function returnMessageAjax($code, $message, $url = '')
    {
        $ret = !empty($url) ? ['code' => $code, 'message' => $message, 'url' => $url] : ['code' => $code, 'message' => $message];
        return $ret;
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

if (! function_exists('getDetailDataByID')) {
    function getDetailDataByID($model, $id)
    {
        $models = getModelByClass($model);
        $data = $models->find($id);
        return $data;
    }
}


if(!function_exists('getFieldDataById')){
    function getFieldDataById($feild, $table, $id){
        if (!empty($id)) {
            $data = \DB::table($table)->select($feild)->find($id);
            return !empty($data->$feild) ? $data->$feild : '';
        }else{
            return false;
        }
    }
}

if (!function_exists('getIdByFeildValue')) {
    function getIdByFeildValue($class, $where)
    {
        $models = getModelByClass($class);
        $data = $models::select('id')->where($where)->first();
        return @$data['id']?$data['id']:0;
    }
}

if (!function_exists('getDataTable')) {
    function getDataTable($table, $where = [], $param)
    {
        $select = @$param['select'] ?? '*';
        $paginate = @$param['paginate'] ?? 0;
        $order = @$param['order'] ?? 'id';
        $order_by = @$param['order_by'] ?? 'desc';
        $table = \DB::table($table)->select($select);
        if (!empty($where)) {
            foreach ($where as $key => $w) {
                $value = @$w['compare'] == 'like' ? '%'.@$w['value'].'%' : @$w['value'];
                if ($key == 'or') {
                    $table->orWhere($w['key'], $w['compare'], $value);
                }else{
                    $table->where($w['key'], $w['compare'], $value);  
                }
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

if (!function_exists('getDataDateTime')) {
    function getDataDateTime($time){
        $timstamp = strtotime($time);
        return date('Y-m-d h:i:s', @$timstamp);    
    }
}

if (!function_exists('getCountDataTable')) {
    function getCountDataTable($table, $where = [])
    {
        if (Schema::hasTable($table)) {
            return \DB::table($table)->where($where)->count();
        }
        return 0;
    }
}

if (!function_exists('isHome')) {
    function isHome()
    {
        return url()->current() == url('');
    }
}

if (!function_exists('getInsertNextId')) {
    function getInsertNextId($table)
    {
        $id = \DB::select("SHOW TABLE STATUS LIKE '".$table."'");
        return $id[0]->Auto_increment;
    }
}

if (!function_exists('getCodeInsertTable')) {
    function getCodeInsertTable($table, $num = '06')
    {
        return sprintf("%".$num."s", getInsertNextId($table));
    }
}

if (!function_exists('checkEmptyValue')) {
    function checkEmptyValue($value, $type = 'str'){
       
    }
}
