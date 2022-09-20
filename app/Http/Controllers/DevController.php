<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NDetailTable;
use App\Models\NTable;
use Illuminate\Support\Facades\Schema;

class DevController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $method)
    {
        if(!@getSessionUser()['dev']){
           echo 'method is only developers !';
           return false;
        }
        if(!$method){
            echo 'method is not exists !';
        }else{
            $this->$method();
        }
    }

    public function addColumnTable()
    {
        $arrTables = NTable::select('name')->where('insert', 1)->get()->toArray();
        foreach ($arrTables as $item) {
            Schema::table($item['name'], function($table){
                $table->integer('created_by')->before('created_at');
            });
        }
    }

    public function devUpdateData()
    {
        die();
        $modules = new \App\Models\NModule;
        $group_users = new \App\Models\NGroupUser;
        $roles = new \App\Models\NRole;
        $list_group = $group_users::all();
        $list_modules = $modules::all();
        foreach ($list_group as $group) {
            $group_id = $group->id;
            foreach ($list_modules as $module) {
                if (@$module->parent) {
                    $module_id = $module->id;
                    $data['n_group_user_id'] = $group_id;
                    $data['module_id'] = $module_id;
                    $data['insert'] = 1;
                    $data['update'] = 1;
                    $data['copy'] = 1;
                    $data['remove'] = 1;
                    $insert = $roles->insert($data);
                    if (@$insert) {
                        echo 'Thêm thành công !';
                    }
                }
            }
        }
    }
}

