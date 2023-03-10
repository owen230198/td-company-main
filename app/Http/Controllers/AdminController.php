<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\VariableConstant;
class AdminController extends Controller
{
    static $viewWhere = array();
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return redirect('/');
    }

    public function permissionError()
    {
        return view('403');
    }

    public function pageNotFound()
    {
        return view('404');
    }

    public function view($table)
    {
        $permission = $this->admins->checkPermissionAction($table, 'view');
        if (!@$permission['allow']) {
            return redirect('permission-error');
        }
        $data = $this->admins->getDataBaseView($table, 'Danh sách');
        if(count($permission['viewWhere'])>0){
            static::$viewWhere = @$permission['viewWhere'];
        }
        $data['data_tables'] = getDataTable($table, '*', self::$viewWhere, $data['page_item'], 'id', 'desc', false, true);
        session()->put('back_url', url()->full());
        return view('table.'.$data['view_type'], $data);
    }


    public function searchTable($table, Request $request)
    {
        $permission = $this->admins->checkPermissionAction($table, 'view');
        if (!@$permission['allow']) {
            return redirect('permission-error');
        }
        $sess = !empty(session('dataSearch')[$table])?session('dataSearch')[$table]:array();
        $get = $request->all()+$sess;
        if(count($permission['viewWhere'])>0){
            static::$viewWhere = @$permission['viewWhere'];
        }
        $data = $this->admins->getDataBaseView($table, 'Tìm kiếm');
        $data['data_tables'] = $this->admins->getDataSearchTable($table, self::$viewWhere, $get, $data['page_item']);
        if (!@$get['page']) {
            session(['dataSearch'=>[$table=>$get]]);
        }
        $data['data_search'] = $get;
        session()->put('back_url', url()->full());
        return view('table.'.$data['view_type'], $data);
    }

    public function insert(Request $request, $table)
    {
        if (!$this->admins->checkPermissionAction($table, 'insert')) {
            return redirect('permission-error');
        }
        if (in_array($table, VariableConstant::ACTION_TABLE_SELF)) {
            $controller = getObjectByTable($table);
            return $controller->insert($request);
        }else{
            $data = $this->getDataActionView($table, 'insert', 'Thêm mới');
            return view('action.view', $data);
        }
    }

    public function update(Request $request, $table, $id)
    {
        if (!$this->admins->checkPermissionAction($table, 'update', $id)) {
            return redirect('permission-error');
        }
        if (in_array($table, VariableConstant::ACTION_TABLE_SELF)) {
            $controller = getObjectByTable($table);
            return $controller->update($request, $id);
        }else{
            $data = $this->getDataActionView($table, 'update', 'Chi tiết');
            $data['dataitem'] = getModelByTable($table)->find($id);
            return view('action.view', $data);
        }
    }

    public function clone($table, $id)
    {
        if (!$this->admins->checkPermissionAction($table, 'copy')) {
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
        if (!$this->admins->checkPermissionAction($table, 'insert')) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
        $data = $request->all();
        unset($data['_token']);
        $insertID = $this->admins->doInsertTable($table, $data);
        if (@$insertID) {
            $route = $table=='quotes'?'quote-managements/q_papers/'.$insertID:'view/'.$table;
            return redirect($route)->with('message','Thêm dữ liệu thành công !');
        }else {
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    }

    public function doUpdate($table, $id, Request $request)
    {
        if (!$this->admins->checkPermissionAction($table, 'update', $id)) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
        $data = $request->all();
        unset($data['_token']);
        unset($data['ajax']);
        $success = $this->admins->doUpdateTable($id, $table, $data);
        if ($success) {
            if (@Request('ajax')==1) {
                echoJson(200, 'Cập nhật dữ liệu thành công !');
                return;
            }else{
                $back_routes = @session()->get('back_url')??'view/'.$table;
                $routes = $table=='quotes'?'quote-managements/q_papers/'.$id:$back_routes;
                return redirect($routes)->with('message','Cập nhật dữ liệu thành công !');
            }
        }else {
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    }

    public function remove(Request $request){
       $data = $request->all();
       $id = $data['remove_id'];
       $table = $data['table'];
        if (!$this->admins->checkPermissionAction($table, 'remove', $id)) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
       $success = $this->admins->removeDataTable($table, $id);
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
        if (!$this->admins->checkPermissionAction($table, 'remove')) {
            return back()->with('error','Không có quyền thực hiện thao tác này !');
        }
        $arr_id = explode(',', $str_id);
        foreach ($arr_id as $id) {
            $delete = $this->admins->removeDataTable($table, $id);
        }
        if ($delete) {
            return back()->with('message','Xóa dữ liệu thành công !');
        }else{
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    }

    public function doConfigData($table, Request $request)
    {
        if (!$this->admins->checkPermissionAction($table, 'update')) {
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
        if (!$this->admins->checkPermissionAction($table, 'view')) {
            $html;
        }
        if (@$parent) {
            $models = getModelByTable($table);
            $data = $models->where('act', 1)->where($field, $parent)->orderBy('name', 'asc')->get();
            foreach ($data as $item) {
                $html .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';
            }
        }
        echo $html;
    }

    public function getDataJsonCustomer(Request $request)
    {
        $status = !empty($request->input('status')) ? $request->input('status') : 'old';
        $q = '%'.trim($request->input('q')).'%';
        $customers = \DB::table('customers')->where('status', $status);
        if (!empty($q)) {
            $customers = $customers->where('code', 'like', $q)
            ->orWhere('name', 'like', $q)
            ->orWhere('contacter', 'like', $q)
            ->orWhere('phone', 'like', $q)
            ->orWhere('telephone', 'like', $q)
            ->orWhere('email', 'like', $q)
            ->orWhere('address', 'like', $q)
            ->orWhere('city', 'like', $q)
            ->orWhere('tax_code', 'like', $q);
        }
        $data = $customers->paginate(50)->all();
        $arr = array_map(function($item){
            return ['id' => @$item->id, 'label' => $item->code.' - '.$item->name];
        }, $data);
        array_unshift($arr, ['id' => 0, 'label' => 'Khách hàng mới']);
        return json_encode($arr);
    }

    public function getDataJsonLinking(Request $request)
    {
        $table = $request->input('table');
        $where = $request->except('table', 'q');
        $q = '%'.trim($request->input('q')).'%';
        $data = \DB::table($table)->where($where);
        if (!empty($q)) {
            $data = $data->where('name', 'like', $q);
        }
        $data = $data->paginate(50)->all();
        $arr = array_map(function($item){
            return ['id' => @$item->id, 'label' => !empty($item->code) ? $item->code.' - '.$item->name : $item->name];
        }, $data);
        return json_encode($arr);
    }

}

