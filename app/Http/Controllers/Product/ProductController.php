<?php
    namespace App\Http\Controllers\Product;
    use App\Http\Controllers\Controller;
    use App\Models\CExpertise;
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
                if (view()->exists('orders.users.'.\GroupUser::getCurrent().'.view')) {
                    return view('orders.users.'.\GroupUser::getCurrent().'.view', $data);
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
                $list_data = $model::where('product', $id)->get()->makeHidden(['id', 'product', 'handle_elevate'])->toArray();
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
            $data['elements'] = getProductElementData($data_product['category'], $product_id);
            return view('products.view', $data);
        }

        public function KCSTakeInRequirement(Request $request, $id)
        {
            $is_post = $request->isMethod('POST');
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
                    $data['prob_handle_option'] = ['' => 'Xử lí sản phẩm lỗi',CExpertise::NOT_REWORK => 'Kông sản xuất lại', CExpertise::PROBLEM => 'Sản xuất lại'];
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
                    $data['status'] = \StatusConst::NOT_ACCEPTED;
                    $data['code'] = 'KCS-'.getCodeInsertTable('c_expertises');
                    $data['name'] = \User::getCurrent('name').' đã thẩm định xong sảm phẩm'.' '.$product_obj->name;
                    $this->services->configBaseDataAction($data);
                    $insert = CExpertise::insertGetId($data);
                    if ($insert) {
                        $product_obj->status = $is_problem ? \StatusConst::SUBMITED : \StatusConst::LAST_SUBMITED;
                        $product_obj->out_side = $is_problem ? $outside_qty - (int) $data['qty'] : 0;
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
    }
?>