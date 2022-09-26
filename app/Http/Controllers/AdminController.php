<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    static $viewWhere = array();
    public function __construct()
    {
        parent::__construct();
        $this->service = new \App\Services\AdminService;
    }

    public function index()
    {
        return redirect('/');
    }

    public function permissionError()
    {
        return view('403');
    }

    public function view($table)
    {
        $permission = $this->service->checkPermissionAction($table, 'view');
        if (!@$permission['allow']) {
            return redirect('permission-error');
        }
        $data = $this->service->getDataBaseView($table, 'Danh sách');
        if(count($permission['viewWhere'])>0){
            static::$viewWhere[] = @$permission['viewWhere'];
        }
        $data['data_tables'] = getDataTable($table, '*', self::$viewWhere, $data['page_item']);
        session()->put('back_url', url()->full());
        return view('table.'.$data['view_type'], $data);
    }


    public function searchTable($table, Request $request)
    {
        $permission = $this->service->checkPermissionAction($table, 'view');
        if (!@$permission['allow']) {
            return redirect('permission-error');
        }
        $get = $request->all();
        if(count($permission['viewWhere'])>0){
            static::$viewWhere[] = @$permission['viewWhere'];
        }
        $data = $this->service->getDataBaseView($table, 'Tìm kiếm');
        $data['data_tables'] = $this->service->getDataSearchTable($table, self::$viewWhere, $get, $data['page_item']);
        $data['data_search'] = $get;
        session()->put('back_url', url()->full());
        return view('table.'.$data['view_type'], $data);
    }

    private function getDataActionView($table, $action, $action_name)
    {
        $data['tableItem'] = $this->service->getTableItem($table);
        $data['title'] = $action_name.' '.$data['tableItem']['note'];
        $action = $action=='clone'?'insert':$action;
        $data['field_list'] = $this->service->getFieldAction($table, $action);
        $data['action'] = $action;
        $data['action_name'] = $action_name;
        $data['regions'] = $this->regions->getRegionOfTable($table);
        return $data;
    }

    public function insert($table)
    {
        if (!$this->service->checkPermissionAction($table, 'insert')) {
            return redirect('permission-error');
        }
        $data = $this->getDataActionView($table, 'insert', 'Thêm mới');
        return view('action.view', $data);
    }

    public function update($table, $id)
    {
        if (!$this->service->checkPermissionAction($table, 'update', $id)) {
            return redirect('permission-error');
        }
        $data = $this->getDataActionView($table, 'update', 'Cập nhật');
        $data['dataitem'] = getModelByTable($table)->find($id);
        return view('action.view', $data);
    }

    public function clone($table, $id)
    {
        if (!$this->service->checkPermissionAction($table, 'copy')) {
            return redirect('permission-error');
        }
        $data = $this->getDataActionView($table, 'clone', 'Sao chép');
        $data['dataitem'] = getModelByTable($table)->find($id);
        if (@$data['dataitem']['id']) {
            unset($data['dataitem']['id']);
        }
        if (@$data['dataitem']['password']) {
            unset($data['dataitem']['password']);
        }
        return view('action.view', $data);
    }

    public function doInsert($table, Request $request)
    {
        if (!$this->service->checkPermissionAction($table, 'insert')) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
        $data = $request->all();
        unset($data['_token']);
        $insertID = $this->service->doInsertTable($table, $data);
        if (@$insertID) {
            $route = $table=='quotes'?'quote-managements/q_papers/'.$insertID:'view/'.$table;
            return redirect($route)->with('message','Thêm dữ liệu thành công !');
        }else {
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    }

    public function doUpdate($table, $id, Request $request)
    {
        if (!$this->service->checkPermissionAction($table, 'update', $id)) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
        $data = $request->all();
        unset($data['_token']);
        $success = $this->service->doUpdateTable($id, $table, $data);
        if ($success) {
            $back_routes = @session()->get('back_url')?session()->get('back_url'):'view/'.$table;
            $routes = $table=='quotes'?'quote-managements/q_papers/'.$id:$back_routes;
            return redirect($routes)->with('message','Cập nhật dữ liệu thành công !');
        }else {
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    }

    public function remove(Request $request){
       $data = $request->all();
       $id = $data['remove_id'];
       $table = $data['table'];
        if (!$this->service->checkPermissionAction($table, 'remove', $id)) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
       $success = $this->service->removeDataTable($table, $id);
       if ($success) {
            return back()->with('message','Xoá thành công dữ liệu!');
        }else {
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    }

    public function multipleRemove(Request $request)
    {
        $data = $request->all();
        $str_id = @$data['multi_remove_id']?$data['multi_remove_id']:'';
        if ($str_id == '') {
            return back()->with('error','Chưa có mục được chọn !');
        }
        $table = $data['table'];
        if (!$this->service->checkPermissionAction($table, 'remove')) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
        $arr_id = explode(',', $str_id);
        foreach ($arr_id as $id) {
            $delete = $this->service->removeDataTable($table, $id);
        }
        if ($delete) {
            return back()->with('message','Xóa dữ liệu thành công !');
        }else{
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    }

    public function doConfigData($table, Request $request)
    {
        if (!$this->service->checkPermissionAction($table, 'update')) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
        $post = $request->all();
        unset($post['_token']);
        $success = false;
        foreach ($post as $key => $value) {
            $data['value'] = $value;
            $success = $this->db::table($table)->where('id', $key)->update($data);
        }
        if (isset($success)) {
            echoJson(200, 'Cập nhật dữ liệu thành công!');
            return;
        }else {
            echoJson(100, 'Đã có lỗi xảy ra!');
        }
    }

    public function optionChildData($table, $field, $parent)
    {
        $html = '<option value="0">Danh sách chọn</option>';
        if (!$this->service->checkPermissionAction($table, 'view')) {
            $html;
        }
        if ($parent!=0) {
            $models = getModelByTable($table);
            $data = $models->where('act', 1)->where($field, $parent)->orderBy('name', 'asc')->get();
            foreach ($data as $key => $item) {
                $html .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';
            }
        }
        echo $html;
    }

    public function getJsonDataById($table, $id)
    {
        if (!$this->service->checkPermissionAction($table, 'view')) {
            return json_encode(array());
        }
        if ($id) {
            $models = getModelByTable($table);
            $data = $models->find($id);
        }
        $arr_data = @$data?$data->toArray():array();
        return json_encode($arr_data);
    }

    public function grantPermission()
    {
        if (!$this->service->checkPermissionAction('n_roles', 'view')) {
            return redirect('permission-error');
        }
        $data['title'] = 'Phân quyền';
        $data['limit_roles'] = array();
        $data['list_roles'] = array();
        $data['other_modules'] = array();
        $list_groups = \App\Models\NGroupUser::where('act', 1)->get()->toArray();
        $admin = getSessionUser();
        $data['list_groups'] = recursive($list_groups, $admin['n_group_user_id'], 0);
        return view('roles.view', $data);
    }

    public function getPermission(Request $request)
    {
        if (!$this->service->checkPermissionAction('n_roles', 'view')) {
            return redirect('permission-error');
        }
        $get = $request->all();
        $group = @$get['group']?$get['group']:'';
        $data['title'] = 'Phân quyền';
        $list_groups = \App\Models\NGroupUser::where('act', 1)->get()->toArray();
        $admin = getSessionUser();
        $data['list_groups'] = recursive($list_groups, $admin['n_group_user_id'], 0);
        if ($group == '') {
            $data['limit_roles'] = array();
            $data['list_roles'] = array();
            $data['other_modules'] = array();
        }else {
            if (!$this->service->checkListGroup($group, $data['list_groups'])) {
                return redirect('permission-error');
            }
            $data['limit_roles'] = array_merge(@session('user_login')['parent_menu'], @session('user_login')['menu']);
            $data['list_roles'] = (new \App\Models\NRole)->getModuleByGroupUser($admin['n_group_user_id']);
            $data['group'] = $group;
        }
        return view('roles.view', $data);
    }

    public function updatePermission($module_id, $role_id, Request $request)
    {
        if (!$this->service->checkPermissionAction('n_roles', 'view')) {
            return redirect('permission-error');
        }
        $data = $request->all();
        unset($data['_token']);
        if (!$this->service->checkRoleUpdatePermission($module_id, $data)) {
            echoJson(110, 'Không được phân quyền module này !');
            return;
        }else{
            $update = \App\Models\NRole::where('role_id', $role_id)->update($data);
            if ($update) {
                echoJson(200, 'Đã cập nhật quyền truy cập !');
                return;
            }else {
                echoJson(100, 'Có lỗi xảy ra vui lòng thử lại !');
                return;
            }
        }
    }
}

