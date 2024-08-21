<?php
    namespace App\Http\Controllers\Order;
    use App\Http\Controllers\Controller;
    use App\Imports\ImportOrder;
    use App\Models\CSupply;
use App\Models\Customer;
use Illuminate\Http\Request;
    use App\Models\Order;
    use App\Models\Quote;
    use App\Models\Product;
use App\Models\Represent;
use App\Models\WSalary;
    use Maatwebsite\Excel\Facades\Excel;

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
                $data['data_order']['represent'] = $quote_obj['represent'];
                $data['data_order']['customer'] = $quote_obj['customer'];
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
                $data['order_cost'] = @$order_obj['base_total'];
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

        public function clone(Request $request, $id)
        {
            if (!$request->isMethod('GET')) {
                return back()->with('error', 'Yêu cầu không hợp lệ !');
            }
            return (new \App\Services\OrderService)->cloneBaseFlow('orders', $id, 'order');
        }

        public function applyToDesign($data, $base_obj, $order_obj, $type_ref)
        {
            if (\GroupUser::isTechApply() || \GroupUser::isAdmin()) {
                if (@$base_obj->status != \StatusConst::NOT_ACCEPTED) {
                    return returnMessageAjax(100, 'Lỗi không xác định !');
                }
                $product_process = $this->quote_services->processDataProduct($data, $order_obj, $type_ref);
                if (!empty($product_process['code']) && $product_process['code'] == 100) {
                    return returnMessageAjax(100, $product_process['message']);  
                }
                $n_order = Order::find($order_obj->id);
                if (@$n_order->profit < getDataConfig('QuoteConfig', 'QUOTE_PERCENT', 0)) {
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

        public function applyToHandlePlan($data, $base_obj, $order_obj, $type_ref)
        {
            if (\GroupUser::isTechHandle() || \GroupUser::isAdmin()) {
                if (@$base_obj->status != Order::DESIGN_SUBMITED) {
                    returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                $product_process = $this->quote_services->processDataProduct($data, $order_obj, $type_ref);
                if (!empty($product_process['code']) && $product_process['code'] == 100) {
                    return returnMessageAjax(100, $product_process['message']);  
                }
                $tech_submited_status = Order::TECH_SUBMITED;
                $arr_update = ['status' => $tech_submited_status];
                foreach ($data['product'] as $product) {
                    logActionDataById('products', $product['id'], $arr_update, $tech_submited_status);
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
                    logActionDataById('orders', $order_obj->id, $arr_update, $tech_submited_status);
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
            $order_id = $type == \OrderConst::INCLUDE ? @$base_obj->id : @$base_obj->order;
            $order_obj = Order::find($order_id);
            $type_refresh = !empty($data['type_refresh']) ? $data['type_refresh'] : 2;
            switch ($stage) {
                case Order::NOT_ACCEPTED:
                    return $this->applyToDesign($data, $base_obj, $order_obj, $type_refresh);
                case Order::DESIGN_SUBMITED:
                    return $this->applyToHandlePlan($data, $base_obj, $order_obj, $type_refresh);   
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
                $processing_status = $model::PROCESSING;
                $itemLog = $command->replicate();
                $process = $command->update(['assign_by' => \User::getCurrent('id'), 'status' => $processing_status]);
                logActionUserData($processing_status, $table, $id, $itemLog);
                if ($process) {
                    $arr_status = ['status' => $processing_status];
                    logActionDataById('products', $command['product'], $arr_status, $processing_status);
                    if (checkUpdateOrderStatus($command['id'], $processing_status)) {
                        logActionDataById('orders', $command['order'], $arr_status, $processing_status);
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
            if (\GroupUser::isPlanHandle()) {
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
                        $data['product'] = Product::find($data_supply->product); 
                        if (view()->exists('orders.users.6.supply_handles.'.$prefix)) {
                            return view('orders.users.6.supply_handles.'.$prefix, $data); 
                        }else{
                            return back()->with('error', 'Giao diện này không tồn tại!');
                        } 
                    }else{
                        $data_command = $request->input('c_supply');
                        $method_handle_name = 'supply_handle_'.$data_supply->type;
                        if (method_exists($this->services, $method_handle_name)) {
                            return $this->services->{$method_handle_name}($data_supply, $supp_size, $data_command);
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

        public function takeInSupply($id)
        {
            if (\GroupUser::isAdmin() || \GroupUser::isWarehouse()) {
                $warehouse_table = \DB::table('supply_warehouses');
                $warehouse = $warehouse_table->find($id);
                if (@$warehouse->status != \StatusConst::WAITING) {
                    return returnMessageAjax(110, 'Dữ liệu không hợp lệ!');
                } 
                $data_update = ['status' => \StatusConst::IMPORTED, 
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
            // foreach ($elenemt_checks as $elenemt_check) {
            //     if (!empty($elenemt_check['data'])) {
            //         $check_data = $elenemt_check['data'];
            //         foreach ($check_data as $supply_check) {
            //             if (getHandleSupplyStatus($supply_check->product, $supply_check->id, @$elenemt_check['pro_field']) != CSupply::HANDLED) {
            //                 return returnMessageAjax(100, 'Vật tư '.getSupplyNameByKey($elenemt_check['pro_field']).' vẫn chưa được kế toán duyệt xuất !');
            //             }
            //         }
            //     }
            // }
            $process = $this->services->createWorkerCommand($obj_order);
            if ($process) {
                $making_process_status = Order::MAKING_PROCESS;
                $arr_update = ['status' => $making_process_status];
                $table_data->update($arr_update);
                logActionUserData($making_process_status, $table, $id, $obj_order);
                if (checkUpdateOrderStatus($obj_order->order, Order::MAKING_PROCESS)) {
                    logActionDataById('orders', $obj_order->order, $arr_update, $making_process_status);
                }
                return returnMessageAjax(200, 'Đã gửi lệnh sản xuất xuống xưởng !', url('view/products?default_data=%7B"status"%3A"'.Order::TECH_SUBMITED.'"%7D'));
            }else{
                return returnMessageAjax(100, 'Đã có lỗi xảy ra, vui lòng thử lại !');
            } 
        }

        public function printData(Request $request, $table, $id)
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
                $data['arr_tables'] = !empty($request->input('table')) ? array($request->input('table')) : ['papers', 'supplies', 'fill_finishes'];
                foreach ($data['arr_tables'] as $table_supp) {
                    $where = ['product' => $id];
                    $req_table = !empty($request->input('table')) ? $request->input('table') : '';
                    if ($req_table == 'supplies' && !empty($request->input('type'))) {
                        $where['type'] = $request->input('type');
                    }
                    if ($table_supp == 'papers') {
                        $where['handle_type'] = \TDConst::MADE_BY_OWN;
                    }
                    $data['data_table'][$table_supp] = \DB::table($table_supp)->where($where)->get();
                }
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

        public function profitConfigData(Request $request)
        {
            $is_post = $request->isMethod('POST');	
            if (!\GroupUser::isAdmin()) {
                return customReturnMessage(false, $is_post, ['message' => 'Bạn không có quyền xem chi tiết công thức !']);
            }
            $table = $request->input('table');
            if (!in_array($table, ['quotes', 'orders'])) {
                return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
            }
            if ($table == 'quotes') {
                return (new \App\Http\Controllers\Quote\QuoteController)->profitConfigQuote($request);
            }else{
                $id = $request->input('id');
                $order = Order::find($id);
                if (empty($order)) {
                    return back()->with('error', 'Đơn hàng không tồn tại hoặc đã bị xóa !');
                }
                $data['data_item'] = $order;
                $data['title'] = 'Chi tiết chi phí - '.$order['code'];
                $data['products'] = Product::where(['act' => 1, 'order' => $id])->get();
                $data['supply_fields'] = \TDConst::HARD_ELEMENT;
                return view('orders.profits.view', $data);
            }
        }

        public function orderDelivery(Request $request, $id)
        {
            $is_post = $request->isMethod('POST');
            if (\GroupUser::isAdmin() || \GroupUser::isAccounting()) {
                $order = Order::find($id);
                if (empty($order)) {
                    return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu đơn hàng không tồn tại hoặc đã bị xóa !']);
                }
                if (!$is_post) {
                    $data['title'] = 'Xác nhận giao hàng - '.$order->code;
                    $data['order'] = $order;
                    $data['products'] = Product::where('order', $id)->get();
                    $data['nosidebar'] = true;
                    $data['field_note'] = [
                        'min_label' => 120,
                        'name' => 'log[note]',
                        'note' => 'Ghi chú',
                        'type' => 'textarea'
                    ];
                    $customer = Customer::find($order->customer);
                    $represent = Represent::find($order->represent);
                    $data['customer'] = $customer;
                    $data['represent'] = $represent;
                    $phone = $represent->phone;
                    if (!empty($represent->telephone)) {
                        $phone .= ' - '.$represent->telephone;
                    } 
                    $data['customer_infos'] = [
                        [
                            'name' => 'Tên Khách hàng/Công ty',
                            'value' => $customer->name.' ('.$represent->name.')'
                        ],
                        [
                            'name' => 'Địa chỉ',
                            'value' => $customer->address
                        ],
                        [
                            'name' => 'tel',
                            'value' => $phone
                        ],
                        [
                            'name' => 'NV bán hàng',
                            'value' => getFieldDataById('name', 'n_users', $order->created_by)
                        ]
                    ];
                    $data['document_infos'] = [
                        [
                            'min_label' => 120,
                            'name' => 'Số chứng từ',
                            'value' => 'BH'.formatCodeInsert($order->id)
                        ],
                        [
                            'min_label' => 120,
                            'name' => 'Ngày hạch toán',
                            'value' => date('d/m/Y', Time())
                        ],
                        [
                            'min_label' => 120,
                            'name' => 'Ngày chứng từ',
                            'value' => date('d/m/Y', Time())
                        ],
                        [
                            'min_label' => 120,
                            'name' => 'Người lập',
                            'value' => \User::getCurrent('name')
                        ]
                    ];
                    $data['deliver_total'] = 0;
                    return view('orders.deliveries.view', $data);
                }
            }else{
                return customReturnMessage(false, $is_post, ['message' => 'Bạn không có quyền xác nhận giao hàng cho đơn hàng này !']);
            }
        }
        public function import($file)
        {
            $arr_file = pathinfo($file->getClientOriginalName());
            $obj = new ImportOrder($arr_file['filename']);
            $data = Excel::toArray($obj, $file);
            $codes = array_map(function($item) {
                return trim($item['code']);
            }, $data[0]);
            $commands = array_unique($codes);
            $query = WSalary::whereMonth('created_at', 7)
                  ->whereYear('created_at', 2024);
            foreach ($commands as $command) {
                $query->where('command', 'NOT LIKE', '%' . trim($command) . '%');
            }
            $query->update(['status' => 'old_salary']);
            return returnMessageAjax(200, 'Đã thêm vật tư thành công !', \StatusConst::RELOAD);
        }
    }
?>