<?php
    namespace App\Http\Controllers\Product;
    use App\Http\Controllers\Controller;
    use App\Models\AfterPrint;
    use App\Models\CExpertise;
    use App\Models\COrder;
    use App\Models\CProduct;
    use App\Models\CRework;
    use App\Models\Order;
    use App\Models\Paper;
    use App\Models\Product;
use App\Models\WSalary;
use App\Models\WUser;
    use Illuminate\Http\Request;
    class ProductController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->services = new \App\Services\ProductService;
            $this->quote_services = new \App\Services\QuoteService;        
        }

        public function update($request, $id)
        {
            $product = Product::find($id);
            if (empty($product)) {
                return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Dữ liệu không hợp lệ!']);
            }
            if ($request->isMethod('GET')) {
                $data['products'][0] = $product;
                $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách đơn sản phẩm'];
                $data['title'] = 'Cập nhật & Xác nhận đơn sản phẩm - '.$product['code'];
                $data['link_action'] = url('update/products/'.$id);
                $data['id'] = $id;
                $data['stage'] = $product['status'];
                $data['product_obj'] = $product;
                $group_user = \GroupUser::getCurrent();
                if ($group_user == \GroupUser::PLAN_HANDLE) {
                    $data['elements'] = getProductElementData($product['category'], $product['id'], true, false, true);
                    $elements = collect($data['elements']);
                    $first_element = $elements->first();
                    $data['key_supply'] = !empty($request->get('key_supply')) ? $request->get('key_supply') : ($first_element['pro_field'] ?? \TDConst::PAPER);
                    session()->put('back_url', url()->full());
                }
                if (view()->exists('orders.users.'.$group_user.'.view')) {
                    return view('orders.users.'.$group_user.'.view', $data);
                }else{
                    return back()->with('error', 'Bạn không có quyền truy cập giao diện này !');
                }
            }else{
                $data = $request->except('_token');
                $order_obj = Order::find($product->order);
                $is_join_product = Product::isJoinProduct($product);
                if (!$is_join_product && empty($order_obj)) {
                    return returnMessageAjax(100, 'Đơn hàng không tồn tại hoặc đã bị xóa !');
                }
                $type_refresh = !empty($data['type_refresh']) ? $data['type_refresh'] : 2;
                $process = $this->quote_services->processDataProduct($data, $order_obj, $type_refresh, !$is_join_product);
                if ($is_join_product) {
                    logActionDataById('products', $id, getTotalProductByArr([$product]), 'update');   
                }
                if (!empty($process['code']) && $process['code'] == 100) {
                    return returnMessageAjax(100, $process['message']);  
                }else{
                    // Product::handleCommandCode($product, $product->code);
                    $ret_url = !\GroupUser::isAdmin() || empty($order_obj) ? getBackUrl() : url('/profit-config-data?table=orders&id='.$order_obj->id);
                    return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', $ret_url);       
                }
            } 
        }
        
        public function clone($request, $id)
        {
            if (!$request->isMethod('GET')) {
                return back()->with('error', 'Yêu cầu không hợp lệ !');
            }
            $data_product = Product::where('id', $id)->get();
            if (empty($data_product)) {
                return back()->with('error', 'Sản phẩm không tồn tại hoặc đã bị xóa !');
            }
            $product_obj = $data_product->first();
            $data_order = Order::find($product_obj['order']);
            if (empty($data_order)) {
                return back()->with('error', 'Đơn hàng không tồn tại hoặc đã bị xóa !');
            }
            $hidden_fields = \StatusConst::HIDDEN_CLONE_FIELD;
            $data_products = $data_product->makeHidden($hidden_fields)->toArray();
            $hidden_fields['return_time'] = '';
            $arr_order = $data_order->makeHidden($hidden_fields)->toArray();
            unset($arr_order['id']);
            (new \BaseService())->configBaseDataAction($arr_order);
            $arr_order['status'] = \StatusConst::NOT_ACCEPTED;
            $order_id = Order::insertGetId($arr_order);
            $order_update = ['code' => 'DH-'.sprintf("%08s", $order_id)];
            Order::where('id', $order_id)->update($order_update);
            //log insert table
            logActionUserData('insert', 'orders', $order_id, $arr_order);
            if ($order_id) {
                Product::handleCloneData($data_products, $order_id, 'order', true);
                return redirect('update/orders/'.$order_id)->with('message', 'Sao chép dữ liệu thành công !');
            }else{
                return back()->with('error', 'Đã xảy ra lỗi khi thực hiện sao chép !');
            } 
            
        }

        public function listSupplyProcess(Request $request)
        {
            $product_id = !empty($request->input('product')) ? $request->input('product') : 0;
            $data_product = Product::find($product_id);
            if (empty($data_product)) {
                return back()->with('error', 'Không tìm thấy dữ liệu sản phẩm !');
            }
            $data['nosidebar'] = true;
            $data['title'] = 'Thông tin sản xuất - '.$data_product['name'];
            $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách đơn sản phẩm'];
            $data['elements'] = getProductElementData($data_product['category'], $product_id, true, false, true);
            $data['product_id'] = $product_id;
            return view('products.view', $data);
        }

        public function KCSTakeInRequirement(Request $request, $id)
        {
            $is_post = $request->isMethod('POST');
            if (\GroupUser::isAdmin() || \GroupUser::isKCS()) {
                $obj = CProduct::find($id);
                $product_obj = Product::find($obj->product);
                if (empty($obj) || empty($obj) || @$obj->status != \StatusConst::PROCESSING) {
                    return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
                }
                if (!$is_post) {
                    $data['title'] = 'Thẩm định sau sản xuất sản phẩm '.$product_obj->name;
                    $data['nosidebar'] = true;
                    $data['data_product'] = $obj;
                    $data['status_exper_option'] = [CExpertise::FULL => 'Nhập kho toàn bộ lệnh ('.$obj->qty.' sản phẩm)', CExpertise::PROBLEM => 'Nhập kho thiếu do lỗi kỹ thuật'];
                    $data['prob_handle_option'] = ['' => 'Xử lí sản phẩm lỗi',CExpertise::NOT_REWORK => 'Không sản xuất lại', CExpertise::REWORK => 'Sản xuất lại'];
                    $data['field_group_user'] = WUser::getGroupUserFields();
                    return view('kcs.requrirements.view', $data);
                }else{
                    $data = $request->except('_token');
                    if (empty($data['note'])) {
                        return returnMessageAjax(100, 'Bạn chưa nhập ghi chú yêu cầu nhập kho !');
                    }
                    if (empty($data['take_status'])) {
                        return returnMessageAjax(100, 'Bạn chưa chọn trạng thái nhập kho !');
                    }
                    $is_problem = $data['take_status'] == CExpertise::PROBLEM;
                    $is_rework = $is_problem && @$data['handle_problem'] == CExpertise::REWORK;
                    $product_qty = $obj->qty;
                    if ($is_problem) {
                        if (empty($data['qty'])) {
                            return returnMessageAjax(100, 'Bạn chưa nhập số lượng đủ điều kiện nhập kho !');
                        }
                        if (empty($data['qty']) || $data['qty'] >= $product_qty) {
                            return returnMessageAjax(100, 'Số lượng nhập kho không hợp lệ !');
                        }
                        if (empty($data['handle_problem'])) {
                            return returnMessageAjax(100, 'Bạn chưa chọn phương án xử lí sản phẩm lỗi !');
                        }
                        if ($is_rework && empty($data['type'])) {
                            return returnMessageAjax(100, 'Bạn chưa chọn khâu sản xuất sản phẩm lỗi !');
                        }
                        
                        if ($is_rework && empty($data['worker'])) {
                            return returnMessageAjax(100, 'Bạn chưa chọn công nhân sản xuất sản phẩm lỗi !');
                        }
                    }
                    $count_exist = CExpertise::where('product', $product_obj->id)->count();
                    $data_insert['name'] = 'Nhập kho '.' '.$product_obj->name;
                    if ((int) $count_exist > 0) {
                        $data_insert['name'] .= ' (đợt '.$count_exist.')';  
                    }
                    $data_insert['qty'] = @$data['qty'] ?? $product_qty;
                    $data_insert['product'] = $product_obj->id;
                    $data_insert['take_status'] = @$data['take_status'] ?? CExpertise::FULL;
                    $data_insert['handle_problem'] = @$data['handle_problem'] ?? CExpertise::NOT_REWORK;
                    $data_insert['note'] = $data['note'];
                    $data_insert['status'] = \StatusConst::NOT_ACCEPTED;
                    $this->services->configBaseDataAction($data_insert);
                    $insert_id = CExpertise::insertGetId($data_insert);

                    if ($is_rework) {
                        $data_rework['name'] = 'Sản xuất lại '.$product_obj->name;
                        $data_rework['product'] = $product_obj->id;
                        $data_rework['type'] = $data['type'];
                        $data_rework['worker'] = $data['worker'];
                        $data_rework['qty'] = $product_qty - $data['qty']; 
                        $data_rework['status'] = \StatusConst::NOT_ACCEPTED;
                        $data_rework['rework_status'] = Product::NEED_REWORK;
                        (new \BaseService)->configBaseDataAction($data_rework);
                        $rework_id = CRework::insertGetId($data_rework);
                        CRework::where('id', $rework_id)->update(['code' => 'RW-'.formatCodeInsert($rework_id)]);
                        logActionUserData('insert', 'c_reworks', $rework_id);
                    }
                    
                    if ($insert_id) {
                        CExpertise::where('id', $insert_id)->update(['code' => 'NK-'.formatCodeInsert($insert_id)]);
                        logActionUserData('insert', 'c_expertises', $insert_id);
                        $obj->status = \StatusConst::SUBMITED;
                        $obj->save();
                        return returnMessageAjax(200, 'Yêu cầu nhập kho sản phẩm thành công !', \StatusConst::CLOSE_POPUP);
                    }else{
                        return returnMessageAjax(100, 'Lỗi không xác định !');
                    }
                }
            }else{
                return customReturnMessage(false, $is_post, ['message' => 'Bạn không có quyền thực hiện thao tác này !']);
            }
        }

        public function validateSupply($data, $req_qty)
        {
            $arr[\TDConst::PAPER] = 'Giấy in';
            $arr = $arr + \TDConst::ALL_HANDLE_SUPPLY;
            foreach ($arr as $key => $name) {
                if (!empty($data[$key])) {
                    foreach ($data[$key] as $supply) {
                        if ((int) @$supply['qty'] < $req_qty) {
                            $supp_name = $key == \TDConst::PAPER ? $supply['name'] : $name;
                            return returnMessageAjax(100, 'Số lượng sản xuất lại cho vật tư '.$supp_name.' không hợp lệ !');
                        }
                    }
                }
            }
            if (!empty($data[\TDConst::FILL_FINISH])) {
                if ((int) @$data[\TDConst::FILL_FINISH]['qty'] < $req_qty) {
                    return returnMessageAjax(100, 'Số lượng sản xuất lại cho khâu hoàn thiện cuối không hợp lệ !');
                }
            }
            return ['code' => 200];   
        }

        public function productRequireRework(Request $request, $id)
        {
            $is_post = $request->isMethod('POST');
            if (\GroupUser::isAdmin() || \GroupUser::isSale()) {
                $obj = CRework::find($id);
                if (empty($obj) || @$obj->status != \StatusConst::NOT_ACCEPTED || @$obj->rework_status != Product::NEED_REWORK) {
                    return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
                }
                $req_qty = (int) @$obj->qty;
                if ($req_qty <= 0) {
                    return customReturnMessage(false, $is_post, ['message' => 'Số lượng cần sản phẩm cần sản xuất lại không hợp lệ !']);
                }
                $product_obj = Product::find($obj->product);
                if (empty($product_obj)) {
                    return customReturnMessage(false, $is_post, ['message' => 'Không tìm thấy dữ liệu sản phẩm !']);
                }
                if (!$is_post) {
                    $data['nosidebar'] = true;
                    $data['title'] = 'Yêu cầu sản xuất lại '.$req_qty.' sản phẩm '.$product_obj->name;
                    $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Yêu cầu sản xuất lại'];
                    $product_obj->name = $product_obj->name;
                    $product_obj->qty = '';
                    $product_obj->design = 4;
                    $product_obj->status = '';
                    $data['product'] = $product_obj;
                    $data['data_rework'] = $obj;
                    $data['cate'] = $product_obj->category;
                    $data['elements'] = getProductElementData($data['cate'], $product_obj->id, false, false, true, true);
                    return view('kcs.reworks.view', $data);
                }else{
                    $data = $request->except('_token');
                    if (@$data['status'] == 'not_need_rework') {
                        $obj->status = \StatusConst::SUBMITED;
                        $obj->rework_status = Product::NO_REWORK;
                        $obj->note = @$data['note'];
                        $status = $obj->save();   
                        return returnMessageAjax(200, 'Đã xác nhận không cần sản xuất lại lí do: '.$data['note']);
                    }
                    $data_product = !empty($data['product'][0]) ? $data['product'][0] : [];
                    if (empty($data_product)) {
                        return returnMessageAjax(100, 'Không tìm thấy dữ liệu sản phẩm !');
                    }
                    if ((int) $data_product['qty'] < $req_qty) {
                        return returnMessageAjax(100, 'Số lượng sản phẩm sản xuất lại không hợp lệ !');
                    }
                    $validate = $this->validateSupply($data_product, $req_qty);
                    if (@$validate['code'] != 200) {
                        return $validate;
                    }
                    $product_id = $this->quote_services->processProduct($data_product, \StatusConst::NO_VALIDATE);
                    $process = $this->quote_services->processSupply($product_id, $data_product);
                    if ($process) {
                        $product_data = Product::find($product_id);
                        $arr_update = getTotalProductByArr([$product_data]);
                        $arr_update['code'] = 'DH-'.formatCodeInsert($product_id);
                        $arr_update['status'] = Order::DESIGN_SUBMITED;
                        $arr_update['order_created'] = 1;
                        foreach (Product::FEILD_FILE as $key => $file) {
                            if ($key != 'handle_shape_file') {
                                $arr_update[$key] = $product_obj->{$key};
                            }
                        }
                        Product::where('id', $product_id)->update($arr_update);

                        //Đánh dấu sản phẩm này đã từng được sản xuất lại
                        $product_obj->save();

                        //update trạng thái lệnh yêu cầu sx lại đã đc xử lí
                        $obj->status = \StatusConst::SUBMITED;
                        $obj->rework_status = Product::REWORKING;
                        $status = $obj->save();
                        if ($status) {
                            return returnMessageAjax(200, 'Đã gửi yêu cầu sản xuất lại sản phẩm '.$data_product['name'], \StatusConst::CLOSE_POPUP);
                        }else{
                            return returnMessageAjax(100, 'Có lỗi xảy ra, vui lòng thử lại !', \StatusConst::CLOSE_POPUP);
                        }
                    }else{
                        return returnMessageAjax(100, 'Đã có lỗi xảy ra, vui lòng thử lại !');
                    }
                }
            }else{
                return customReturnMessage(false, $is_post, ['message' => 'Bạn không có quyền thực hiện thao tác này !']);    
            }
        }
        
        public function joinPrintCommand(Request $request)
        {
            $is_post = $request->isMethod('POST');
            if (!\GroupUser::isTechApply() && !\GroupUser::isAdmin() && !\GroupUser::isTechHandle()) {
                return customReturnMessage(false, $is_post, ['message' => 'Bạn không có quyền tạo lệnh in ghép !']);
            }
            if ($is_post) {
                $join_paper = $request->input('join_paper');
                $papers = $request->input('paper');
                if (empty($papers)) {
                    return returnMessageAjax(100, 'Bạn chưa chọn lệnh ghép nào !');
                }

                if (empty($join_paper['name'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập tên cho lệnh in ghép !');
                }
                
                if (empty($join_paper['supp_qty'])) {
                    return returnMessageAjax(100, 'Số lượng tạo lệnh in ghép không hợp lệ !');
                }

                if (empty($join_paper['size']['materal'])) {
                    return returnMessageAjax(100, 'Bạn chưa chọn chất liệu giấy !');
                }

                if (empty($join_paper['size']['qttv'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập định lượng giấy !');
                }

                if (empty($join_paper['size']['length']) || empty($join_paper['size']['width'])) {
                    return returnMessageAjax(100, 'Kích thước khổ giấy không hợp lệ !');
                }
                $join_paper['qty'] = 0;
                $join_paper['base_supp_qty'] = $join_paper['supp_qty'];
                $join_paper['nqty'] = 1;
                $join_paper['handle_type'] = \TDConst::MADE_BY_OWN;
                $insert_product['name'] = $join_paper['name']; 
                $insert_product['qty'] = $join_paper['supp_qty']; 
                $insert_product['made_by'] = \TDConst::MADE_BY_OWN;
                $insert_product['category'] = 7;
                $insert_product['design'] = 4;
                (new \BaseService)->configBaseDataAction($insert_product);
                $product_id = Product::insertGetId($insert_product);
                $type_key = \TDConst::PAPER;
                $data[$type_key][] = $join_paper;
                $parent_id = (new Paper())->processData(0, $data, $type_key);
                $code = 'G-'.sprintf("%08s", $parent_id);
                $arr_update = ['status' => Order::TECH_SUBMITED, 'code' => $code, 'is_join' => 1, 'parent' => 0, 'product' => $product_id];
                $update = Paper::where('id', $parent_id)->update($arr_update);  
                foreach ($papers as $paper_id) {
                    Paper::where('id', $paper_id)->update(['parent' => $parent_id, 'status' => Order::TECH_SUBMITED]);
                }
                $paper_obj = Paper::find($parent_id);
                Product::where('id', $product_id)->update(['code' => 'G-'.sprintf("%08s", $product_id), 'total_cost' => $paper_obj->total_cost, 'total_amount' => $paper_obj->total_cost, 'status' => Order::TECH_SUBMITED, 'order_created' => 1]);
                if ($update) {
                    return returnMessageAjax(200, 'Đã tạo lệnh in ghép thành công, Mã lệnh: '.$code.'Tên lệnh: '.$join_paper['name'], \StatusConst::RELOAD);
                }
            }else{
                $data['title'] = 'Tạo lệnh in ghép';
                $paper_join = Paper::where(['handle_type' => \TDConst::JOIN_HANDLE, 'status' => Order::WAITING_JOIN])->get();
                $options = [];
                foreach ($paper_join as $paper) {
                    $options[$paper->id] = $paper->code.' - '.$paper->name;
                }
                $data['arr_fields'] = [
                    [
                        'name' => 'paper[]',
                        'type' => 'select',
                        'note' => 'Danh sách lệnh ghép cần bình',
                        'attr' => ['required' => 1],
                        'other_data' => [
                            'config' => ['search' => 1, 'multiple' => 1], 
                            'data' => [
                                'options' => $options
                            ]
                        ]
                    ],
                    [
                        'name' => 'join_paper[name]',
                        'type' =>'text',
                        'note' => 'Tên lệnh',
                        'attr' => ['required' => 1],
                    ],
                    [
                        'name' => 'join_paper[supp_qty]',
                        'note' => 'Số lượng tờ in',
                        'attr' => ['type_input' => 'number', 'required' => 1]
                    ],
                    [
                        'name' => 'join_paper[size][materal]',
                        'type' => 'linking',
                        'note' => 'Chọn chất liệu giấy',
                        'attr' => ['required' => 1],
                        'other_data' => ['data' => ['table' => 'materals','where' => ['type' => \TDConst::PAPER]]]
                    ],
                    [
                        'name' => 'join_paper[size][qttv]',
                        'note' => 'Định lượng',
                        'attr' => ['type_input' => 'number', 'required' => 1]
                    ],
                    [
                        'name' => 'join_paper[note]',
                        'note' => 'Ghi chú',
                        'type' => 'textarea',
                        'attr' => ['type_input' => 'number', 'required' => 1]
                    ],
                ];
                return view('orders.commands.join_prints.view', $data);
            }
        }

        public function listPrintJoined(Request $request)
        {
            if (!\GroupUser::isTechApply() && !\GroupUser::isAdmin() && !\GroupUser::isTechHandle()) {
                return back()->with('error', 'Bạn không có quyền xem lệnh in ghép đã bình !');
            }
            $table = 'papers';
            $data = $this->admins->getDataBaseView($table, 'Danh sách');
            $this->admins->handleFieldView($data, $table);
            $data['title'] = 'Danh sách lệnh in đã bình';
            $data['data_tables'] = Paper::where(['is_join' => 1, 'parent' => 0, 'status' => Order::TECH_SUBMITED])->paginate(10);
            return view('orders.commands.join_prints.table', $data);
        }

        public function afterPrintKcs(Request $request, $id)
        {
            $is_post = $request->isMethod('POST');
            if (!\GroupUser::isKCS() && !\GroupUser::isAdmin()) {
                return customReturnMessage(false, $is_post, 'Bạn không có quyền thực hiện tao tác KCS sau in !');    
            }
            $obj = AfterPrint::find($id);
            if (@$obj->status != \StatusConst::PROCESSING) {
                return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
            }
            $obj_salary = \DB::table('w_salaries')->where('id', $obj->w_salary);
            $data_salary = $obj_salary->find($obj->w_salary);
            if (empty($data_salary)) {
                return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
            }
            $table_supply = $data_salary->table_supply;
            $data_supply = getModelByTable($table_supply)::find($data_salary->supply);
            if (empty($data_supply)) {
                return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
            }
            if (!$is_post) {
                $data['title'] = 'KCS sau in lệnh '.$obj->code;
                $data['dataItem'] = $obj;
                $data['fields'] = AfterPrint::getFields($obj, $data_supply->base_supp_qty);
                return view('after_prints.view', $data);
            }else{
                if (empty($request->qty) || empty($request->demo_qty)) {
                    return returnMessageAjax(100, 'Vui lòng nhập đầy đủ thông tin KCS tờ in !');
                }
                $qty = (int) $request->qty;
                $demo_qty = (int) $request->demo_qty;
                $obj_qty  = $obj->qty;
                if ($qty > $obj_qty) {
                    return returnMessageAjax(100, 'Số lượng đạt yêu cầu bạn nhập không hợp lệ !');
                }
                
                if (@$data_salary->status != \StatusConst::CHECKING) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ!');
                }
                $worker = WUser::find($obj->worker);
                if (empty($worker)) {
                    return returnMessageAjax(100, 'Dữ liệu công nhân không tồn tại hoặc đã bị xóa !');
                }
                $type = $worker['type'];
                $data_handle = !empty($data_supply->{$type}) ? json_decode($data_supply->{$type}, true) : [];
                $confirm = (new \App\Modules\Worker\Services\WorkerService)
                ->checkInWorkerSalary($data_salary, $type, $qty, $data_supply, $data_handle, $worker, $obj_salary, $table_supply, $demo_qty);
                if ($confirm) {
                    $bad_qty = $obj_qty - $qty;
                    if ($bad_qty > 0) {
                        $data_rework['name'] = $data_salary->name;
                        $data_rework['product'] = $data_salary->product;
                        $data_rework['type'] = $type;
                        $data_rework['worker'] = $worker['id'];
                        $data_rework['qty'] = $bad_qty; 
                        CRework::insertData($data_rework);
                    }
                    $data_handle['print_confirmed'] = (int) @$data_handle['print_confirmed'];
                    $data_handle['print_confirmed'] += $qty;
                    $data_supply->print = json_encode($data_handle);
                    $data_supply->save();
                    $obj_salary->update(['bad_qty' => $bad_qty, 'status' => \StatusConst::SUBMITED]);
                    $obj->status = \StatusConst::SUBMITED;
                    $obj->save();
                    return returnMessageAjax(200, "Đã xử lý KCS lệnh in ".$data_salary->name." thành công cho công nhân ". $worker['name'], \StatusConst::CLOSE_POPUP);
                }else{
                    return returnMessageAjax(100, "Đã có lỗi xảy ra, vui lòng thử lại !");
                } 
            }
        }

        public function listProductWaehouse(Request $request, $id){
            if (!$request->isMethod('GET')) {
                return redirect('')->with('error', 'Yêu cầu không hợp lệ !');
            }
            $obj = COrder::find($id);
            $data['list_data'] = !empty($obj->object) ? json_decode($obj->object) : [];
            if (empty($data['list_data'])) {
                return redirect('')->with('error', 'Không có thông tin thành phẩm cho loại phiếu này !');
            }
            $data['dataItem'] = $obj;
            $data['nosidebar'] = true;
            $data['title'] = 'Danh sách thành phẩm - Chứng từ mua hàng mã: '.@$obj->code;
            return view('c_orders.list_product', $data);
        }
    }
?>