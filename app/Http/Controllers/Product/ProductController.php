<?php
    namespace App\Http\Controllers\Product;
    use App\Http\Controllers\Controller;
    use App\Models\Product;
    use App\Models\Quote;
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
                $blade_to = 'orders.users.'.\User::getCurrent('id').'.view';
                if (view()->exists($blade_to)) {
                    return view($blade_to, $data);
                }else{
                    return back()->with('error', 'Giao diện không được hỗ trợ !');
                }               
            }else{
                return back()->with('error', 'Phương thức không hợp lệ !');
            }
        }
    }
?>