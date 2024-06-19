<?php
namespace App\Http\Controllers\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Constants\TDConstant;
use App\Models\Product;
use \App\Models\Customer;
use App\Models\Represent;

class QuoteController extends Controller
{
    private $services;
    public function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\QuoteService;
    }

    static $copy = false;

    public function index()
    {
        return redirect('/');
    }

    public function insert($request){
        return $this->createQuote($request);
    }

    public function update($request, $id)
    {
        $step = $request->input('step') ?? 'chose_customer';
        $quote = Quote::find($id);
        if (!empty($quote)) {
            $represent = Represent::find($quote->represent);
            $is_post = $request->isMethod('POST');
            if (empty($represent)) {
                return customReturnMessage(false, $is_post, ['message' => 'Người liên hệ không tồn tại hoặc đã bị xóa !']);
            }
            $customer = Customer::find($represent->customer);
            if (empty($customer)) {
                return customReturnMessage(false, $is_post, ['message' => 'Coong ty không tồn tại hoặc đã bị xóa !']);
            }
            if($is_post){
                if ($step == 'chose_customer') {
                    return $this->services->selectCustomerUpdateQuote($request, $id);
                }else{
                    if (@$quote->status != \StatusConst::NOT_ACCEPTED) {
                        return returnMessageAjax(100, 'Không thể chỉnh sửa báo giá đã được khách duyệt giá !');
                    }
                    $dataItem = $quote->replicate();
                    $process = $this->services->processDataQuote($request, $quote);
                    if (!empty($process['code']) && $process['code'] == 100) {
                        return $process;
                    }
                    logActionUserData('update', 'quotes', $id, $dataItem);
                    return returnMessageAjax(200, 'Cập nhật dữ liệu thành công !', url('/profit-config-quote?quote_id='.$quote['id']));
                }
            }else{
                if ($step == 'chose_customer') {
                    $data['represent'] = $represent;
                    $data['represents'] = Represent::where('customer', $customer->id)->get();
                    $data['customer_fields'] = Customer::FIELD_UPDATE;
                    $data['customer'] = $customer;
                    $data['represent_fields'] = Represent::FIELD_UPDATE;
                    $data['dataItem'] = $quote;
                    $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách báo giá'];
                }else{
                    $data['represent'] = $represent;
                    $data['customer'] = $customer;
                    $data['dataItem'] = $quote;
                    $products = Product::where(['act' => 1, 'quote_id' => $id])->get();
                    $data['products'] = $products;
                    $data['product_qty'] = count($data['products']);
                    $data['parent_url'] = ['link' => 'update/quotes/'.$id, 'note' => 'Chọn khách hàng khác'];
                }
                $data['title'] = 'Chỉnh sửa báo giá - '.$quote->seri.' - '.getStepCreateQuote($step);
                $data['link_action'] = url('update/quotes/'.$id.'?step='.$step);
                return view('quotes.'.$step, $data);
            }
        }else{
            return redirect(url('/'))->with('error', 'Dữ liệu báo giá không tồn tại !');
        } 
    }

    public function clone($request, $id)
    {
        if (!$request->isMethod('GET')) {
            return back()->with('error', 'Yêu cầu không hợp lệ !');
        }
        $hidden_clone_field = Quote::HIDDEN_CLONE_FIELD;
        $data_quote = Quote::find($id)->makeHidden($hidden_clone_field)->toArray();
        $data_products = Product::where('quote_id', $id)->get()->makeHidden($hidden_clone_field)->toArray();
        unset($data_quote['id']);
        $this->services->configBaseDataAction($data_quote);
        $data_quote['status'] = \StatusConst::NOT_ACCEPTED;
        $quote_id = Quote::insertGetId($data_quote);
        Quote::where('id', $quote_id)->update(['seri' => 'BG-'.sprintf("%08s", $quote_id)]);
        //log insert quote
        $log_quote_id = logActionUserData('insert', 'quotes', $quote_id, $data_quote);
        $child_tables = Product::$childTable;
        if ($quote_id) {
            foreach ($data_products as $product) {
                $product['quote_id'] = $quote_id;
                $old_product_id = $product['id'];
                unset($product['id'], $product['code'], $product['status'], $product['order'], $product['order_created']);
                $this->services->configBaseDataAction($product);
                $product_id = Product::insertGetId($product);
                $childs = Product::where('parent', $old_product_id)->get()->makeHidden($hidden_clone_field)->toArray();
                foreach ($childs as $child) {
                    $child['parent'] = $product_id;
                    unset($child['id'], $child['code'], $child['status'], $child['order'], $child['order_created']);
                    $this->services->configBaseDataAction($child);
                    Product::insertGetId($child);
                }
                //log insert product
                $log_product_id = logActionUserData('insert', 'products', $product_id, $product, $log_quote_id);
                if ($product_id) {
                    foreach ($child_tables as $table) {
                        $model = getModelByTable($table);
                        $data_supplies = $model->where('product', $old_product_id)->get()->makeHidden($hidden_clone_field)->toArray();
                        foreach ($data_supplies as $supply) {
                            unset($supply['id'], $supply['code'], $supply['status']);
                            $this->services->configBaseDataAction($supply);
                            $supply['product'] = $product_id;
                            $supp_id = $model::insertGetId($supply);
                            $this->services->resetHandledQty($table, $model, $supp_id);
                            logActionUserData('insert', $table, $supp_id, $supply, $log_product_id);
                        }
                    }
                }
            }
            return redirect('update/quotes/'.$quote_id)->with('message', 'Sao chép báo giá thành công !');
        }else{
            return back()->with('error', 'Đã xảy ra lỗi khi thực hiện sao chép !');
        }

    }

    public function createQuote(Request $request)
    {
        $step = $request->input('step') ?? 'chose_customer';
        if ($step == 'chose_customer') {
            if (!$request->isMethod('POST')) {
                $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách báo giá'];
                $data['title'] = 'Tạo mới báo giá - ' .getStepCreateQuote($step);
                return view('quotes.'.$step, $data);
            }else{
                return $this->services->selectCustomerUpdateQuote($request);
            }
        }else{
            $represent = Represent::find($request->input('represent'));
            if (empty($represent)) {
                return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Người liên hệ không tồn tại hoặc đã bị xóa !']);
            }
            $customer = Customer::find($represent->customer);
            if (empty($customer)) {
                return customReturnMessage(false, $request->isMethod('POST'), ['message' => 'Khách hàng không tồn tại hoặc đã bị xóa !']);
            }
            if (!$request->isMethod('POST')) {
                $data['title'] = 'Tạo mới báo giá - Chi tiết sản phẩm và sản xuất';
                $data['represent'] = $represent;
                $data['customer'] = $customer;
                return view('quotes.'.$step, $data);
            }else{
                $products = $request->input('product');
                if (empty($products)) {
                    return returnMessageAjax(100, 'Bạn chưa có dữ liệu sản phẩm !');
                }
                foreach ($products as $key => $product) {
                    $valid = $this->services->productValidate($product, $key, TDConstant::QUOTE_FLOW);
                    if (!empty($valid['code']) && $valid['code'] == 100) {
                        return $valid;
                    }
                }
                $data['represent'] = $represent->id;
                $data['name'] = $customer->name;
                $data['status'] = \StatusConst::NOT_ACCEPTED;
                (new \BaseService)->configBaseDataAction($data);
                $insert_id = Quote::insertGetId($data);
                $arr_quote = Quote::find($insert_id);
                $process = $this->services->processDataQuote($request, $arr_quote);
                if ($insert_id) {
                    logActionUserData('insert', 'quotes', $insert_id);
                }
                if ($process) {
                    return returnMessageAjax(200, 'Cập nhật dữ liệu thành công !', url('/profit-config-quote?quote_id='.$arr_quote['id']));
                }
            }   
        }
    }


    public function getViewCustomerData(Request $request)
    {
        $id = (int) $request->input('id');
        if (empty($id)) {
            echo '';
        }
        if ($request->input('type') == 'represent') {
            $represent = Represent::find($id);
            if (empty($represent)) {
                return returnMessageAjax(100, 'Người liên hệ không tồn tại hoặc đã bị xóa !');
            }
            $sales = json_decode($represent->sale);
            $current_sale_id = \User::getCurrent('id');
            if ((!empty($sales) && in_array($current_sale_id, $sales)) || $current_sale_id == $represent->created_by || \GroupUser::isAdmin()) {
                $data['represent_fields'] = Represent::FIELD_UPDATE;
                $data['represent'] = $represent;
                return view('quotes.represent_info', $data);    
            }else{
                return returnMessageAjax(100, 'Người liên hệ này không phải do bạn phụ trách, vui lòng liên hệ Admin !');
            }
        }else{
            $data = $this->services->getCustomerSelectDataView($id);
            return view('quotes.customer_info', $data);
        }
    }

    public function getViewProductQuantity(Request $request)
    {
        $quantity = (int) $request->input('quantity');
        if (empty($quantity) || $quantity > 10) {
            return returnMessageAjax(100, 'Số lượng sản phẩm không hợp lệ!');
        }
        $data['products'] = [];
        for ($i=0; $i < $quantity ; $i++) {
            $num = $i + 1; 
            $data['products'][$i] = ['name' => 'Sản phẩm '.$num];
        }
        return view('quotes.products.ajax_view', $data);
    }

    public function addSupplyQuote(Request $request)
    {
        $data['pro_index'] = (int) $request->input('pro_index');
        $data['supp_index'] = (int) $request->input('supp_index');
        $data['supp_name'] = $request->input('supp_name');
        $data['pro_qty'] = $request->input('pro_qty');
        $view_key = $request->input('supp_view');
        return view('quotes.products.'.$view_key.'.ajax_view', $data);
    }

    public function addFillFinishQuote(Request $request)
    {
        $pro_index = (int) $request->input('pro_index');
        $findex = (int) $request->input('ff_index');
        $view = $request->input('view');
        return view('quotes.products.fill_finishes.'.$view, ['pro_index' => $pro_index, 'findex' => $findex]);   
    }

    public function computePaperSize(Request $request)
    {
        $product = collect($request->input('product'))->first();
        $paper = collect($product['paper'])->first();
        $this->services->getPaperSizeAjax($paper['pro_size']);
        $pro_index = (int) $request->input('proindex');
        $paper_index = (int) $request->input('paperindex');
        $paper_name = $request->input('paper_name');
        return view('quotes.products.papers.ajax_view', 
        ['j' => $pro_index, 'pindex' => $paper_index, 'paper_name' => $paper_name, 'pro_size' => $paper['pro_size']]);
    }

    public function getViewProductStructure(Request $request)
    {
        $cate = $request->input('category');
        if (!empty($cate)) {
            $data['pro_index'] = (int) $request->input('proindex');
            $arr['name'] = !empty($request->input('paper_name')) ? $request->input('paper_name') : 'Sản phẩm '. $data['pro_index'] + 1;
            $arr['product_qty'] = (int) $request->input('pro_qty');
            $data['cate'] = $cate;
            $data['elements'] = isHardBox($cate) ? TDConstant::HARD_ELEMENT : TDConstant::PAPER_ELEMENT;
            foreach ($data['elements'] as $key => $item) {
                $data['elements'][$key]['data'] = [(object) $arr];
            }
            return view('quotes.products.structure', $data);
        }
    }

    public function getViewProductStructureData(Request $request)
    {
        $id = (int) $request->input('id');
        $data['cate'] = (int) $request->input('category');
        if (!empty($id) && !empty($data['cate'])) {
            $data['pro_index'] = (int) $request->input('proindex');
            $data['product'] = Product::find($id);
            $data['elements'] = getProductElementData($data['cate'], $id);
            return view('quotes.products.structure', $data);
        }

    }

    public function profitConfigQuote(Request $request)
    {
        $id = $request->input('quote_id');
        $is_post = $request->isMethod('POST');
        if (empty($id)) {
            return customReturnMessage(false, $is_post, ['message' => 'Không tìm thấy thông tin báo giá !']);
        }
        $arr_quote = Quote::find($id);
        if (empty($arr_quote)) {
            return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu báo giá không tồn tại hoặc đã bị xóa !']);
        }
        if (\GroupUser::isAdmin() || (\GroupUser::isSale() && \User::getCurrent('id') == $arr_quote->created_by)) {
            if (!$is_post) {
                $data['data_quote'] = $arr_quote;
                $data['title'] = 'Lợi nhuận báo giá mã - '.@$data['data_quote']['seri'];
                $data['products'] = Product::where(['act' => 1, 'quote_id' => $id])->get();
                $data['supply_fields'] = TDConstant::HARD_ELEMENT;
                return view('quotes.profits.view', $data);
            }else{
                $arr_quote = Quote::find($id);
                $ship_price = $request->input('ship_price');
                $profit = $request->input('profit');
                if ($ship_price == '') {
                    return returnMessageAjax(100, 'Vui lòng nhập phí vận chuyển !');
                }
                if ($profit == '') {
                    return returnMessageAjax(100, 'Vui lòng nhập lợi nhuận báo giá !');
                }
                $data_update = ['ship_price' => $ship_price, 'profit' => $profit];
                $arr_quote->ship_price = $ship_price;
                $arr_quote->profit = $profit;
                $arr_quote->save();
                Product::where('quote_id', $id)->update($data_update);
                RefreshQuotePrice($arr_quote);
                return returnMessageAjax(200, 'Cập nhật lợi nhuận báo giá thành công !', url('quote-file-export/'.$id));
            }   
        }else{
            return customReturnMessage(false, $is_post, ['message' => 'Bạn không có quyền cấu hình lợi nhuận cho báo giá này !']);
        }
        
    }

    public function quoteFileExport(Request $request, $id)
    {
        $arr_quote = Quote::find($id);
        if (empty($arr_quote)) {
            return redirect(url(''))->with('error', 'Không tìm thấy dữ liệu báo giá !');
        }
        $represent = Represent::find($arr_quote->represent);
        $data_customer = Customer::find($represent->customer);
        $data_products = Product::where(['act' => 1, 'quote_id' => $id])->get();
        if (empty($data_products)) {
            return redirect(url(''))->with('error', 'Không tìm thấy sản phẩm nào trong báo giá !');
        }
        $step = $request->input('step') ?? 'review';
        if ($step == 'review') {
            $data['title'] = 'Quản lí file báo giá - '. $arr_quote['seri'];
            $data['data_quote'] = $arr_quote;
            $data['data_represent'] = $represent;
            $data['data_customer'] = $data_customer;
            $data['data_products'] = $data_products;
            return view('quotes.files.view', $data);
        }else{
            return $this->services->export($arr_quote, $data_customer, $represent, $data_products);   
        }
    }
    
    public function sendQuote(Request $request, $id)
    {
        $arr_quote = Quote::find($id);
        if (empty($arr_quote)) {
            return redirect(url(''))->with('error', 'Không tìm thấy dữ liệu báo giá !');
        }
    }

    public function applyQuote($id)
    {
        $quote = Quote::find($id);
        if (empty($quote)) {
            return back()->with('error', 'Dữ liệu không hợp lệ !');
        }
        if (\GroupUser::isAdmin() || (\GroupUser::isSale() && $quote->created_by == \User::getCurrent('id'))) {
            if (@$quote->status != \StatusConst::NOT_ACCEPTED) {
                return back()->with('error', 'Dữ liệu không hợp lệ !');
            }
            $quote->status = \StatusConst::ACCEPTED;
            $update = $quote->save();
            if ($update) {
                logActionUserData('apply', 'papers', $id, $quote);  
                return back()->with('message', 'Báo giá đã được duyệt và sẵn sàng tạo đơn !');
            }
        }else{
            return back()->with('error', 'Bạn không có quyền duyệt báo giá !');
        }
    }

    public function getAfterPrintView(Request $request)
    {
        $name = $request->input('name');
        $data = $request->all();
        $paper_ext = \DB::table('paper_extends')->where('name', $name)->get('category')->first();
        $data['cate'] = @$paper_ext->category;
        return view('quotes.products.papers.after_print', $data);
    }

    public function getDeviceByType(Request $request)
    {
        $type = $request->input('param');
        $arr = getDeviceByKeyType($type);
        $html = '<option value="">Danh sách chọn</option>';
        foreach ($arr as $value => $note) {
            $html .= '<option value="'.$value.'">'.$note.'</option>';
        }
        echo $html;
    }

    public function suggestProductSubmitedBySize(Request $request)
    {
        $arr_where['status'] = \StatusConst::SUBMITED;
        $arr_where['category'] = !empty($request->input('category')) ? $request->input('category') : '';
        $arr_where['length'] = !empty($request->input('length')) ? $request->input('length') : 0;
        $arr_where['width'] = !empty($request->input('width')) ? $request->input('width') : 0;
        $arr_where['height'] = !empty($request->input('height')) ? $request->input('height') : 0;
        $obj = \DB::table('products')->where($arr_where);
        $style = @$request->input('style');
        if ($style != '') {
            $obj->where('product_style', $style);
        }
        return view('quotes.products.suggest_product_submited', ['list_data' => $obj->get()->take(5)]);
    }
    
    public function getViewMadeByProduct(Request $request)
    {
        $made_by = (int) $request->input('made_by');
        $data['pro_index'] = $request->input('pro_index');
        $data['supp_index'] = $request->input('supp_index');
        $data['rework'] = $request->input('rework');
        if ($made_by == \TDConst::JOIN_HANDLE) {
            return view('quotes.products.papers.handle_types.join_handle', $data);
        }
        if ($made_by == \TDConst::MADE_BY_PARTNER) {
            return view('quotes.products.papers.handle_types.made_by_partner', $data);
        }else{
            return view('quotes.products.papers.handle_types.own_handle', $data); 
        }
    }
}

