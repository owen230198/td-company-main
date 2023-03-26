<?php
namespace App\Http\Controllers\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Quote;
use App\Constants\TDConstant;
class QuoteController extends Controller
{
    private $services;
    private $admins;
    public function __construct()
    {
        parent::__construct();
        $this->admins = new \App\Services\AdminService;
        $this->services = new \App\Services\QuoteService;
    }

    public function index()
    {
        return redirect('/');
    }

    public function createQuote(Request $request)
    {
        $step = $request->input('step') ?? 'chose_customer';
        if ($step == 'chose_customer') {
            if (!$request->isMethod('POST')) {
                $data['title'] = 'Tạo mới báo giá - ' .getStepCreateQuote($step);
                return view('quotes.'.$step, $data);
            }else{
                $data_customer = $request->except('_token', 'step', 'customer_id');
                $customer_id = $request->input('customer_id');
                $quote_id = $this->services->insertCustomerQuote($customer_id, $data_customer);
                if ($quote_id) {
                    return redirect(asset('create-quote?step=handle_config&id='.$quote_id))->with('message', 'Thêm dữ liệu khách hàng thành công!');
                }else{
                    return back()->with('error', 'Đã có lỗi xảy ra !');
                }
            }
        }else{
            if (!$request->isMethod('POST')) {
                $data['title'] = 'Tạo mới báo giá - Chi tiết sản phẩm và sản xuất';
                $data['customer_fields'] = Customer::FIELD_UPDATE;
                $data['data_quote'] = Quote::find($request->input('id'));
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
                    $status = $this->services->insertDataProduct($data);
                    return $status;
                }
            }   
        }
    }

    public function getViewCustomerData(Request $request)
    {
        $id = (int) $request->input('id');
        $data_customer = Customer::find($id);
        $data['fields'] = Customer::FIELD_UPDATE;
        $data['data_customer'] = !empty($data_customer) ? $data_customer : [];
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

    public function addPrintPaperQuote(Request $request)
    {
        $pro_index = (int) $request->input('pro_index');
        $paper_index = (int) $request->input('paper_index');
        $paper_name = $request->input('paper_name');
        return view('quotes.products.papers.ajax_view', ['j' => $pro_index, 'pindex' => $paper_index, 'paper_name' => $paper_name]);
    }

    public function computePaperSize(Request $request)
    {
        $product = collect($request->input('product'))->first();
        $paper = collect($product['paper'])->first();
        $this->services->getPaperSizeAjax($paper['pro_size']);
        $pro_index = (int) $request->input('proindex');
        $paper_index = (int) $request->input('paperindex');
        $paper_name = $request->input('paper_name');
        return view('quotes.products.papers.ajax_view', ['j' => $pro_index, 'pindex' => $paper_index, 'paper_name' => $paper_name, 'pro_size' => $paper['pro_size']]);
    }

    public function getViewProductStructure(Request $request)
    {
        $cate = $request->input('category');
        if (!empty($cate)) {
            $data['elements'] = $cate == 1 ? TDConstant::HARD_ELEMENT : TDConstant::PAPER_ELEMENT;
            $data['j'] = (int) $request->input('proindex');
            $data['pindex'] = 0;
            $data['paper_name'] = $request->input('paper_name');
            return view('quotes.products.structure', $data);
        }
    }
}

