<?php
if(!function_exists('getBreadcrumb')){
    function getBreadcrumb($table,$pid,$currentName){
        $arrBreadcrumbs =array_reverse(getBreadcrumbFull($table,$pid,""));
        $obj = new stdClass();
        $obj->name=$currentName;
        $obj->url= URL::current();
        array_push($arrBreadcrumbs, $obj);
        echo '<ul class="breadcrumb clearfix" itemscope itemtype="http://schema.org/BreadcrumbList" >';
        for ($i=0;$i<count($arrBreadcrumbs);$i++) {
            $item = $arrBreadcrumbs[$i];
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
            if($item->url=="#"){
                echo '<span itemprop="name">'.$item->name.'</span>';
            }
            else{
                echo '<a itemprop="item"  href="'.$item->url.'">';
                echo '<span itemprop="name">'.$item->name.'</span></a>';
            }
            echo '<meta itemprop="position" content="'.($i+1).'">';
            echo '</li>';
        }
        echo "</ul>";
    }
}
if(!function_exists('getBreadcrumbFull')){
    function getBreadcrumbFull($table, $pid,$div){
        $ret = array();
        if(strlen($pid)<=0 || $pid==0) {
            $obj = new stdClass();
            $obj->url = url('');
            $obj->name = 'Trang chủ';
            array_push($ret, $obj);
            return $ret;
        }
        if(is_string($pid)){
            $sub = explode(',', $pid);
            $pid = $sub[0];
        }
        else{
           $pid = $pid;
        }
        $model = getModelByTable($table);
        $arr = $model->find($pid)->toArray();
        if(count($arr)>0){
            if(array_key_exists('parent', $arr)){
                $_ret = getBreadcrumbFull($table,$arr['parent'],"");
                $obj = new stdClass();
                $obj->url = @$arr['slug']?$arr['slug']:'view/'.$arr['name'];
                $obj->name = $arr['name'];
                array_push($ret, $obj);
                $ret = array_merge($ret,$_ret);
            }
        }
        return $ret;
    }
}


if(!function_exists('recursive')){
    function recursive($array, $parent = 0, $level = 0){
        $data = array();
        foreach ($array as $key => $item) {
            if ($item['parent'] == $parent) {
                $item['level'] = $level;
                $data[] = $item;
                unset($array[$key]);
                $child = recursive($array, $item['id'], $level + 1);
                $data = array_merge($data, $child);
            }
        }
        return $data;
    }
}

if (!function_exists('getActionByKey')) {
    function getActionByKey($keyword)
    {
        switch ($keyword) {
            case 'insert':
                return 'Thêm mới';
                break;
            case 'update':
                return 'Chỉnh sửa';
                break;
            case 'clone':
                return 'Sao chép';
                break;
            case 'remove':
                return 'Xóa';
                break;
            default:
                return '';
                break;
        }
    }
}

if (! function_exists('getSessionUser')) {
    function getSessionUser($key)
    {
        $user_login = session($key);
        $admin = @$user_login['user']?$user_login['user']:array();
        return $admin;
    }
}

if (!function_exists('getOptionDataField')) {
    function getOptionDataField($param)
    {
        $where = !empty($param['where']) ? $param['where'] : [];
        $where['act'] = 1;
        $select = @$param['select'] ?? '*';
        $object = \DB::table($param['table'])->select($select)->where($where)->get();
        if (!empty($param['ext_option'])) {
            $ext = collect($param['ext_option'])->map(function($option){
                return (object) $option;
            });
            $object = $object->merge($ext);
        }
        return $object;
    }
}

if (!function_exists('getBackUrl')) {
    function getBackUrl()
    {
        return !empty(session()->get('back_url')) ? session()->get('back_url') : url('/'); 
    }
}

if (!function_exists('getDateTimeFormat')) {
    function getDateTimeFormat($time)
    {
        return date('d/m/Y H:i', strtotime($time));
    }
}

if (!function_exists('getlabelLinking')) {
    function getLabelLinking($data, $label, $ext_info = false)
    {
        $ret = @$data->{$label};
        if (!empty($data->code) && $ext_info) {
            $ret .= ' - Mã: '.$data->code;
        }
        if (!empty($data->seri) && $ext_info) {
            $ret .= ' - Seri: '.$data->seri;
        }
        if (!empty($data->qty) && $ext_info) {
            $ret .= ' - Số lượng: '.$data->qty;
        }
        return $ret;
    }
}

if (!function_exists('getTableLinkingWithData')) {
    function getTableLinkingWithData($data, $linking_table)
    {
        return !empty($linking_table['getFunc']) ? $linking_table['getFunc']((object) $data) : $linking_table;
    }
}

