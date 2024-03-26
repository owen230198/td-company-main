<?php
    namespace App\Http\Controllers\Product;
    use App\Http\Controllers\Controller;
    use App\Models\CExpertise;
    use App\Models\Order;
    use App\Models\Product;
    use App\Models\Quote;
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
                $data['parent_url'] = ['link' => @session()->get('back_url'), 'note' => 'Danh sách đơn sản phẩm'];
                $data['title'] = 'Cập nhật & Xác nhận đơn sản phẩm - '.$product['code'];
                $data['link_action'] = url('update/products/'.$id);
                $data['id'] = $id;
                $data['stage'] = $product['status'];
                $group_user = \GroupUser::getCurrent();
                if ($group_user == \GroupUser::PLAN_HANDLE) {
                    $data['key_supply'] = !empty($request->get('key_supply')) ? $request->get('key_supply') : \TDConst::PAPER;
                    $data['elements'] = getProductElementData($product['category'], $product['id'], true, true, true);
                    session()->put('back_url', url()->full());
                }
                if (view()->exists('orders.users.'.$group_user.'.view')) {
                    return view('orders.users.'.$group_user.'.view', $data);
                }else{
                    return back()->with('error', 'Bạn không có quyền truy cập giao diện này !');
                }
            }else{
                $data = $request->except('_token');
                $arr_quote = Quote::find($product->quote_id);
                $process = $this->quote_services->processDataProduct($data, $arr_quote, \TDConst::ORDER_ACTION_FLOW);
                if (!empty($process['code']) && $process['code'] == 100) {
                    return returnMessageAjax(100, $process['message']);  
                }else{
                    return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!');       
                }
            } 
        }
        
        public function clone($request, $id)
        {
            $arr_product = Product::where('id', $id)->get(Product::CLONE_FIELD)->first()->toArray();
            $product_id = Product::insertGetId($arr_product);
            foreach (Product::$childTable as $table) {
                $model = getModelByTable($table);
                $list_data = $model::where('product', $id)->get()->makeHidden(['id', 'product', 'handle_elevate', 'status'])->toArray();
                foreach ($list_data as $data_insert) {
                    $data_insert['product'] = $product_id;
                    (new \BaseService)->configBaseDataAction($data_insert);  
                    $model::insert($data_insert);   
                }
            }
            if ($request->isMethod('GET')) {
                $data['parent_url'] = ['link' => session()->get('back_url'), 'note' => 'Danh sách đơn sản phẩm'];
                $data['order_cost'] = $arr_product['total_amount'];
                $data['products'] = Product::where('id', $product_id)->get();
                $data['product_qty'] = 1;
                $data['link_action'] = url('insert/orders');
                $data['order_type'] = \OrderConst::INCLUDE;
                $data['title'] = 'Sao chép đơn sản phẩm - '.$arr_product['name'];
                $blade_to = 'orders.users.'.\GroupUser::getCurrent().'.view';
                if (view()->exists($blade_to)) {
                    return view($blade_to, $data);
                }else{
                    return back()->with('error', 'Giao diện không được hỗ trợ !');
                }               
            }else{
                return back()->with('error', 'Phương thức không hợp lệ !');
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
            $data['parent_url'] = ['link' => @session()->get('back_url'), 'note' => 'Danh sách đơn sản phẩm'];
            $data['elements'] = getProductElementData($data_product['category'], $product_id, true, true, true);
            return view('products.view', $data);
        }

        public function KCSTakeInRequirement(Request $request, $id)
        {
            $is_post = $request->isMethod('POST');
            return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !'], \StatusConst::CLOSE_POPUP);
            if (\GroupUser::isAdmin() || \GroupUser::isKCS()) {
                $product_obj = Product::find($id);
                if (empty($product_obj) || @$product_obj->status != \StatusConst::SUBMITED) {
                    return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
                }
                $outside_qty = (int) $product_obj->outside_qty;
                if ($outside_qty <= 0) {
                    return customReturnMessage(false, $is_post, ['message' => 'Sản phẩm đã được nhập kho hết !']);
                }
                if (!$is_post) {
                    $data['title'] = 'Thẩm định sau sản xuất sản phẩm '.$product_obj->name;
                    $data['nosidebar'] = true;
                    $data['data_product'] = $product_obj;
                    $data['status_exper_option'] = [CExpertise::FULL => 'Nhập kho đủ ('.$product_obj->outside_qty.' sản phẩm)', CExpertise::PROBLEM => 'Nhập kho thiếu do lỗi kỹ thuật'];
                    $data['prob_handle_option'] = ['' => 'Xử lí sản phẩm lỗi',CExpertise::NOT_REWORK => 'Không sản xuất lại', CExpertise::REWORK => 'Sản xuất lại'];
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
                    if ($is_problem) {
                        if (empty($data['qty'])) {
                            return returnMessageAjax(100, 'Bạn chưa nhập số lượng đủ điều kiện nhập kho !');
                        }
                        if ((int) $data['qty'] >= $outside_qty) {
                            return returnMessageAjax(100, 'Số lượng nhập kho không hợp lệ !');
                        }
                        if (empty($data['handle_problem'])) {
                            return returnMessageAjax(100, 'Bạn chưa chọn giải pháp xử lí sản phẩm lỗi !');
                        }
                    }else{
                        $data['qty'] = (int) $outside_qty;
                    }
                    $data['handle_problem'] = @$data['handle_problem'] ?? CExpertise::REWORK;
                    $data['status'] = \StatusConst::NOT_ACCEPTED;
                    $data['code'] = 'KCS-'.getCodeInsertTable('c_expertises');
                    $data['name'] = \User::getCurrent('name').' đã thẩm định xong sảm phẩm'.' '.$product_obj->name;
                    $data['product'] = $id;
                    $this->services->configBaseDataAction($data);
                    $insert_id = CExpertise::insertGetId($data);
                    if ($insert_id) {
                        $is_rework = $data['handle_problem'] == CExpertise::REWORK;
                        $product_obj->status = $is_problem ? ($is_rework ? Product::NEED_REWORK : Product::WAITING_WAREHOUSE) : Product::WAITING_WAREHOUSE;
                        $product_obj->rework_status = $is_rework ? Product::NEED_REWORK : Product::NO_REWORK;
                        $product_obj->outside_qty = $is_problem ? $outside_qty - (int) $data['qty'] : 0;
                        $product_obj->expertise_id = $insert_id;
                        $product_obj->save();
                        return returnMessageAjax(200, 'Yêu cầu nhập kho sản phẩm thành công !', \StatusConst::CLOSE_POPUP);
                    }else{
                        return returnMessageAjax(100, 'Lỗi không xác định !');
                    }
                }
            }else{
                return customReturnMessage(false, $is_post, ['message' => 'Bạn không có quyền thực hiện thao tác này !']);
            }
        }

        public function validateSupply($data, $outside_qty)
        {
            $arr[\TDConst::PAPER] = 'Giấy in';
            $arr = $arr + \TDConst::ALL_SUPPLY;
            foreach ($arr as $key => $name) {
                if (!empty($data[$key])) {
                    foreach ($data[$key] as $supply) {
                        if ((int) @$supply['qty'] < $outside_qty) {
                            $supp_name = $key == \TDConst::PAPER ? $supply['name'] : $name;
                            return returnMessageAjax(100, 'Số lượng sản xuất lại cho vật tư '.$supp_name.' không hợp lệ !');
                        }
                    }
                }
            }
            if (!empty($data[\TDConst::FILL_FINISH])) {
                if ((int) @$data[\TDConst::FILL_FINISH]['qty'] <$outside_qty) {
                    return returnMessageAjax(100, 'Số lượng sản xuất lại cho khâu hoàn thiện cuối không hợp lệ !');
                }
            }
            return ['code' => 200];   
        }

        public function productRequireRework(Request $request, $id)
        {
            $is_post = $request->isMethod('POST');
            if (\GroupUser::isAdmin() || \GroupUser::isKcs()) {
                $product_obj = Product::find($id);
                $pro_outside_qty = (int) $product_obj->outside_qty;
                if (empty($product_obj) || @$product_obj->status != Product::NEED_REWORK) {
                    return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
                }
                if ($pro_outside_qty <= 0) {
                    return customReturnMessage(false, $is_post, ['message' => 'Số lượng cần sản phẩm cần sản xuất lại không hợp lệ !']);
                }
                if (!$is_post) {
                    $data['title'] = 'Yêu cầu sản xuất lại '.$pro_outside_qty.' sản phẩm '.$product_obj->name;
                    $data['parent_url'] = ['link' => session()->get('back_url'), 'note' => 'Danh sách sản phẩm cần sản xuất lại'];
                    $product_obj->name = $product_obj->name.' (Sản xuất lại do lỗi kỹ thuật)';
                    $product_obj->qty = $pro_outside_qty;
                    $product_obj->design = 4;
                    $data['product'] = $product_obj;
                    $data['cate'] = $product_obj->category;
                    $data['elements'] = getProductElementData($data['cate'], $id, false, false, true, true);
                    return view('kcs.reworks.view', $data);
                }else{
                    $data = $request->except('_token');
                    $data_product = !empty($data['product'][0]) ? $data['product'][0] : [];
                    if (empty($data_product)) {
                        return returnMessageAjax(100, 'Không tìm thấy dữ liệu sản phẩm !');
                    }
                    if ((int) $data_product['qty'] < $pro_outside_qty) {
                        return returnMessageAjax(100, 'Số lượng sản phẩm sản xuất lại không hợp lệ !');
                    }
                    $validate = $this->validateSupply($data_product, $pro_outside_qty);
                    if (@$validate['code'] != 200) {
                        return $validate;
                    }
                    $product_id = $this->quote_services->processProduct($data_product, \StatusConst::NO_VALIDATE);
                    $process = $this->quote_services->processSupply($product_id, $data_product);
                    if ($process) {
                        $product_data = Product::find($product_id);
                        $arr_update = getTotalProductByArr([$product_data]);
                        $arr_update['code'] = 'DH-'.getCodeInsertTable('products');
                        $arr_update['status'] = Order::TECH_SUBMITED;
                        $arr_update['order_created'] = 1;
                        $arr_update['expertise_id'] = $product_obj->expertise_id;
                        Product::where('id', $product_id)->update($arr_update);
                        Product::where('id', $id)->update(['status'=> Product::WAITING_WAREHOUSE, 'rework_status' => Product::REWORKED]);
                        return returnMessageAjax(200, 'Đã gửi yêu cầu sản xuất lại sản phẩm '.$data_product['name'], getBackUrl());
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
            $data['title'] = 'Tạo lệnh in ghép';
            $data['arr_fields'] = [
                [
                    'name' => 'paper[]',
                    'type' => 'linking',
                    'note' => 'Chọn giấy in ghép',
                    'attr' => ['required' => 1],
                    'other_data' => [
                        'config' => ['search' => 1, 'multiple' => 1], 
                        'data' => [
                            'table' => 'papers', 
                            'where' => ['handle_type' => \TDConst::JOIN_HANDLE, 'status' => null]
                        ]
                    ]
                ],
                [
                    'name' => 'name',
                    'type' =>'text',
                    'note' => 'Tên lệnh',
                    'attr' => ['required' => 1],
                ],
                [
                    'name' => 'qty',
                    'note' => 'Số lượng tờ in',
                    'attr' => ['type_input' => 'number', 'required' => 1]
                ],
                [
                    'name' => 'materal',
                    'type' => 'linking',
                    'note' => 'Chọn chất liệu giấy',
                    'attr' => ['required' => 1],
                    'other_data' => ['data' => ['table' => 'materals','where' => ['type' => \TDConst::PAPER]]]
                ],
                [
                    'name' => 'qttv',
                    'note' => 'Định lượng',
                    'attr' => ['type_input' => 'number', 'required' => 1]
                ],
                [
                    'name' => 'note',
                    'note' => 'Ghi chú',
                    'type' => 'textarea',
                    'attr' => ['type_input' => 'number', 'required' => 1]
                ],
            ];
            return view('orders.commands.join_prints.view', $data);
        }

        public function afterPrintKcs(Request $request, $id)
        {
            return returnMessageAjax(100, "DMM");
        }
    }
?>