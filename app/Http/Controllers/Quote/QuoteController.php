<?php
namespace App\Http\Controllers\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Quote;
use App\Constants\TDConstant;
use App\Models\Product;
class QuoteController extends Controller
{
    private $services;
    public function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\QuoteService;
    }

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
                }
            }else{
                if ($step == 'chose_customer') {
                    $data = $this->services->getCustomerSelectDataView($quote['customer_id']);
                }else{
                    $data['data_quote'] = $quote;   
                }
                $data['title'] = 'Chỉnh sửa báo giá - '.$quote['seri'].' - '.getStepCreateQuote($step);
                $data['link_update'] = url('update/quotes/'.$id.'?step='.$step);
                return view('quotes.'.$step, $data);
            }
            
        }else{
            return redirect(url('/'))->with('error', 'Dữ liệu báo giá không tồn tại !');
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
                $data = $request->except('_token', 'step');
                if (empty($data['product'])) {
                    return returnMessageAjax(110, 'Không tìm thấy sản phẩm !');
                }else{
                    $status = $this->services->processDataProduct($data, $arr_quote);
                    return $status;
                }
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
            return ['code' => 100, 'message' => 'Số lượng sản phẩm không hợp lệ!'];
        }
        return view('quotes.products.ajax_view', ['qty' => $quantity]);
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
            $data['elements'] = $cate == 1 ? TDConstant::HARD_ELEMENT : TDConstant::PAPER_ELEMENT;
            $data['pro_index'] = (int) $request->input('proindex');
            $data['supp_index'] = 0;
            $data['findex'] = 0;
            $data['supp_name'] = $request->input('paper_name');
            $data['pro_qty'] = (int) $request->input('pro_qty');
            $data['cate'] = $cate;
            if (empty($data['supp_name'])) {
                return ['code' => 100, 'message' => 'Bạn chưa nhập tên sản phẩm!'];
            }
            if (empty($data['pro_qty'])) {
                return ['code' => 100, 'message' => 'Bạn chưa nhập số lượng sản phẩm!'];
            }
            return view('quotes.products.structure', $data);
        }
    }

    public function profitConfigQuote(Request $request)
    {
        if (!$request->isMethod('POST')) {
            $id = $request->input('quote_id');
            if (empty($id)) {
                return redirect(url())->with('error', 'Báo giá không tồn tại !');
            }
            $data['data_quote'] = Quote::find($id);
            $data['title'] = 'Lợi nhuận báo giá mã - '.@$data['data_quote']['seri'];
            $data['products'] = Product::where(['act' => 1, 'quote_id' => $id])->get();
            $data['supply_fields'] = TDConstant::HARD_ELEMENT;
            return view('quotes.profits.view', $data);
        }
    }
}

