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
        if (!empty($data->code)) {
            $ret .= ' - Mã: '.$data->code;
        }
        if (!empty($data->seri)) {
            $ret .= ' - Seri: '.$data->seri;
        }
        if (!empty($data->qty) && $ext_info) {
            $ret .= ' - Số lượng: '.$data->qty;
        }
        if (!empty($data->square) && $ext_info) {
            $ret .= ' - Diện tích (m2): '.$data->square;
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
