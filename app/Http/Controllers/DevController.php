<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NTable;
use Illuminate\Support\Facades\Schema;
use App\Constants\VariableConstant;

class DevController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $method)
    {
        // if(!@getSessionUser('user')['dev']){
        //    echo 'method is only developers !';
        //    return false;
        // }
        if(!$method){
            echo 'method is not exists !';
        }else{
            $this->$method();
        }
    }

    public function addColumnTable()
    {
        die();
        $arrTables = NTable::select('name')->where('insert', 1)->get()->toArray();
        foreach ($arrTables as $item) {
            if (!Schema::hasColumn($item['name'], 'create_time')) {
                Schema::table($item['name'], function($table){
                    $table->datetime('create_time')->before('created_at');
                });
            }
        }
    }

    public function moveData()
    {
        die();
        $arrTables = NTable::select('name')->where('insert', 1)->get()->toArray();
        foreach ($arrTables as $item) {
            $data = \DB::table($item['name'])->get();
            foreach ($data as $key => $value) {
                if (!empty($value->id)) {
                    \DB::table($item['name'])->where('id', $value->id)->update(['create_time' => $value->created_at]);
                }
            }
        }
    }

    public function updateDataRole()
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
                    if(in_array($module->name, VariableConstant::CONFIG_TABLE)){
                        $arrRole = VariableConstant::CONFIG_TABLE_ROLE;    
                    }elseif(in_array($module->name, VariableConstant::ROLE_SELF_TABLE)){
                        $model = getModelByTable($module->name);
                        $arrRole = $model::ARR_ROLE;
                    }else{
                        $arrRole = VariableConstant::BASE_ROLE;
                    }
                    $roleArr = [];
                    foreach ($arrRole as $key => $value) {
                        $roleArr[$key] = $value; 
                    }
                    $module_id = $module->id;
                    $data['group_user'] = $group_id;
                    $data['module_id'] = $module_id;
                    $data['json_data_role'] = json_encode($roleArr);
                    $insert = $roles->insert($data);
                    if (@$insert) {
                        echo 'Thêm thành công !';
                    }
                }
            }
        }
    }

    public function handleQueryCondition(&$table, $where)
    {
        foreach ($where as $w) {
            if (!empty($w['type']) && $w['type'] == 'group' && !empty($w['query'])) {
                $gr_where = $w['query'];
                if ($w['con'] == 'or') {
                    $table->orWhere(function($table) use($gr_where){
                        foreach ($gr_where  as $grw) {
                            $this->handleQueryCondition($table, $grw);
                        }
                    }); 
                }else{
                    $table->where(function($table) use($gr_where){
                        foreach ($gr_where  as $grw) {
                            $this->handleQueryCondition($table, $grw);
                        }
                    }); 
                }
            }else{
                $compare = !empty($w['compare']) ? $w['compare'] : '=';
                $value = $compare == 'like' ? '%'.$w['value'].'%' : $w['value'];
                if (@$w['con'] == 'or') {
                    $table->orWhere($w['key'], $compare, $value);
                }else{
                    $table->where($w['key'], $compare, $value);  
                }
            }
        }
    }

    public function testQuery()
    {
        \DB::enableQueryLog();
        $table = \DB::table('devices')->select('*');
        $where = [
            ['key' => 'act', 'value' =>  1],
            [
                'type' => 'group',
                'con' => 'nd',
                'query' => [
                        [['key' => 'key_device', 'value' => 'nilon']],
                        [
                            [
                                'type' => 'group',
                                'con' => 'or',
                                'query' => [
                                    [['or' => 'nd', 'key' => 'key_device', 'value' => 'uv']],
                                    [['or' => 'nd', 'key' => 'shape_price', 'value' => 100000]]
                                ]
                            ]
                        ]
                    ]
            ]
        ];
        if (!empty($where)) {
            $this->handleQueryCondition($table, $where);
        }
        $data = $table->get();
        dump($data);
        dd(\DB::getQueryLog());
    }

    public function getRoleModel($table)
    {
        $role = [
            \GroupUser::SALE => [
                'view' => 
                    [
                        'with' => ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                    ],
                'update' => 
                    [
                        'with' => 
                            [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                [
                                    'type' => 'group',
                                    'query' => [
                                        ['con'=> 'or', 'key' => 'status', 'value' => Order::DESIGN_SUBMITED],
                                        ['con'=> 'or', 'key' => 'status', 'value' => Order::NOT_ACCEPTED]
                                    ]
                                ]
                            ]
                    ]
            ]
        ];
    }

    public function testData(){
        $table_salary = 'w_salaries';
        $handle_materal = [20, 19, 21];
        $where = ['type' => \TDConst::FILL, 'table_supply' => 'fill_finishes','supply' => 61, 'status' => \StatusConst::SUBMITED];
        $arr_qty = [];
        foreach ($handle_materal as $materal_id) {
            $arr_qty[] = \DB::table($table_salary)->Where($where)->where('fill_materal', $materal_id)->sum('qty');
        }
        dd(collect($arr_qty)->min());
    }
}

