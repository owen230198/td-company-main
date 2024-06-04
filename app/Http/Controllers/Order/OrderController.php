<?php
    namespace App\Http\Controllers\Order;
    use App\Http\Controllers\Controller;
    use App\Models\CSupply;
    use Illuminate\Http\Request;
    use App\Models\Order;
    use App\Models\Quote;
    use App\Models\SupplyWarehouse;
    use App\Models\Product;
    use App\Models\WSalary;

    class OrderController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->services = new \App\Services\OrderService;
            $this->quote_services = new \App\Services\QuoteService;
        }

        public function insertByQuote($request)
        {
            $quote_id = $request->input('quote');
            $quote_obj = Quote::find($quote_id);
            if (!$request->isMethod('POST')) {
                if (empty($quote_obj) || @$quote_obj['status'] == \StatusConst::NOT_ACCEPTED) {
                    return back()->with('error', 'Dữ liệu báo giá không hợp lệ!');
                }
                if ($quote_obj['status'] == Quote::ORDER_CREATED) {
                    return back()->with('error', 'Bạn đã tạo đơn hàng cho báo giá này rồi !');
                }
                $data = $this->services->getBaseDataAction();
                $data['data_order']['customer'] = $quote_obj['customer_id'];
                $data['order_cost'] = @$quote_obj['total_amount'];
                $data['products'] = Product::where(['act' => 1, 'quote_id' => $quote_id])->get();
                $data['product_qty'] = count($data['products']);
                $data['order_type'] = \OrderConst::INCLUDE;
                $data['title'] = 'Thêm đơn hàng - Mã báo giá : '.$quote_obj['seri'];
                $data['link_action'] = url('insert/orders?quote='.$quote_id);
                return view('orders.view', $data);
            }else{
                if (!empty($request['order']['status'])) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                return $this->services->processDataOrder($request, $quote_obj); 
            } 
        }

        public function insert(Request $request)
        {
            if (!empty($request->input('quote'))) {
                return $this->insertByQuote($request);
            }else{
                return $this->services->processDataOrder($request); 
            }  
        }

        public function update(Request $request, $id){
            $order_obj = Order::find($id);
            if (!$request->isMethod('POST')) {
                if (empty($order_obj)) {
                    return back()->with('error', 'Dữ liệu Đơn hàng không hợp lệ!');
                }
                $data = $this->services->getBaseDataAction();
                $data['order_cost'] = @$order_obj['total_amount'];
                $data['products'] = Product::where(['act' => 1, 'order' => $id])->get();
                $data['product_qty'] = count($data['products']);
                $data['data_order'] = $order_obj;
                $data['order_type'] = \OrderConst::INCLUDE;
                $data['title'] = 'Cập nhật & Xác nhận đơn - '.$order_obj['code'];
                $data['link_action'] = url('update/orders/'.$id);
                $data['id'] = $id;
                $data['stage'] = $order_obj['status'];
                $blade_to = 'orders.users.'.\GroupUser::getCurrent().'.view';
                if (view()->exists($blade_to)) {
                    return view($blade_to, $data);
                }else{
                    return back()->with('error', 'Bạn không có quyền truy cập giao diện này !');
                } 
            }else{
                if (!empty($request['order']['status'])) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                return $this->services->processDataOrder($request, $order_obj);           
            }
        }

        public function clone(Request $request)
        {
            dd(11);
        }

        public function applyToDesign($data, $base_obj, $order_obj)
        {
            if (\GroupUser::isTechApply() || \GroupUser::isAdmin()) {
                if (@$base_obj->status != \StatusConst::NOT_ACCEPTED) {
                    return returnMessageAjax(100, 'Lỗi không xác định !');
                }
                $product_process = $this->quote_services->processDataProduct($data, $order_obj, \TDConst::ORDER_ACTION_FLOW);
                if (!empty($product_process['code']) && $product_process['code'] == 100) {
                    return returnMessageAjax(100, $product_process['message']);  
                }
                if (@$arr_quote['profit'] < getDataConfig('QuoteConfig', 'QUOTE_PERCENT', 0)) {
                    if (!\GroupUser::isAdmin()) {
                        return returnMessageAjax(100, 'Lợi nhuận cho đơn hàng này là: '.(float) getFieldDataById('profit', 'orders', $order_obj->id).'%, Vui lòng liên hệ Admin cấp cao để được duyệt đơn !');
                    }
                }
                $status = $this->services->insertDesignCommand($data['product'], $order_obj->id, $base_obj->code);
                if ($status) {
                    return returnMessageAjax(200, 'Đã thêm lệnh thiết kế cho đơn hàng '.$base_obj->code.' !', getBackUrl());
                }    
            }else{
                return returnMessageAjax(100, 'Bạn không có quyền duyệt sản xuất!');
            }
        }

        public function applyToHandlePlan($data, $base_obj, $order_obj)
        {
            if (\GroupUser::isTechHandle()) {
                if (@$base_obj->status != Order::DESIGN_SUBMITED) {
                    returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                $product_process = $this->quote_services->processDataProduct($data, $order_obj, \TDConst::ORDER_ACTION_FLOW);
                if (!empty($product_process['code']) && $product_process['code'] == 100) {
                    return returnMessageAjax(100, $product_process['message']);  
                }
                $arr_update = ['status' => Order::TECH_SUBMITED];
                foreach ($data['product'] as $product) {
                    Product::where('id', $product['id'])->update($arr_update);
                    $product_obj = Product::find($product['id']);
                    if (!empty($product_obj)) {
                        $elements = getProductElementData($product_obj['category'], $product_obj['id'], true, true);
                        foreach ($elements as $element) {
                            if (!empty($element['data'])) {
                                $el_data = $element['data'];
                                foreach ($el_data as $supply) {
                                    $table_supply = $element['table'];
                                    getModelByTable($table_supply)->where('id', $supply->id)->update($arr_update);
                                }
                            }
                        }
                    }
                }
                if (checkUpdateOrderStatus($order_obj->id, Order::TECH_SUBMITED)) {
                    Order::where('id', $order_obj->id)->update($arr_update);
                }
                return returnMessageAjax(200, 'Đã gửi yêu cầu thành công tới P. Kế hoạch SX cho đơn '.$base_obj->code.' !', getBackUrl()); 
            }else{
                return returnMessageAjax(100, 'Bạn không có quyền duyệt sản xuất!');
            }
        }

        public function applyOrder(Request $request, $stage, $type, $id)
        {
            $data = $request->except('_token');
            $table = $type == \OrderConst::INCLUDE ? 'orders' : 'products';
            $base_obj = \DB::table($table)->find($id);
            $quote_id = $type == \OrderConst::INCLUDE ? @$base_obj->quote : @$base_obj->quote_id;
            $order_id = $type == \OrderConst::INCLUDE ? @$base_obj->id : @$base_obj->order;
            $order_obj = Order::find($order_id);
            switch ($stage) {
                case Order::NOT_ACCEPTED:
                    return $this->applyToDesign($data, $base_obj, $order_obj);
                case Order::DESIGN_SUBMITED:
                    return $this->applyToHandlePlan($data, $base_obj, $order_obj);   
                default:
                    return returnMessageAjax(100, 'Lỗi không xác định !');
            }
        }

        public function receiveCommand($table, $id)
        {
            $model = getModelByTable($table);
            $command = $model::find($id);
            if ($command['status'] != \StatusConst::NOT_ACCEPTED || !empty($command['assign_by'])) {
                $msg = 'Lệnh này đã được nhận ';
                if (!empty($command['assign_by'])) {
                    $msg .= 'bởi '.getFieldDataById('name', 'n_users', $command['assign_by']);
                }
                return returnMessageAjax(100, $msg.' !');
            }
            if (\GroupUser::isAdmin() || \GroupUser::getCurrent() == $model::GR_USER) {
                $process = $model::where('id', $id)->update(['assign_by' => \User::getCurrent('id'), 'status' => $model::PROCESSING]);
                if ($process) {
                    $arr_status = ['status' => $model::PROCESSING];
                    Product::where('id', $command['product'])->update($arr_status);
                    if (checkUpdateOrderStatus($command['id'], $model::PROCESSING)) {
                        Order::where('id', $command['order'])->update($arr_status);
                    }
                    return returnMessageAjax(200, 'Đã tiếp nhận lệnh, vui lòng truy cập danh sách lệnh của bạn!', \StatusConst::RELOAD);
                }else{
                    return returnMessageAjax(100, 'Có lỗi xảy ra, vui lòng thử lại!');
                }       
            }else{
                return returnMessageAjax(100, 'Bạn không thuộc bộ phận nhận lệnh này !');
            }    
        }

        public function supplyHandle(Request $request)
        {
            if (\GroupUser::isAdmin() || \GroupUser::isPlanHandle()) {
                $table = $request->input('table');
                $id = $request->input('id');
                $data_supply = \DB::table($table)->find($id);
                if (empty($data_supply)) {
                    return back()->with('error', 'Dữ liệu không hợp lệ !');
                }
                if ($table == 'papers') {
                    $data_supply->type = \TDConst::PAPER;    
                }elseif ($table == 'fill_finishes') {
                    $data_supply->type = \TDConst::FILL_FINISH; 
                }
                if (getHandleSupplyStatus($data_supply->product, $data_supply->id, $data_supply->type) != CSupply::NOT_HANDLE) {
                    return back()->with('error', 'Vật tư đang được xử lí bởi kế toán kho !');
                }
                $supp_size = !empty($data_supply->size) ? json_decode($data_supply->size, true) : [];
                if (!empty($data_supply)) {
                    if ($request->isMethod('GET')) {
                        $data['supply_obj'] = $data_supply;
                        $data['title'] = 'Xử lí vật tư sản xuất sản phẩm '.getFieldDataById('name', 'products', $data_supply->product);
                        $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách vật tư cần xử lí'];
                        $prefix = !empty($data_supply->type) ? $data_supply->type : $table;
                        $data['pro_index'] = 0;
                        $data['supp_index'] = 0;
                        $data['table'] = $table;
                        $data['supp_view'] = $table;
                        $data['supply_size'] = $supp_size;
                        if (view()->exists('orders.users.6.supply_handles.'.$prefix)) {
                            return view('orders.users.6.supply_handles.'.$prefix, $data); 
                        }else{
                            return back()->with('error', 'Giao diện này không tồn tại!');
                        } 
                    }else{
                        $data_command = $request->input('c_supply');
                        $data_over_supp = $request->input('over_supply');
                        $method_handle_name = 'supply_handle_'.$data_supply->type;
                        if (method_exists($this->services, $method_handle_name)) {
                            return $this->services->{$method_handle_name}($data_supply, $supp_size, $data_command, $data_over_supp);
                        }else{
                            return returnMessageAjax(100, 'Không thể xử lí vật tư !');
                        } 
                    } 
                }else{
                    return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Dữ liệu không hợp lệ']);
                }      
            }else{
                return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Bạn không có quyền thực hiện hành động!']);
            }
        }

        public function selectSupplyWarehouse(Request $request, $table)
        {
            $supply_id = $request->input('supply');
            $model = getModelByTable($table);
            $supply = $model::find($supply_id);
            $need = (float) $request->input('need');
            if (empty($supply)) {
                return returnMessageAjax(100, 'Vật tư không tồn tại hoặc đã bị xóa !');
            }
            return $model::getStructForPlan(['supply' => $supply, 'need' => $need]);
        }

        public function addSelectSupplyHandle(Request $request)
        {
            $data = $request->all();
            return view('orders.users.6.supply_handles.view_handles.'.$data['type'].'.item', $data);
        }

        public function takeOutSupply($id)
        {
            if (\GroupUser::isAdmin() || \GroupUser::isWarehouse()) {
                $command = \DB::table('c_supplies');
                $data_command = $command->find($id);
                if (@$data_command->status != CSupply::HANDLING) {
                    return returnMessageAjax(110, 'Dữ liệu không hợp lệ !');
                } 
                $table_warehouse = getTableWarehouseByType($data_command);
                $warehouse_model = getModelByTable($table_warehouse);
                $data_warehouse = $warehouse_model->find($data_command->size_type);
                if (empty($data_warehouse)) {
                    return returnMessageAjax(110, 'Vật tư không có trong kho !');    
                }
                $cr_qty = (int) $data_warehouse->qty;
                $take_qty = (int) $data_command->qty;
                if ($cr_qty < $take_qty) {
                    return returnMessageAjax(110, 'Vật tư trong kho không đủ để xuất ra, lên hệ gọi thêm vật tư để xử lí đơn này!');
                }
                $data_warehouse->qty = $cr_qty- $take_qty;
                $data_warehouse->save();
                $data_log['name'] = $data_warehouse->name;
                $data_log['table'] = $table_warehouse;
                $data_log['type'] = $data_warehouse->type;
                $data_log['target'] = $data_warehouse->id;
                $data_log['exported'] = $take_qty;
                $data_log['ex_inventory'] = $cr_qty;
                $data_log['inventory'] = $data_warehouse->qty;
                $data_log['product'] = $data_command->product;
                $data_log['c_supply'] = $id;
                (new \BaseService)->configBaseDataAction($data_log);
                \DB::table('warehouse_histories')->insert($data_log);
                $data_update = ['status' => CSupply::HANDLED];
                $update = $command->where('id' , $id)->update($data_update);
                if ($update) {
                    return returnMessageAjax(200, 'Bạn đã xác nhận xuất '.$take_qty.' vật tư!', \StatusConst::RELOAD);
                }  
            }else{
                return returnMessageAjax(110, 'Bạn không có quyền duyệt xuất vật tư!');
            }
        }

        public function takeInSupply($id)
        {
            if (\GroupUser::isAdmin() || \GroupUser::isWarehouse()) {
                $warehouse_table = \DB::table('supply_warehouses');
                $warehouse = $warehouse_table->find($id);
                if (@$warehouse->status != SupplyWarehouse::WAITING) {
                    return returnMessageAjax(110, 'Dữ liệu không hợp lệ!');
                } 
                $data_update = ['status' => SupplyWarehouse::IMPORTED, 
                                'confirm_by' => \User::getCurrent('id'), 
                                'confirm_at' => \Carbon\Carbon::now()];
                $update = $warehouse_table->where('id' , $id)->update($data_update);
                if ($update) {
                    return returnMessageAjax(200, 'Bạn đã xác nhận nhập kho vật tư !', \StatusConst::RELOAD);
                }  
            }else{
                return returnMessageAjax(110, 'Bạn không có quyền duyệt nhập kho vật tư !');
            }
        }

        public function applyToWorkerHandle($table, $id)
        {
            $table_data = \DB::table($table)->where('id', $id);
            $obj_order = $table_data->first();
            if (!\GroupUser::isPlanHandle()) {
                return returnMessageAjax(110, 'Bạn không có quyền duyệt sản xuất !');     
            }
            if (@$obj_order->status != Order::TECH_SUBMITED) {
                return returnMessageAjax(110, 'Dữ liệu không hợp lệ !');
            }
            $elenemt_checks = getProductElementData($obj_order->category, $obj_order->id, true, true);
            foreach ($elenemt_checks as $elenemt_check) {
                if (!empty($elenemt_check['data'])) {
                    $check_data = $elenemt_check['data'];
                    foreach ($check_data as $supply_check) {
                        if (getHandleSupplyStatus($supply_check->product, $supply_check->id, @$elenemt_check['pro_field']) != CSupply::HANDLED) {
                            return returnMessageAjax(100, 'Vật tư '.getSupplyNameByKey($elenemt_check['pro_field']).' vẫn chưa được kế toán duyệt xuất !');
                        }
                    }
                }
            }
            $process = $this->services->createWorkerCommand($obj_order);
            if ($process) {
                $arr_update = ['status' => Order::MAKING_PROCESS];
                $table_data->update($arr_update);
                if (checkUpdateOrderStatus($obj_order->order, Order::MAKING_PROCESS)) {
                    Order::where('id', $obj_order->order)->update($arr_update);
                }
                return returnMessageAjax(200, 'Đã gửi lệnh sản xuất xuống xưởng !', url('view/products?default_data=%7B"status"%3A"'.Order::TECH_SUBMITED.'"%7D'));
            }else{
                return returnMessageAjax(100, 'Đã có lỗi xảy ra, vui lòng thử lại !');
            } 
        }

        public function printData($table, $id)
        {
            $data_item = \DB::table($table)->find($id);
            $data['data_item'] = $data_item;
            if (empty($data['data_item'])) {
                return back()->with('error', 'Dữ liệu không tồn tại hoặc đã bị xóa !');    
            }
            if ($table == 'products') {
                if (!empty($data_item->made_by)) {
                    return back()->with('error', 'Sản phẩm này sản xuất từ đơn vị khác !');
                }
                $data['data_table']['papers'] = \DB::table('papers')->where(['product' => $id, 'handle_type' => \TDConst::MADE_BY_OWN])->get();
                $data['data_table']['supplies'] = \DB::table('supplies')->where('product', $id)->get();
                $data['data_table']['fill_finishes'] = \DB::table('fill_finishes')->where('product', $id)->get();
                $data['return_time'] = getFieldDataById('return_time', 'orders', $data_item->order);
            }else{
                if (!empty($data_item->product)) {
                    $data_product = \DB::table('products')->find($data_item->product);
                    $data['return_time'] = getFieldDataById('return_time', 'orders', $data_product->order);
                }
            }
            $view_path = 'print_data.'.$table.'.view';
            if (!view()->exists($view_path)) {
                return back()->with('error', 'Chức năng không hỗ trợ cho dữ liệu này !');
            }
            return view($view_path, $data);
        }
    }
?>