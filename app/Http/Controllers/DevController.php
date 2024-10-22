<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NTable;
use Illuminate\Support\Facades\Schema;
use App\Constants\VariableConstant;
use App\Models\AfterPrint;
use App\Models\CDesign;
use App\Models\COrder;
use App\Models\CProduct;
use App\Models\CSupply;
use App\Models\Device;
use App\Models\FillFinish;
use App\Models\Order;
use App\Models\Paper;
use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\ProductWarehouse;
use App\Models\Quote;
use App\Models\Represent;
use App\Models\SquareWarehouse;
use App\Models\SupplyBuying;
use App\Models\WSalary;
use Illuminate\Support\Facades\File;

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
        // $this->$method($request);
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
        dd(getSizeByCodeMisa('ALSE_34x53'));
    }

    public function handleDataHistory()
    {
        $data_histories = \DB::table('n_log_actions')->get();
        foreach ($data_histories as $history) {
            $obj = \DB::table($history->table_map)->find($history->target);
            $update = [];
            if (empty($obj)) {
                \DB::table('n_log_actions')->where('id', $history->id)->delete();
            }else{
                $update['name'] = @$obj->name ?? @$obj->code;
                if ($history->action == 'insert') {
                    $update['detail_data'] = json_encode($obj);
                }elseif ($history->action == 'removeDataTable') {
                    $update['action'] = 'remove';
                }
                \DB::table('n_log_actions')->where('id', $history->id)->update($update);
            }
        }
        echo 'dm';
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
                $data['unit'] = getUnitSupply($item->type, $item);
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
        $tables = ['square_warehouses'];
        foreach ($tables as $table) {
            $model = getModelByTable($table);
            $list = $model::whereIn('type', ['nilon', 'metalai'])->get()->toArray();
            foreach ($list as $item) {
                $name = $model::getName($item);
                $name = str_replace('( THUÊ NGOÀI )', '', $name);
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

    public function updateDeliverProduct(){
        $products = Product::where('parent', 0)->get();
        foreach ($products as $product) {
            Product::where('id', $product->id)->update(['delivery' => $product->qty]);
        }
    }

    public function customerToRepresent()
    {
        dd(1);
        $customsers = \DB::table('customers')->get();
        foreach ($customsers as $customer) {
            $represent = [];
            $represent['name'] = $customer->contacter;
            $represent['phone'] = $customer->phone;
            $represent['telephone'] = $customer->telephone;
            $represent['email'] = $customer->email;
            $represent['customer'] = $customer->id;
            $represent['sale'] = json_encode([$customer->created_by]);
            $represent['note'] = $customer->note;
            $represent['act'] = $customer->act;
            $represent['created_at'] = $customer->created_at;
            $represent['updated_at'] = $customer->updated_at;
            $represent['created_by'] = $customer->created_by;
            $id = \DB::table('represents')->insertGetId($represent);
            \DB::table('quotes')->where('represent', $customer->id)->update(['represent' => $id]);
            \DB::table('orders')->where('represent', $customer->id)->update(['represent' => $id]);
            dump($id = \DB::table('represents')->find($id));
        }
    }

    public function addCustomerQuoteOrder($request)
    {
        $table = $request->input(('table'));
        $data = \DB::table($table)->get();
        foreach ($data as $item) {
            $update['customer'] = Represent::getCustomer($item->represent, 'id');
            \DB::table($table)->where('id', $item->id)->update($update);
        }
            
    }

    public function checkSubmitedSalaryWorker()
    {
        $salaries = WSalary::where('created_by', 23)->update(['created_by' => 6]);
        dd($salaries);
        foreach ($salaries as $salary) {
            WSalary::checkStatusUpdate($salary->table_supply, $salary->supply, \StatusConst::SUBMITED);
            dump($salary->id);
        }
    }

    public function updateAmountFieldOrder()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            $products = Product::where('order', $order->id)->get();
            $arr_total = getTotalProductByArr($products);
            $update['amount'] = $arr_total['total_amount'];
            Order::where('id', $order->id)->update($update);
        }
    }

    public function updateCustomerOrderByQuote()
    {
        $products = Product::where(['order_created' => 1])->get();
        foreach ($products as $product) {
            $quote = Quote::find($product->quote_id);
            if (!empty($quote->customer) && !empty($quote->represent)) {
                Order::where('id', $product->order)->update(['customer' => $quote->customer, 'represent'=> $quote->represent]);
            }else{
                dump(Order::find($product->order));
            }
        }
    }

    public function removeCommandProductI()
    {
        die();
        $products = Product::where(['category' => 1, 'status' => Order::MAKING_PROCESS])->get();
        foreach ($products as $product) {
            WSalary::where('product', $product->id)->delete();
        }
    }

    public function reCreateCommandProductI()
    {
        die();
        $products = Product::where(['category' => 1, 'status' => Order::MAKING_PROCESS])->get();
        foreach ($products as $product) {
            (new \App\Services\OrderService())->createWorkerCommand($product);
        }
    }
    
    public function warehouseLogCreate(){
        $tables = ['print_warehouses', 'supply_warehouses', 'square_warehouses', 'other_warehouses', 'extend_warehouses'];
        foreach ($tables as $table) {
            $model = getModelByTable($table);
            $list = $model::all();
            foreach ($list as $item) {
                $data_log['table'] = $table;
                $data_log['type'] = $item['type'];
                $data_log['note'] = 'Nhập từ Misa';
                $data_log['created_by'] = $item['created_by'];
                $data_log['created_at'] = $item['created_at'];
                $data_log['unit'] = getUnitSupply($item['type'], $item);
                $data_log['name'] = $item['name'];
                $data_log['target'] = $item['id'];
                $data_log['ex_inventory'] = 0;
                $data_log['imported'] = $item['qty'];
                $data_log['exported'] = 0;
                $data_log['inventory'] = $item['qty'];
                \DB::table('warehouse_histories')->insert($data_log);
            }
        }
    }

    public function updateTotalSalaryPrint()
    {
        $data = WSalary::where(['type' => 'print', 'status' => 'submited'])->get();
        foreach ($data as $salary) {
            $supply = Paper::find($salary['supply']);
            $print = json_decode($supply->print, true);
            $update['total'] = Paper::getPrintFormula($print['type'], $salary['qty'], $print['color'], $salary['work_price'], $salary['shape_price'], 0, true);
            \DB::table('w_salaries')->where('id', $salary['id'])->update($update);
        }
    }

    public function updateTotalSalaryFill()
    {
        $data = WSalary::where(['type' => 'fill', 'status' => 'submited'])->get();
        foreach ($data as $salary) {
            $fill_handle = json_decode($salary->fill_handle);
            $data_device = Device::find($fill_handle->machine); 
            $total = $salary->qty * $data_device->w_work_price + $data_device->w_shape_price;
            WSalary::where('id', $salary->id)->update(['total' => $total]);
            dump($total, $salary->total);
        }
    }

    public function updateTotalSalaryMill()
    {
        $data = WSalary::where(['type' => 'mill', 'status' => 'submited'])->get();
        foreach ($data as $salary) {
            $total = $salary->qty * 25 * $salary->factor + 35000;
            WSalary::where('id', $salary->id)->update(['total' => $total, 'work_price' => 25, 'shape_price' => 35000]);
            dump($total, $salary->total);
        }
    }

    public function updateQtyCSupply()
    {
        die();
        $data = CSupply::all();
        foreach ($data as $c_supply) {
            $qty = $c_supply['qty'];
            if (SquareWarehouse::countPriceByWeight($c_supply['supp_type'])) {
                $arr['qty'] = SquareWarehouse::getWeightByLength($c_supply['size_type'], $qty);
            }else{
                $arr['qty'] = $qty;
            }
            Csupply::where('id', $c_supply['id'])->update(['qty' => json_encode($arr)]);
            dump(json_encode($arr));
        }
    }

    public function updateTypeBuying()
    {
        $data = SupplyBuying::where([['status', '!=', 'submited']])->get();
        foreach ($data as $buying) {
            $supply = json_decode($buying->supply, true);
            $supply_item = reset($supply);
            $type = in_array($supply_item['type'], \TDConst::ARR_ALL_SUPPLY) ? $supply_item['type'] : 'other';
            SupplyBuying::where('id', $buying->id)->update(['type' => $type]);
        }
    }

    public function updateMetalaiSupply()
    {
        $data = SquareWarehouse::where(['type' => 'metalai', 'supp_price' => 1])->get();
        foreach ($data as $square) {
            SquareWarehouse::where('id', $square->id)->update(['supp_price' => 36]);
        }
    }

    public function productWarehouseLog(){
        $list = ProductWarehouse::get();
        foreach ($list as $item) {
            ProductHistory::doLogWarehouse($item->id, $item->qty, 0, 0, 0, ['price' => $item->price, 'note' => 'Kiểm kho thành phẩm dưới nhà máy']);
        }
    }

    public function removeLogProductWarehouse(){
        $data = ProductHistory::get();
        foreach ($data as $log) {
            if (!empty($log['receipt'])) {
                removeFileData($log['receipt']);
            }
            ProductHistory::where('id', $log->id)->delete();
        }
    }

    public function productDeliveryUpdate(){
        $list = Product::all();
            foreach ($list as $item) {
                Product::where('id', $item->id)->update(['delivery' => $item->qty]);
            }
    }
    
    public function createdCOrderForAdvanceOrder(){
        $data = Order::where('advance', '>', 0)->get();
        $insert = [];
        foreach ($data as $order) {
            $insert['advance'] = $order['advance'];
            $insert['receipt'] = $order['rest_bill'];
            $insert['name'] = getFieldDataById('name', 'customers', $order['customer']).' tạm ứng '. $order['code'];
            $insert['type'] = COrder::ADVANCE;
            $insert['customer'] = $order['customer'];
            $insert['represent'] = $order['represent'];
            $insert['order'] = $order['id'];
            $insert['status'] = \StatusConst::ACCEPTED;
            $insert['rest'] = 0;
            $insert['act'] = 1;
            $insert['created_by'] = $order['created_by'];
            $insert['created_at'] = $order['created_at'];
            $c_id = COrder::insertGetId($insert);
            COrder::getInsertCode($c_id);
        }
    }

    public function updateDeliveryStatusOrder(){
        $data = COrder::where(['type' => COrder::ORDER])->get();
        foreach ($data as $c_order) {
            Order::where('id', $c_order->order)->update(['status' => Order::DELIVERIED]);
        }
    }

    public function handleSuppBuyingDebt(){
        $data = SupplyBuying::where(['status' => 'submited'])->get();
        foreach ($data as $buying) {
            SupplyBuying::where('id', $buying->id)->update(['advance' => $buying->total]);
        }
    }

    public function createDirInStorage()
    {
        $directories = [
            'app/chunks',
            'app/public/uploads',
            'framework/cache/data',
            'framework/cache/laravel-excel',
            'framework/sessions',
            'framework/testing',
            'framework/views'
        ];
        
        foreach ($directories as $directory) {
            $directory = storage_path($directory);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
                echo "Directory '$directory' created successfully!<br>";
            } else {
                echo "Directory '$directory' already exists.<br>";
            }
        }
    }

    public function updateOrderProductOldExpertise(){
        $data = Order::where('created_at', '<=', \Carbon\Carbon::create(2024, 7, 13)->endOfDay())->whereIn('status', [\StatusConst::IMPORTED, Order::DELIVERIED])->get();
        foreach ($data as $order) {
            $products = Product::where('product_warehouse', '!=', NULL)->where('order', $order->id)->get();
            foreach ($products as $product) {
                $history = ProductHistory::where('product', $product->id)->first();
                $pro_warehouse = ProductWarehouse::find($history->target);
                Product::where('id', $product->id)->update(['product_warehouse' => $pro_warehouse->id]);
            }

        }
    }

    public function productDataHandingFill(){
        $products = Product::where(['category' => 1, 'status' => 'making_process'])->get();
        foreach ($products as $product) {
            $fill_finishs = FillFinish::where('product', $product->id)->get();
            foreach ($fill_finishs as $fill_finish) {
                $handle = json_decode($fill_finish->fill, true);
                if (!empty($handle['handled'])) {
                    $fill_next = checkFillToFinish($fill_finish, $handle, 'finish');
                    dump($product->code, $handle['handled'], $handle['handle_qty']);
                    dump('____________');
                    $handle['handled'] = $fill_next['min_command'];
                    FillFinish::where('id', $fill_finish->id)->update(['fill' => json_encode($handle)]);
                }
            }
        }
    }

    public function productDataHanding(){
        $products = Product::where(['status' => 'making_process'])->get();
        foreach ($products as $product) {
            $childs = Product::$childTable;
            foreach ($childs as $table) {
                $supps = \DB::table($table)->where('product', $product->id)->get();
                foreach ($supps as $supp) {
                    $arr = [];
                    foreach ($supp as $type => $json_handle) {
                        $handle = json_decode($json_handle, true);
                        $arr_select = getArrHandleField($table);
                        if (in_array($type, $arr_select) && in_array(@$handle['act'], [1, 2])) {
                            $n_qty = !empty($supp->nqty) ? $supp->nqty : 1;
                            $handled = @$handle['handled'] ?? 0;
                            $arr[] = !isQtyFormulaBySupply($type) ? $handled : $handled * $n_qty;
                        }
                    }
                    \DB::table($table)->where('id', $supp->id)->update(['handled' => collect($arr)->min()]);
                }
            }
        }
    }

    public function createCProductForSubmitedProduct(){
        $products = Product::where(['status' => 'submited'])->get();
        foreach ($products as $product) {
            $data_insert = [
                'name' => 'KCS Thành phẩm - '.$product->name,
                'product' => $product->id,
                'qty' => $product->qty,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'act' => 1,
               'status' => \StatusConst::PROCESSING
            ];
            $c_id = CProduct::insertGetId($data_insert);
            CProduct::getInsertCode($c_id);
        }
    }

    public function handleAfterPrintCheckedWithBug(){
        $afterPrints = AfterPrint::where('status', 'processing')->get();
        foreach ($afterPrints as $after_print) {
            WSalary::where('id', $after_print->w_salary)->update(['status' => 'checking']);
        }
    }

    public function handlePriceDelivery(){
        $data = COrder::whereNotNull('object')->get();
        foreach ($data as $c_order) {
            $objects = json_decode($c_order->object, true);
            foreach ($objects as $key => $object) {
                if ($object['price'] == 0) {
                    $object_qty = !empty($object['qty']) ? $object['qty'] : 1;
                    $objects[$key]['price'] = (int)($object['total']/$object_qty);
                }
            }
            COrder::where('id', $c_order->id)->update(['object' => json_encode($objects)]);
        }
    }

    public function handleWarehouseTypeCOrderSell()
    {
        $c_orders = COrder::where('type', COrder::SELL)->get();
        foreach ($c_orders as $c_order) {
            $object = !empty($c_order->object) ? json_decode($c_order->object, true) : [];
            if (!empty($object[0]['warehouse_type'])) {
                COrder::where('id', $c_order->id)->update(['warehouse_type' => $object[0]['warehouse_type']]);
            }
        }
    }

    public function insertCodeProductWarehouse()
    {
        $data = ProductWarehouse::get();
        foreach ($data as $product) {
            ProductWarehouse::where('id', $product->id)->update(['code' => 'SP-'.formatCodeInsert($product->id)]);
        }
    }

    public function COrderLogTakeSellUser()
    {
        $data = COrder::whereIn('type', [COrder::SELL, COrder::ORDER])->where('status', \StatusConst::ACCEPTED)->get();
        foreach ($data as $order) {
            $confirm_warehouse = $order->warehouse_type == COrder::WH_FACTORY ? 22 : 25;
            COrder::where('id', $order->id)->update(['confirm_warehouse' => $confirm_warehouse]);
        }
    }
    
}