if (!function_exists('processArrField')) {
    function processArrField($field)
    {
        $arr = $field;
        $arr['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
        $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
        return $arr;
    }
}

if (!function_exists('getFullPathFileUpload')) {
    function getFullPathFileUpload($path)
    {
        if (!empty($path)) {
            return base_path($path);
            // return isLocal() ? public_path($path) : base_path($path);
        }
    }
}

if (!function_exists('removeFileData')) {
    function removeFileData($data)
    {
        $data_path = json_decode($data, true);
        if (!empty($data_path['path'])) {
            $full_path = getFullPathFileUpload($data_path['path']);
            if (file_exists($full_path)) {
                unlink($full_path);
            }
        }
    }
}

if (!function_exists('logActionUserData')) {
    function logActionUserData($action, $table, $id, $data_item = new \stdClass(),  $parent = 0)
    {
        $data_target = \DB::table($table)->find($id);
        $data_log = [
            'name' => @$data_target->name ?? @$data_target->code,   
            'table_map' => $table, 
            'action' => $action, 
            'target' => $id,  
            'user' => \User::getCurrent('id'),
            'act' => 1,
            'parent' => $parent,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];
        if (in_array($action, ['update', 'update_customer', 'apply']) && !empty($data_item)) {
            foreach ($data_target as $key => $value) {
                $old_value = @$data_item->{$key};
                if (!in_array($key, ['updated_at', 'created_at']) && $value != $old_value) {
                    $detail_data[$key] = ['old' => $old_value, 'new' => $value];
                }    
            }
        }else{
            $detail_data = $data_target;
        }
        if (!empty($detail_data)) {
            $data_log['detail_data'] = json_encode($detail_data);
            return \App\Models\NLogAction::insertGetId($data_log);
        }else{
            return false;
        }           
    }
}

if (!function_exists('getActionHistory')) {
    function getActionHistory($action)
    {
        switch ($action) {
            case 'insert':
                return 'Thêm mới';
                break;
            case 'update':
                return 'Cập nhật';
                break;
            default:
                return 'Cập nhật';
                break;
        }
    }
}

if (!function_exists('getNameFileUpload')) {
    function getNameFileUpload($dir, $name, $file_ext, $update_count = false, $get_ext = false)
    {
        $file_obj = \App\Models\File::where(['dir' =>$dir, 'name' => $name, 'ext_file' => $file_ext])->first();
        if (!empty($file_obj)) {
            $count = $update_count ? (int) $file_obj->count + 1 : (int) $file_obj->count;
            $name .= '('.$count.')';
            if ($update_count) {
                $file_obj->count = $count;
                $file_obj->save();
            }
        }
        if ($get_ext) {
            $name .= '.'.$file_ext;
        }
        return $name;
    }
}

if (!function_exists('getDetailTableField')) {
    function getDetailTableField($where)
    {
        $field_data = \App\Models\NDetailTable::where($where)->first();
        return !empty($field_data) ? processArrField($field_data->toArray()) : [];
    }
}

if (!function_exists('getLinkingUrl')) {
    function getLinkingUrl($select_data, $dataItem)
    {
        $field_title = @$select_data['field_title'] ?? 'name';
        $field_value = @$select_data['field_value'] ?? 'id';
        $except_linking = !empty($select_config['except_linking']) ? $select_config['except_linking'] : 0;
        $table_linking = getTableLinkingWithData(@$dataItem, $select_data['table']);
        $url = asset('get-data-json-linking?table='.$table_linking.'&field_search='.$field_title.'&field_value='.$field_value.'&except_linking='.$except_linking);
        if (!empty($select_data['where'])) {
            foreach ($select_data['where'] as $key => $val) {
                $url .= '&'.$key.'='.$val;
            }
        }
        if (!empty($select_data['where_default'])) {
            foreach ($select_data['where_default'] as $key => $val) {
                if (!empty($default_field[$val])) {
                    $url .= '&'.$key.'='.$default_field[$val];
                }
            }
        }
        return $url;
    }

    if (!function_exists('getJsonMultipleValue')) {
        function getJsonMultipleValue($data, $model, $label, $field_value)
        {
            $arr = array_map(function($item) use($label, $model, $field_value){
                $item_label = method_exists($model, 'getLabelLinking') ? $model::getLabelLinking($item) : getlabelLinking($item, $label, true);
                return ['id' => @$item->{$field_value}, 'label' => $item_label];
            }, $data);
            return json_encode($arr);
        }
    }
}
