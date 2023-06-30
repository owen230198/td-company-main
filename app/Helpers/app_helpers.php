<?php
if (!function_exists('returnMessageAjax')) {
    function returnMessageAjax($code, $message, $url = '')
    {
        $ret = !empty($url) ? ['code' => $code, 'message' => $message, 'url' => $url] : ['code' => $code, 'message' => $message];
        return $ret;
    }
}

if(!function_exists('getDataConfig')){
    function getDataConfig($classConfig, $keyword = '', $default = ''){
        $configs = getModelByClass($classConfig);
        $data = $configs->select('value')->where('keyword', $keyword)->first();
        return !empty($data['value']) ? $data['value'] : $default;
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
            if (is_array($id)) {
                $data = \DB::table($table)->select($feild)->where($id)->first();
            }else{
                $data = \DB::table($table)->select($feild)->find($id);
            }
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

if (!function_exists('handleQueryCondition')) {
    function handleQueryCondition(&$query, $where){
        foreach ($where as $w) {
            if (!empty($w['type']) && $w['type'] == 'group' && !empty($w['query'])) {
                $gr_where = $w['query'];
                if (@$w['con'] == 'or') {
                    $query->orWhere(function($query) use($gr_where){
                        handleQueryCondition($query, $gr_where);
                    }); 
                }else{
                    $query->where(function($query) use($gr_where){
                        handleQueryCondition($query, $gr_where);
                    }); 
                }
            }else{
                $compare = !empty($w['compare']) ? $w['compare'] : '=';
                $value = $compare == 'like' ? '%'.$w['value'].'%' : $w['value'];
                if ($compare == 'in') {
                    $query->whereIn($w['key'], $value);
                }elseif($compare == 'not_in'){
                    $query->whereNotIn($w['key'], $value);
                }else{
                    if (@$w['con'] == 'or') {
                        $query->orWhere($w['key'], $compare, $value);
                    }else{
                        $query->where($w['key'], $compare, $value);  
                    }
                }
            }
        }
    }
}

if (!function_exists('getDataTable')) {
    function getDataTable($table, $where = [], $param, $last_query = false)
    {
        if ($last_query) {
            \DB::enableQueryLog();
        }
        $select = @$param['select'] ?? '*';
        $paginate = @$param['paginate'] ?? 0;
        $limit = @$param['limit'] ?? 0;
        $offset = @$param['offset'] ?? 0;
        $order = @$param['order'] ?? 'id';
        $order_by = @$param['order_by'] ?? 'desc';
        $query = \DB::table($table)->select($select);
        if (!empty($where)) {
            handleQueryCondition($query, $where);
        }
        if ($paginate>0) {
            $data = $query->orderBy($order, $order_by)->paginate($paginate);
        }elseif($limit > 0){
            $data = $query->orderBy($order, $order_by)->take($limit, $offset);
        }
        else{
            $data = $table->orderBy($order, $order_by)->get();
        }
        if ($last_query) {
            dump($data);
            dd(\DB::getQueryLog());
        }
        return $data;
    }
}

if (!function_exists('')) {
    function getBoolByCondArr($arr, $data)
    {
        $ret = true;
        foreach ($arr as $cond) {
            if (!empty($cond['type']) && $cond['type'] == 'group') {
                $ret = getBoolByCondArr($cond['query'], $data);
                if (@$cond['con'] == 'or' && $ret == true) {
                    return true;
                    break;
                }
            }else{
                if (@$cond['con'] == 'or' && @$data[$cond['key']] == $cond['value']) {
                    return true;
                    break;   
                }
                if (@$data[$cond['key']] != $cond['value']) {
                    $ret = false;
                }  
            }
        }
        return $ret;
    }
}

if (!function_exists('calValuePercentPlus')) {
    function calValuePercentPlus($value, $get_perc, $perc, $plus =0)
    {
        $add_percent = (int) $get_perc * (int) $perc / 100;
        return $value + $add_percent + (int) $plus;
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

if (!function_exists('getTimeStamp')) {
    function getTimeStamp($time)
    {
        return \Carbon\Carbon::createFromFormat('d/m/Y H:i', $time)->timestamp;
    }
}

if (!function_exists('getDataDateTime')) {
    function getDataDateTime($time){
        $timstamp = getTimeStamp($time);
        return date('Y-m-d H:i:s', @$timstamp);    
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

if (!function_exists('getParamUrlByArray')) {
    function getParamUrlByArray($arr){
        $param = '';
        foreach ($arr as $key => $value) {
            $param .= $param == '' ? '?'.$key.'='.$value : '&'.$key.'='.$value;
        }
        return $param;
    }
}

if (!function_exists('subStringLimit')) {
    function subStringLimit($str, $limit, $type = 'char') {
        if ($type == 'char') {
            if (strlen($str) > $limit) {
                $str  = substr($str, 0, $limit - 3) . '...';
            }
        }else{
            if (str_word_count($str, 0) > $limit) {
                $words = str_word_count($str, 3);
                $pos   = array_keys($words);
                $str  = substr($str, 0, $pos[$limit]) . '...';
            }
        }
        return $str;
    }
    
    if (!function_exists('customReturnMessage')) {
        function customReturnMessage($pass, $ajax, $param)
        {
            if ($ajax) {
                $code = $pass ? 200 : 100;
                return returnMessageAjax($code, $param['message'], @$param['url']);
            }else{
                $key = $pass ? 'message' : 'error';
                $ret = !empty($param['url']) ? redirect($param['url']) : back();
                return $ret->with($key, $param['message']);  
            }     
        }
    }
}
