<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        var_dump(getDataTable()); die();
        $data['title'] = 'Management System';
        return view('main', $data); 
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

