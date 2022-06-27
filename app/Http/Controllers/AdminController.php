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
        return view('table.'.$data['view_type'], $data);
    }

    private function getDataActionView($table, $action, $action_name)
    {
        $data['tableItem'] = $this->service->getTableItem($table);
        $data['title'] = $action_name.' '.$data['tableItem']['note'];
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
}

