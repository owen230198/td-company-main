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
        return !empty(session()->get('back_url')) ? session()->get('back_url') : url(); 
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
        return !empty($linking_table['getFunc']) ? $linking_table['getFunc']($data) : $linking_table;
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
            return isLocal() ? public_path($path) : base_path($path);
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
        $data_log = [   'table_map' => $table, 
                        'action' => $action, 
                        'target' => $id,  
                        'user' => \User::getCurrent('id'),
                        'act' => 1,
                        'parent' => $parent,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()];
        if (in_array($action, ['update', 'update_customer', 'apply']) && !empty($data_item)) {
            $data_target = \DB::table($table)->find($id);
            foreach ($data_target as $key => $value) {
                $old_value = @$data_item->{$key};
                if (!in_array($key, ['updated_at', 'created_at']) && $value != $old_value) {
                    $detail_data[$key] = ['old' => $old_value, 'new' => $value];
                }    
            }
        }else{
            $detail_data = $data_item;
        }
        if (!empty($detail_data)) {
            $data_log['detail_data'] = json_encode($detail_data);
            return \App\Models\NLogAction::insertGetId($data_log);
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
