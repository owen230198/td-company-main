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

if(!function_exists('getOptionByClass')){
    function getOptionByClass($class, $where = ['act'=>1]){
        $models = getModelByClass($class);
        $data = $models::where($where)->get()->toArray();
        return $data;
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
            default:
                return '';
                break;
        }
    }
}

if (! function_exists('getSessionUser')) {
    function getSessionUser()
    {
        $user_login = session('user_login');
        $admin = @$user_login['user']?$user_login['user']:array();
        return $admin;
    }
}
