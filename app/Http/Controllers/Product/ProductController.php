<?php
    namespace App\Http\Controllers\Product;
    use App\Http\Controllers\Controller;
    use App\Models\AfterPrint;
    use App\Models\CExpertise;
    use App\Models\CRework;
    use App\Models\Order;
    use App\Models\Product;
    use App\Models\Quote;
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
            (new \BaseService)->configBaseDataAction($arr_product);  
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
                $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách đơn sản phẩm'];
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
            $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách đơn sản phẩm'];
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

        public function validateSupply($data, $req_qty)
        {
            $arr[\TDConst::PAPER] = 'Giấy in';
            $arr = $arr + \TDConst::ALL_SUPPLY;
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
            if (\GroupUser::isAdmin() || \GroupUser::Sale()) {
                $obj = CRework::find($id);
                if (empty($obj) || @$obj->status != \StatusConst::NOT_ACCEPTED || @$obj->rework_status != Product::NEED_REWORK) {
                    return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
                }
                $req_qty = (int) @$obj->qty;
                if ($req_qty<= 0) {
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
                    $product_obj->name = $product_obj->name.' (Sản xuất lại do lỗi kỹ thuật)';
                    $product_obj->qty = '';
                    $product_obj->design = 4;
                    $data['product'] = $product_obj;
                    $data['data_rework'] = $obj;
                    $data['cate'] = $product_obj->category;
                    $data['elements'] = getProductElementData($data['cate'], $product_obj->id, false, false, true, true);
                    dd($data['elements']);
                    return view('kcs.reworks.view', $data);
                }else{
                    $data = $request->except('_token');
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
                        $arr_update['code'] = 'DH-'.getCodeInsertTable('products');
                        $arr_update['status'] = Order::DESIGN_SUBMITED;
                        $arr_update['order_created'] = 1;
                        $arr_update['expertise_id'] = $product_obj->expertise_id;
                        $arr_update['rework_from'] = $product_obj->id;
                        foreach (Product::FEILD_FILE as $key => $file) {
                            if ($key != 'handle_shape_file') {
                                $arr_update[$key] = $product_obj->{$key};
                            }
                        }
                        Product::where('id', $product_id)->update($arr_update);

                        //Đánh dấu sản phẩm này đã từng được sản xuất lại
                        $product_obj->rework = 1;
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
            if (!\GroupUser::isTechApply() && !\GroupUser::isAdmin()) {
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
                
                if (empty($join_paper['qty'])) {
                    return returnMessageAjax(100, 'Số lượng tạo lệnh in ghép không hợp lệ !');
                }

                if (empty($join_paper['materal'])) {
                    return returnMessageAjax(100, 'Bạn chưa chọn chất liệu giấy !');
                }

                if (empty($join_paper['qttv'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập định lượng giấy !');
                }
                
            }else{
                $data['title'] = 'Tạo lệnh in ghép';
                $paper_join = \DB::table('papers')->where(['handle_type' => \TDConst::JOIN_HANDLE, 'status' => Order::WAITING_JOIN])->get();
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
                        'name' => 'join_paper[qty]',
                        'note' => 'Số lượng tờ in',
                        'attr' => ['type_input' => 'number', 'required' => 1]
                    ],
                    [
                        'name' => 'join_paper[materal]',
                        'type' => 'linking',
                        'note' => 'Chọn chất liệu giấy',
                        'attr' => ['required' => 1],
                        'other_data' => ['data' => ['table' => 'materals','where' => ['type' => \TDConst::PAPER]]]
                    ],
                    [
                        'name' => 'join_paper[qttv]',
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

        public function afterPrintKcs(Request $request, $id)
        {
            if (\GroupUser::isKCS() || \GroupUser::isAdmin()) {
                $obj = AfterPrint::find($id);
                if (empty($obj) || @$obj->status != \StatusConst::PROCESSING) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                $qty = (int) $request->input('qty');
                $obj_qty = (int) $obj->qty;
                if ($qty > $obj_qty) {
                    return returnMessageAjax(100, 'Số lượng bạn nhập không hợp lệ !');
                }
                $obj_salary = \DB::table('w_salaries')->where('id', $obj->w_salary);
                $data_salary = $obj_salary->find($obj->w_salary);
                if (empty($obj_salary)) {
                    return returnMessageAjax(100, 'Lệnh sản xuất không tồn tại hoặc đã bị xóa');
                }
                if (@$data_salary->status != \StatusConst::CHECKING) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ!');
                }
                $table_supply = @$data_salary->table_supply;
                $supply = \DB::table($table_supply)->find(@$data_salary->supply);
                if (empty($supply)) {
                    return returnMessageAjax(100, 'Dữ liệu đơn hàng không tồn tại hoặc đã bị xóa');
                }
                $worker = WUser::find($obj->worker);
                if (empty($worker)) {
                    return returnMessageAjax(100, 'Dữ liệu công nhân không tồn tại hoặc đã bị xóa !');
                }
                $type = $worker['type'];
                $data_handle = !empty($supply->{$type}) ? json_decode($supply->{$type}, true) : [];
                $handle_qty = @$data_salary->qty ?? 0;
                $confirm = (new \App\Modules\Worker\Services\WorkerService)->checkInWorkerSalary($data_salary, $type, $qty, $supply, $data_handle, $worker, $obj_salary, $table_supply, $handle_qty);
                if ($confirm) {
                    $bad_qty = $obj_qty - $qty;
                    if ($bad_qty > 0) {
                        $rework_table = 'c_reworks';
                        $data_rework['code'] = 'RW-'.getCodeInsertTable($rework_table);
                        $data_rework['name'] = $data_salary->name;
                        $data_rework['product'] = $data_salary->product;
                        $data_rework['type'] = $type;
                        $data_rework['worker'] = $worker['id'];
                        $data_rework['qty'] = $bad_qty; 
                        $data_rework['status'] = \StatusConst::NOT_ACCEPTED;
                        $data_rework['rework_status'] = Product::NEED_REWORK;
                        (new \BaseService)->configBaseDataAction($data_rework);
                        \DB::table('c_reworks')->insert($data_rework);
                    }
                    $obj_salary->update(['qty' => $bad_qty]);
                    $obj->status = \StatusConst::SUBMITED;
                    $obj->save();
                    return returnMessageAjax(200, "Đã xử lý KCS lệnh in ".$data_salary->name." thành công cho công nhân ". $worker['name'], \StatusConst::RELOAD);
                }else{
                    return returnMessageAjax(100, "Đã có lỗi xảy ra, vui lòng thử lại !");
                } 
            }else{
                return returnMessageAjax(100, 'Bạn không có quyền thực hiện tao tác KCS sau in !');
            }
        }
    }
?>