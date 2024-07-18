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
        return @$data['id'] ? $data['id']:0;
    }
}

if (!function_exists('insertGetIdData')) {
    function insertGetIdData($table, $data)
    {
        (new \BaseService)->configBaseDataAction($data);
        return \DB::table($table)->insertGetId($data);
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
                    if (@$w['con'] == 'or') {
                        $query->orWhereIn($w['key'], $value);
                    }else{
                        $query->whereIn($w['key'], $value);
                    }
                }elseif($compare == 'not_in'){
                    if (@$w['con'] == 'or') {
                        $query->orWhereNotIn($w['key'], $value);
                    }else{
                        $query->whereNotIn($w['key'], $value);
                    }
                }elseif (@$w['compare'] == 'month') {
                    switch (@$w['value']) {
                        case 'this_month':
                            $value = \Carbon\Carbon::now()->month;
                            break;
                        case 'this_year':
                            $value = \Carbon\Carbon::now()->year;
                            break;
                        default:
                            $value = @$w['value'];
                            break;
                    }
                    $query->whereMonth($w['key'], $value);
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
    function getDataTable($table, $where = [], $param = [], $get_obj = false, $last_query = false)
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
        if ($get_obj) {
            return $query;
        }
        if ($paginate>0) {
            $data = $query->orderBy($order, $order_by)->paginate($paginate);
        }elseif($limit > 0){
            $data = $query->orderBy($order, $order_by)->take($limit, $offset);
        }
        else{
            $data = $query->orderBy($order, $order_by)->get();
        }
        if ($last_query) {
            dump($data);
            dd(\DB::getQueryLog());
        }
        return $data;
    }
}

if (!function_exists('getBoolByCondArr')) {
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
    function calValuePercentPlus($value, $get_perc, $perc, $plus = 0, $round = false)
    {
        $add_percent = (float) $get_perc * (float) $perc / 100;
        $ret = (float) $value + $add_percent + (float) (float) $plus;
        return $round ? ceil($ret) : $ret;
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

if (!function_exists('getDateRangeToQuery')) {
    function getDateRangeToQuery($date_range)
    {
        $arr_date = explode(' - ', $date_range);
        foreach ($arr_date as $key => $str) {
            $timstamp = strtotime(str_replace('/', '-', $str));
            $arr_date[$key] = date('Y-m-d H:i:s', $timstamp);
        }
        return $arr_date;
    }
}

if (!function_exists('getDataDateTime')) {
    function getDataDateTime($time){
        $timstamp = getTimeStamp((string) $time);
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
    function isHome($module = '')
    {
        return url()->current() == url($module);
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
    function getCodeInsertTable($table, $num = '08')
    {
        return sprintf("%".$num."s", getInsertNextId($table));
    }
}

if (!function_exists('formatCodeInsert')) {
    function formatCodeInsert($id, $num = '08')
    {
        return sprintf("%".$num."s", $id);
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

if (!function_exists('getFieldDataByWhere')) {
    function getFieldDataByWhere($field, $table, $where)
    {
        $obj = \DB::table($table)->where($where)->first();
        return @$obj->{$field};
    }
}

if (!function_exists('getDataByWhere')) {
    function getDataByWhere($table, $where)
    {
        $obj = \DB::table($table)->where($where)->first();
        return @$obj;
    }
}

if (!function_exists('limitStr')) {
    function limitStr($str, $limit, $offset = 0)
    {
        return strlen($str) > $limit ? substr($str, $offset, $limit) . '...' : $str;
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

if (!function_exists('isLocal')) {
    function isLocal()
    {
        return @$_ENV['APP_ENV'] == 'local';
    }
}

if (!function_exists('allModule')) {
    function allModule()
    {
        $modules_path = dirname(__DIR__) . '/app/Modules/';
	    return is_dir($modules_path) ? scandir($modules_path) : [];
    }
}

if (!function_exists('currentModule')) {
    function currentModule()
    {
        $seg = request()->segment(1);
        return in_array($seg, allModule()) ? $seg : '';
    }
}

if (!function_exists('getCharacter')) {
    function getCharaterByNum($num)
    {
        $result = '';
        while ($num >= 0) {
            $remainder = $num % 26;
            $result = chr(65 + $remainder) . $result;
            $num = intdiv($num, 26) - 1;
        }
        return $result;
    }
}

if (!function_exists('convertNumerToText')) {
    function convertNumerToText($number) {
 
		$hyphen      = ' ';
		$conjunction = ' ';
		$separator   = ' ';
		$negative    = 'âm ';
		$decimal     = ' phẩy ';
		$one		 = 'mốt';
		$ten         = 'lẻ';
		$dictionary  = array(
		0                   => 'Không',
		1                   => 'Một',
		2                   => 'Hai',
		3                   => 'Ba',
		4                   => 'Bốn',
		5                   => 'Năm',
		6                   => 'Sáu',
		7                   => 'Bảy',
		8                   => 'Tám',
		9                   => 'Chín',
		10                  => 'Mười',
		11                  => 'Mười một',
		12                  => 'Mười hai',
		13                  => 'Mười ba',
		14                  => 'Mười bốn',
		15                  => 'Mười lăm',
		16                  => 'Mười sáu',
		17                  => 'Mười bảy',
		18                  => 'Mười tám',
		19                  => 'Mười chín',
		20                  => 'Hai mươi',
		30                  => 'Ba mươi',
		40                  => 'Bốn mươi',
		50                  => 'Năm mươi',
		60                  => 'Sáu mươi',
		70                  => 'Bảy mươi',
		80                  => 'Tám mươi',
		90                  => 'Chín mươi',
		100                 => 'trăm',
		1000                => 'nghàn',
		1000000             => 'triệu',
		1000000000          => 'tỷ',
		1000000000000       => 'nghìn tỷ',
		1000000000000000    => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
		);
		 
		if (!is_numeric($number)) {
			return false;
		}
		if ($number < 0) {
			return $negative . convertNumerToText(abs($number));
		}
		 
		$string = $fraction = null;
		 
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
			break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= strtolower( $hyphen . ($units==1?$one:$dictionary[$units]) );
				}
			break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= strtolower( $conjunction . ($remainder<10?$ten.$hyphen:null) . convertNumerToText($remainder) );
				}
			break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number - ($numBaseUnits*$baseUnit);
				$string = convertNumerToText($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= strtolower( $remainder < 100 ? $conjunction : $separator );
					$string .= strtolower( convertNumerToText($remainder) );
				}
			break;
		}
		 
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}

		return $string;
	}

    if (!function_exists('getSizeByCodeMisa')) {
        function getSizeByCodeMisa($str, $get)
        {
            $arr = explode('_', $str);
            if (count($arr) < 2) {
                return $str;   
            }
            $arr_size = preg_split('/x/i', $arr[1]);
            if (count($arr_size) < 2) {
                return $str;   
            }
            $size_0 = (int) $arr_size[0];
            $size_1 = (int) $arr_size[1];
            if ($get == 'length') {
                $ret = $size_0 > $size_1 ? $size_0 : $size_1;
            }else{
                $ret = $size_0 > $size_1 ? $size_1 : $size_0;
            }
            return $ret;
        }
    }

    if (!function_exists('getQtvByCodeMisa')) {
        function getQtvByCodeMisa($code, $type)
        {
            $arr = explode('_', $code);
            return str_ireplace($type, '', $arr[0]);   
        }
    }
}

