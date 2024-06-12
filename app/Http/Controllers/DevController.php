<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NTable;
use Illuminate\Support\Facades\Schema;
use App\Constants\VariableConstant;
use App\Models\CDesign;
use App\Models\Order;
use App\Models\Paper;
use App\Models\Product;

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
        if(\User::getCurrent('dev') != 1){
           echo 'method is only developers !';
           return false;
        }
        if(!$method){
            echo 'method is not exists !';
        }else{
            $this->$method($request);
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

    public function test()
    {
        $ret = \DB::table('products')->where([['status', '!=', 'making_process'], ['act', '=', 1]])->get();
        dd($ret);
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

    public function addUnitWarehouse(){
        $query = \DB::table('warehouse_histories');
        $list = $query->get();
        foreach ($list as $key => $item) {
            $obj = \DB::table('warehouse_histories')->where(['id' => $item->id]);
            if (!empty($item->type)) {
                $data['unit'] = getUnitSupply($item->type);
                $obj->update($data);
                dump($item->type, $data['unit']);
            }else{
                $remove = $obj->delete();
                dump('remove', $remove);
            }
        }
        dd($data);
    }

    public function warehouseDataProcess(){
        $query = \DB::table('warehouse_histories');
        $list = $query->get();
        foreach ($list as $item) {
            $name = getFieldDataById('name', $item->table, $item->target);
            $update = \DB::table('warehouse_histories')->where('id', $item->id)->update(['name' => $name]);
            dump($update, $name);
        }
    }

    public function warehouseTableName(){
        $tables = ['print_warehouses', 'supply_warehouses', 'square_warehouses', 'other_warehouses'];
        foreach ($tables as $table) {
            $model = getModelByTable($table);
            $list = $model::all()->toArray();
            foreach ($list as $item) {
                $name = $model::getName($item);
                $update = $model::where('id', $item['id'])->update(['name' => $name]);
                dump($update, $name);
            }
        }
    }

    public function updateCodeTable($request){
        $table = $request->input('table');
        $list = \DB::table($table)->get();
        foreach ($list as $item) {
            $code = $request->get('prefix').'-'.sprintf("%08s", $item->id);
            $update = \DB::table($table)->where('id', $item->id)->update([$request->input('name') => $code]);
            dump($update);
        }
    }

    public function profitData(){
        $quotes = \App\Models\Quote::orderBy('id', 'DESC')->get();
        foreach ($quotes as $quote) {
            \DB::table('products')->where('quote_id', $quote->id)->update(['ship_price' => $quote->ship_price, 'profit' => $quote->profit]);
            \DB::table('orders')->where('quote', $quote->id)->update(['ship_price' => $quote->ship_price, 'profit' => $quote->profit, 'total_cost' => $quote->total_cost]);
            RefreshQuotePrice($quote);
        }
        dd(1);
    }

    public function handleJoinPrint($request)
    {
        $paper = Paper::find($request->input('id'));
        $insert_product['name'] = $paper->name; 
        $insert_product['qty'] = $paper->supp_qty; 
        $insert_product['made_by'] = \TDConst::MADE_BY_OWN;
        $insert_product['category'] = 7;
        $insert_product['design'] = 4;
        (new \BaseService)->configBaseDataAction($insert_product);
        $product_id = Product::insertGetId($insert_product);
        $paper->product = $product_id;
        $paper->save();
        Product::where('id', $product_id)->update(['code' => 'G-'.sprintf("%08s", $product_id), 'total_cost' => $paper->total_cost, 'total_amount' => $paper->total_cost, 'status' => Order::TECH_SUBMITED, 'order_created' => 1]);
        dd(1);
    }

    public function updateCDesign($request){
        $obj = \DB::table('c_designs')->find($request->input('id'));
        $value = str_replace($request->input('key'), $obj->order,  $obj->code);
        \DB::table('c_designs')->where('id', $request->input('id'))->update(['code' => $value]);
    }

    public function updateOrderReturnTime(){
        $orders = Order::get();
        foreach ($orders as $order) {
            $command_list = CDesign::where('order', $order->id);
            if ($command_list->count() == $command_list->where(['status' => Order::DESIGN_SUBMITED])->count()) {
                $add_day = 0;
                foreach ($command_list->get() as $command) {
                    $product = Product::find($command->product);
                    if ($product->category == 1) {
                        $add_day += 12;
                    }else{
                        $add_day += 8;    
                    }
                }
                $arr_where['return_time'] = $order->created_at->addDays($add_day);
                Order::where('id', $command['order'])->update($arr_where);
            }
        }
    }

    public function updateCodeSupply()
    {
        $products = Product::where('code', '!=', null)->get();
        foreach ($products as $product) {
            (new \App\Services\OrderService())->handleCommandCode($product, $product->code);
        }
        dd(1);
    }

    public function reApplyToWorkerProduct()
    {
        $products = Product::where('status', Order::MAKING_PROCESS)->get();
        foreach ($products as $product) {
            (new \App\Services\OrderService())->createWorkerCommand($product);
        }
        dd(1);
    }

    public function updateData($request)
    {
        \DB::table($request->input('table'))->where('id', $request->input('id'))->update([$request->input('key') => $request->input('value')]);
    }
}

