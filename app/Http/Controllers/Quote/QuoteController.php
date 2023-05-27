<?php
namespace App\Http\Controllers\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Constants\TDConstant;
use App\Models\Product;
use \App\Models\Customer;
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
            if($request->isMethod('POST')){
                if ($step == 'chose_customer') {
                    return $this->services->selectCustomerUpdateQuote($request, $id);
                }else{
                    $process = $this->services->processDataQuote($request, $quote);
                    if (@$process['code'] == 100) {
                        return $process;
                    }
                    if ($process) {
                        RefreshQuotePrice($quote);
                    }
                    return returnMessageAjax(200, 'Cập nhật dữ liệu thành công !', url('/profit-config-quote?quote_id='.$quote['id']));
                }
            }else{
                if ($step == 'chose_customer') {
                    $data = $this->services->getCustomerSelectDataView($quote['customer_id']);
                }else{
                    $data['data_quote'] = $quote;
                    $data['products'] = Product::where(['act' => 1, 'quote_id' => $id])->get();
                    $data['product_qty'] = count($data['products']);
                }
                $data['title'] = 'Chỉnh sửa báo giá - '.$quote['seri'].' - '.getStepCreateQuote($step);
                $data['link_action'] = url('update/quotes/'.$id.'?step='.$step);
                return view('quotes.'.$step, $data);
            }
            
        }else{
            return redirect(url('/'))->with('error', 'Dữ liệu báo giá không tồn tại !');
        } 
    }

    public function clone($request, $id)
    {
        $hidden_clone_field = ['created_by', 'created_at', 'updated_at'];
        $data_quote = Quote::find($id)->makeHidden($hidden_clone_field)->toArray();
        $data_products = Product::where('quote_id', $id)->get()->makeHidden($hidden_clone_field)->toArray();
        unset($data_quote['id']);
        $quote_id = Quote::insertGetId($data_quote);
        $this->services->configBaseDataAction($data_quote);
        $data_quote['seri'] = 'BG-'.getCodeInsertTable('quotes');
        $child_tables = Product::$childTable;
        if ($quote_id) {
            foreach ($data_products as $product) {
                $product['quote_id'] = $quote_id;
                $old_product_id = $product['id'];
                unset($product['id']);
                $this->services->configBaseDataAction($product);
                $product_id = Product::insertGetId($product);
                if ($product_id) {
                    foreach ($child_tables as $table) {
                        $model = getModelByTable($table);
                        $data_supplies = $model->where('product', $old_product_id)->get()->makeHidden($hidden_clone_field)->toArray();
                        foreach ($data_supplies as $supply) {
                            unset($supply['id']);
                            $this->services->configBaseDataAction($supply);
                            $supply['product'] = $product_id;
                            $model->insert($supply);
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
                $data['title'] = 'Tạo mới báo giá - ' .getStepCreateQuote($step);
                return view('quotes.'.$step, $data);
            }else{
                return $this->services->selectCustomerUpdateQuote($request);
            }
        }else{
            $arr_quote = Quote::find($request->input('id'));
            if (!$request->isMethod('POST')) {
                $data['title'] = 'Tạo mới báo giá - Chi tiết sản phẩm và sản xuất';
                $data['data_quote'] = $arr_quote;
                if (!empty($data['data_quote'])) {
                    return view('quotes.'.$step, $data);
                }else{
                    return redirect(url('/'))->with('error', 'Dữ liệu báo giá không tồn tại !');
                }
            }else{
                $process = $this->services->processDataQuote($request, $arr_quote);
                if (@$process['code'] == 100) {
                    return $process;
                }
                if ($process) {
                    RefreshQuotePrice($arr_quote);
                }
                return returnMessageAjax(200, 'Cập nhật dữ liệu thành công !', url('/profit-config-quote?quote_id='.$arr_quote['id']));
            }   
        }
    }


    public function getViewCustomerData(Request $request)
    {
        $id = (int) $request->input('id');
        $data = $this->services->getCustomerSelectDataView($id);
        return view('quotes.customer_info', $data);
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
            $arr['name'] = $request->input('paper_name');
            $arr['product_qty'] = (int) $request->input('pro_qty');
            $data['cate'] = $cate;
            $data['elements'] = isHardBox($cate) ? TDConstant::HARD_ELEMENT : TDConstant::PAPER_ELEMENT;
            foreach ($data['elements'] as $key => $item) {
                $data['elements'][$key]['data'] = [(object) $arr];
            }
            if (empty($arr['name'])) {
                return returnMessageAjax(100, 'Bạn chưa nhập tên sản phẩm!');
            }
            if (empty($arr['product_qty'])) {
                return returnMessageAjax(100, 'Bạn chưa nhập số lượng sản phẩm!');
            }
            return view('quotes.products.structure', $data);
        }
    }

    public function getViewProductStructureData(Request $request)
    {
        $id = (int) $request->input('id');
        $data['cate'] = (int) $request->input('category');
        if (!empty($id) && !empty($data['cate'])) {
            $where = ['act' => 1, 'product' => $id];
            $data['pro_index'] = (int) $request->input('proindex');
            $data['elements'] = isHardBox($data['cate']) ? TDConstant::HARD_ELEMENT : TDConstant::PAPER_ELEMENT;
            foreach ($data['elements'] as $key => $item) {
                if ($item['table'] == 'supplies') {
                    $where['type'] = $item['pro_field'];
                }
                $data['elements'][$key]['data'] = \DB::table($item['table'])->where($where)->get()->toArray();
                unset($where['type']);
            }
            return view('quotes.products.structure', $data);
        }

    }

    public function profitConfigQuote(Request $request)
    {
        $id = $request->input('quote_id');
        $arr_quote = Quote::find($id);
        if (!$request->isMethod('POST')) {
            if (empty($arr_quote)) {
                return redirect(url(''))->with('error', 'Báo giá không tồn tại !');
            }
            $data['data_quote'] = $arr_quote;
            $data['title'] = 'Lợi nhuận báo giá mã - '.@$data['data_quote']['seri'];
            $data['products'] = Product::where(['act' => 1, 'quote_id' => $id])->get();
            $data['supply_fields'] = TDConstant::HARD_ELEMENT;
            return view('quotes.profits.view', $data);
        }else{
            $data = $request->except('_token', 'quote_id');
            if (empty($id)) {
                return returnMessageAjax(100, 'Không tìm thấy thông tin báo giá !');
            }
            if ($data['ship_price'] == null) {
                return returnMessageAjax(100, 'Vui lòng nhập phí vận chuyển !');
            }
            if ($data['profit'] == null) {
                return returnMessageAjax(100, 'Vui lòng nhập lợi nhuận báo giá !');
            }
            $get_perc = (float) $arr_quote['total_cost'] + (float) $data['ship_price'];
            $data['total_amount'] = calValuePercentPlus($arr_quote['total_cost'], $get_perc,  $data['profit']);
            $update = Quote::where('id', $id)->update($data);
            if ($update) {
                return returnMessageAjax(200, 'Cập nhật lợi nhuận báo giá thành công !', url('quote-file-export/'.$id));
            }
        }
    }

    public function quoteFileExport(Request $request, $id)
    {
        $arr_quote = Quote::find($id);
        if (empty($arr_quote)) {
            return redirect(url(''))->with('error', 'Không tìm thấy dữ liệu báo giá !');
        }
        $data_customer = Customer::find($arr_quote['customer_id']);
        $data_products = Product::where(['act' => 1, 'quote_id' => $id])->get()->toArray();
        $step = $request->input('step') ?? 'review';
        if ($step == 'review') {
            $data['title'] = 'Quản lí file báo giá - '. $arr_quote['seri'];
            $data['data_quote'] = $arr_quote;
            $data['data_customer'] = $data_customer;
            $data['data_products'] = $data_products;
            return view('quotes.files.view', $data);
        }else{
            return $this->services->export($arr_quote, $data_customer, $data_products);   
        }
    }
    
    public function sendQuote(Request $request, $id)
    {
        $arr_quote = Quote::find($id);
        if (empty($arr_quote)) {
            return redirect(url(''))->with('error', 'Không tìm thấy dữ liệu báo giá !');
        }
    }
}

