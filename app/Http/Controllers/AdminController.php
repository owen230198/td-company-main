<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
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
        $data = $this->service->getDataBaseView($table, 'Danh sách');
        $data['data_tables'] = getDataTable($table, '*', array(), $data['page_item']);
        session()->put('back_url', url()->full());
        return view('table.'.$data['view_type'], $data);
    }


    public function searchTable($table, Request $request)
    {
        $get = $request->all();
        $data = $this->service->getDataBaseView($table, 'Tìm kiếm');
        $data['data_tables'] = $this->service->getDataSearchTable($table, $get, $data['page_item']);
        $data['data_search'] = $get;
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
        $data = $this->getDataActionView($table, 'insert', 'Thêm mới');
        return view('action.view', $data);
    }

    public function update($table, $id)
    {
        $data = $this->getDataActionView($table, 'update', 'Cập nhật');
        $data['dataitem'] = getModelByTable($table)->find($id);
        return view('action.view', $data);
    }

    public function clone($table, $id)
    {
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
        $data = $request->all();
        unset($data['_token']);
        $success = $this->service->doUpdateTable($id, $table, $data);
        if ($success) {
            $routes = @session()->get('back_url')?session()->get('back_url'):'view/'.$table;
            return redirect($routes)->with('message','Cập nhật dữ liệu thành công !');   
        }else {
            return back()->with('error','Đã có lỗi xảy ra !');
        }
    } 

    public function remove(Request $request){
       $data = $request->all();
       $id = $data['remove_id'];
       $table = $data['table'];
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
}

