<?php
namespace App\Http\Controllers;

use App\Constants\TDConstant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NTable;
class AdminController extends Controller
{
    static $view_where = array();
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

    public function view(Request $request, $table)
    {
        if (!empty($request->all())) {
            foreach ($request->all() as $key => $value) {
                static::$view_where[] = ['key' => $key, 'value' => $value];
            }
        }
        $permission = $this->admins->checkPermissionAction($table, 'view');
        if (!@$permission['allow']) {
            return redirect('permission-error');
        }
        $data = $this->admins->getDataBaseView($table, 'Danh sách');
        if(!empty($permission['where'])){
            static::$view_where[] = @$permission['where'];
        }
        $data['data_tables'] = getDataTable($table, self::$view_where, ['paginate' => $data['page_item']]);
        session()->put('back_url', url()->full());
        return view('table.'.$data['view_type'], $data);
    }

    public function configDevicePrice(Request $request, $step){
        if (!$request->isMethod('POST')) {
            if (!$this->group_users::isAdmin()) {
                return redirect('permission-error');
            }
            if ($step == 'supply_types') {
                $data['title'] = 'Danh sách thiết bị máy theo vật tư';
                $data['supply'] = TDConstant::HARD_ELEMENT;
            }elseif(in_array($step, ['devices', 'printers']) ){
                $table = @$request->input('table') ?? 'devices';
                $data = $this->admins->getDataBaseView($table, 'Danh sách');
                $data['title'] = 'Đơn giá thiết bị '. $request->input('name');
                $where = $request->except('name', 'table');
                $data['data_tables'] = \DB::table($table)->where($where)->paginate(10);
                $data['param_action'] = getParamUrlByArray($where);
            }elseif ($step = 'print_techs') {
                $data['title'] = 'Danh sách thiết bị máy in theo công nghệ in';
                $data['supply'] = TDConstant::PRINT_TECH;
                unset($data['supply'][0]);
            }elseif ($step = 'printers') {

            }
            session()->put('back_url', url()->full());
            return view('config_devices/'.$step.'/view', $data);
        }
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
            static::$view_where = @$permission['viewWhere'];
        }
        $data = $this->admins->getDataBaseView($table, 'Tìm kiếm');
        $data['data_tables'] = $this->admins->getDataSearchTable($table, self::$view_where, $get, $data['page_item']);
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
        if (in_array($table, NTable::$specific['insert'])) {
            $controller = getObjectByTable($table);
            return $controller->insert($request);
        }else{
            $param = $request->except('_token');
            if ($request->isMethod('GET')) {
                $data = $this->getDataActionView($table, 'insert', 'Thêm mới', $param);
                $data['action_url'] = url('insert/'.$table);
                return view('action.view', $data);
            }else{
                $insertID = $this->admins->doInsertTable($table, $param);
                if (@$insertID) {
                    $back_routes = @session()->get('back_url') ?? url('view/'.$table);
                    return redirect($back_routes)->with('message','Thêm dữ liệu thành công !');
                }else {
                    return back()->with('error','Đã có lỗi xảy ra !');
                }
            }
        }
    }

    public function update(Request $request, $table, $id)
    {
        if (!$this->admins->checkPermissionAction($table, 'update', $id)) {
            return redirect('permission-error');
        }
        if (in_array($table, NTable::$specific['update'])) {
            $controller = getObjectByTable($table);
            return $controller->update($request, $id);
        }else{
            $param = $request->except('_token');
            if ($request->isMethod('GET')) {
                $data = $this->getDataActionView($table, 'update', 'Chi tiết', $param);
                $data['dataitem'] = getModelByTable($table)->find($id);
                $data['action_url'] = url('update/'.$table.'/'.$id);
                return view('action.view', $data);
            }else{
                $success = $this->admins->doUpdateTable($id, $table, $param);
                if ($success) {
                    $back_routes = @session()->get('back_url') ?? url('view/'.$table);
                    return redirect($back_routes)->with('message','Cập nhật dữ liệu thành công !');
                }else {
                    return back()->with('error','Đã có lỗi xảy ra !');
                }
            }
        }
    }

    public function clone(Request $request, $table, $id)
    {
        if (!$this->admins->checkPermissionAction($table, 'copy')) {
            return redirect('permission-error');
        }
        $param = $request->except('_token');
        $data = $this->getDataActionView($table, 'insert', 'Sao chép', $param);
        $data['dataitem'] = getModelByTable($table)->find($id);
        unset($data['dataitem']['id']);
        $data['action_url'] = url('insert/'.$table);
        return view('action.view', $data);
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

    public function getDataJsonCustomer(Request $request, $filter = false)
    {
        $status = !empty($request->input('status')) ? $request->input('status') : 1;
        $customers = \DB::table('customers');
        if (!empty($request->input('q'))) {
            $q = '%'.trim($request->input('q')).'%';
            $customers->where(function ($customers) use ($q) {
                $customers->orWhere('code', 'like', $q)
                            ->orWhere('name', 'like', $q)
                            ->orWhere('contacter', 'like', $q)
                            ->orWhere('phone', 'like', $q)
                            ->orWhere('telephone', 'like', $q)
                            ->orWhere('email', 'like', $q)
                            ->orWhere('address', 'like', $q)
                            ->orWhere('city', 'like', $q)
                            ->orWhere('tax_code', 'like', $q);
            });
        }
        $data = $customers->paginate(50)->all();
        $arr = array_map(function($item){
            return ['id' => @$item->id, 'label' => $item->code.' - '.$item->name];
        }, $data);
        if (!$filter) {
            array_unshift($arr, ['id' => 0, 'label' => 'Khách hàng mới']);
        }
        return json_encode($arr);
    }

    public function getDataJsonLinking(Request $request)
    {
        $table = $request->input('table');
        if ($table == 'customers') {
            return $this->getDataJsonCustomer($request, true);
        }
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

    public function getListOptionAjax(Request $request, $table)
    {
        $options = '<option value = "0">Không xác định</option>';
        $cvalue = $request->input('cvalue'); 
        $where = $request->except('cvalue');
        $where['act'] = 1;
        $data = \DB::table($table)->where($where)->orderBy('name', 'asc')->get();
        foreach ($data as $item) {
            if (@$item->id == $cvalue) {
                $options .= '<option value = "'.@$item->id.'" selected>'.@$item->name.'</option>';
            }else{
                $options .= '<option value = "'.@$item->id.'">'.@$item->name.'</option>';
            }
        }
        echo $options;
    }
}

