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

    public function injectViewWhereParam($table, $arr)
    {
        foreach ($arr as $key => $value) {
            $conditions = $this->admins->getConditionTable($table, $key, $value);
            if (!empty($conditions)) {
                foreach ($conditions as $condition) {
                    static::$view_where[] = $condition;
                }
            }
        }
    }

    public function view(Request $request, $table)
    {
        $role = $this->admins->checkPermissionAction($table, __FUNCTION__);
        if (!@$role['allow']) {
            return redirect(url('permission-error'))->with('error', 'Bạn không có quyền truy cập!');
        }
        $data = $this->admins->getDataBaseView($table, 'Danh sách');
        if($data['view_type'] == 'config'){
            $data['action_url'] = url('do-config-data/'.$table);   
        }else{
            $default_data = $request->input('default_data');
            if (!empty($default_data)) {
                $param_default = json_decode($default_data, true);
                $this->injectViewWhereParam($table, $param_default);
                $data['param_default'] = $default_data;
                $data['param_action'] = getParamUrlByArray($param_default);
            }
            if ($request->input('nosidebar') == 1) {
                $data['nosidebar'] = 1;
            }
            $param =  $request->except('default_data', 'page', 'nosidebar');
            if (!empty($param)) {
                $data['data_search'] = $param;
                $this->injectViewWhereParam($table, $param);
            }
            if(!empty($role['where'])){
                static::$view_where[] = $role['where'];
            }
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
                $data['type'] = $request->input('type');
                if ($data['type'] == 'devices') {
                    $data['title'] = 'Danh sách thiết bị máy theo vật tư';
                }else{
                    $data['title'] = 'Danh sách chất liệu & vật tư sản xuất';   
                }
                $data['supply'] = TDConstant::HARD_ELEMENT;
            }elseif ($step = 'print_techs') {
                $data['title'] = 'Danh sách thiết bị máy in theo công nghệ in';
                $data['supply'] = TDConstant::PRINT_TECH;
                unset($data['supply'][0]);
            }
            session()->put('back_url', url()->full());
            return view('config_devices/'.$step.'/view', $data);
        }
    }


    public function searchTable(Request $request, $table)
    {
        return $this->view($request, $table);
    }

    public function insert(Request $request, $table)
    {
        $role = $this->admins->checkPermissionAction($table, __FUNCTION__);
        if (empty($role['allow'])) {
            return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Không có quyền thao tác !']);
        }
        if (in_array($table, NTable::$specific[__FUNCTION__])) {
            $controller = getObjectByTable($table);
            return $controller->insert($request);
        }else{
            $param = $request->except('_token');
            if ($request->isMethod('GET')) {
                $data = $this->admins->getDataActionView($table, __FUNCTION__, 'Thêm mới', $param);
                $data['action_url'] = url('insert/'.$table);
                return view('action.view', $data);
            }else{
                $status = $this->admins->doInsertTable($table, $param);
                if ($status['code'] == 200) {
                    $back_routes = @session()->get('back_url') ?? url('view/'.$table);
                    $this->admins->logActionUserData(__FUNCTION__, $table, $status['id']);
                    return returnMessageAjax(200, 'Thêm dữ liệu thành công!', $back_routes);
                }else {
                    return returnMessageAjax(100, $status['message']);
                }
            }
        }
    }

    public function update(Request $request, $table, $id)
    {
        $dataItem = getModelByTable($table)->find($id);
        $action_role = $request->isMethod('GET') ? 'view' : __FUNCTION__;
        $role = $this->admins->checkPermissionAction($table, $action_role, $dataItem);
        if (!@$role['allow']) {
            return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Không có quyền thao tác !']);
        }
        if (in_array($table, NTable::$specific['update'])) {
            $controller = getObjectByTable($table);
            return $controller->update($request, $id);
        }else{
            $param = $request->except('_token');
            if ($request->isMethod('GET')) {
                $data = $this->admins->getDataActionView($table, 'update', 'Chi tiết', $param);
                $data['dataItem'] = $dataItem;
                $data['action_url'] = url('update/'.$table.'/'.$id);
                return view('action.view', $data);
            }else{
                $status = $this->admins->doUpdateTable($id, $table, $param);
                if ($status['code'] == 200) {
                    $back_routes = @session()->get('back_url') ?? url('view/'.$table);
                    $this->admins->logActionUserData(__FUNCTION__, $table, $id, $dataItem);
                    return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', $back_routes);
                }else {
                    return returnMessageAjax(100, $status['message']);
                }
            }
        }
    }

    public function clone(Request $request, $table, $id)
    {
        $role = $this->admins->checkPermissionAction($table, __FUNCTION__);
        if (empty($role['allow'])) {
            return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Không có quyền thao tác !']);
        }
        if (in_array($table, NTable::$specific['copy'])) {
            $controller = getObjectByTable($table);
            return $controller->clone($request, $id);
        }else{
            $param = $request->except('_token');
            $data = $this->admins->getDataActionView($table, 'insert', 'Sao chép', $param);
            $data['dataItem'] = getModelByTable($table)->find($id);
            unset($data['dataItem']['id']);
            $data['action_url'] = url('insert/'.$table);
            return view('action.view', $data);
        }  
    }

    public function remove(Request $request){
        $data = $request->all();
        $id = $data['remove_id'];
        $table = $data['table'];
        $dataItem = \DB::table($table)->find($id);
        $role = $this->admins->checkPermissionAction($table, __FUNCTION__);
        $is_ajax = (boolean) $request->input('ajax');
        if (empty($role['allow'])) {
            $this->admins->logActionUserData(__FUNCTION__, $table, $id, $dataItem);
            return customReturnMessage(false, $is_ajax, ['message' => 'Không có quyền thao tác !']);
        }
        $success = $this->admins->removeDataTable($table, $id);
        if ($success) {
            return customReturnMessage(true, $is_ajax, ['message' => 'Xoá thành công dữ liệu !']);
        }else {
            return customReturnMessage(false, $is_ajax, ['message' => 'Đã có lỗi xảy ra !']);
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
        if (!\GroupUser::isAdmin()) {
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
            return returnMessageAjax(100, 'Bạn không có quyền thực hiện thao tác này !');
        }
        $post = $request->except('_token');
        $success = false;
        foreach ($post as $key => $value) {
            $data['value'] = $value;
            $success = \DB::table($table)->where('name', $key)->update($data);
        }
        if (isset($success)) {
            return returnMessageAjax(200, 'Cập nhật dữ liệu thành công !');
        }else {
            return returnMessageAjax(100, 'Có lỗi xảy ra, vui lòng thử lại !');
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
        $where = $request->except('table', 'q', 'field_search');
        $data = \DB::table($table)->where($where);
        $q = $request->input('q');
        $label = $request->input('field_search');
        if (!empty($q)) {
            $q = '%'.trim($q).'%';
            $data = $data->where($label, 'like', $q);
        }
        if (\Schema::hasColumn($table, 'ord')) {
            $data = $data->orderBy('ord', 'asc');
        }
        $data = $data->paginate(50)->all();
        $arr = array_map(function($item) use($label){
            $item_label = getlabelLinking($item, $label, true);
            return ['id' => @$item->id, 'label' => $item_label];
        }, $data);
        return json_encode($arr);
    }

    public function getListOptionAjax(Request $request, $table)
    {
        $options = '<option value = "0">Không xác định</option>';
        $cvalue = $request->input('cvalue'); 
        $where = $request->except('cvalue');
        $where['act'] = 1;
        $data = \DB::table($table)->where($where);
        if (\Schema::hasColumn($table, 'ord')) {
            $data = $data->orderBy('ord', 'asc')->get();
        }else{
            $data = $data->orderBy('name', 'asc')->get();    
        }
        foreach ($data as $item) {
            if (@$item->id == $cvalue) {
                $options .= '<option value = "'.@$item->id.'" selected>'.@$item->name.'</option>';
            }else{
                $options .= '<option value = "'.@$item->id.'">'.@$item->name.'</option>';
            }
        }
        echo $options;
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $data['code'] = 100;
        $data['message'] = 'Không thể upload file !';
        if (!empty($file)) {
            $name = $file->getClientOriginalName();
            $location = 'uploads/files';
            if (file_exists(public_path().'/'.$location.'/'.$name) || file_exists(base_path().'/'.$location.'/'.$name)) {
                $data['message'] = 'Tên file đã tồn tại, vui lòng đổi tên trước !';
            }else{
                $status = $file->move($location ,$name);
                if (!empty($status)) {
                    $data['code'] = 200;
                    $data['message'] = 'Đã upload file thành công !';
                    $data['path'] = url($location.'/'.$name);
                    $data['name'] = $name;
                }
            }
            
        }
        return response()->json($data);
    }
}

