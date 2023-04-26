<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Customer;
use App\Models\Quote;
use App\Models\Product;
use App\Services\QTraits\QuoteTrait;
use App\Services\QTraits\QPaperTrait;
use App\Services\QTraits\QSupplyTrait;
use App\Constants\StatusConstant;
use App\Constants\TDConstant;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

class QuoteService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}
    use QuoteTrait, QPaperTrait, QSupplyTrait;

    public function dataActionCustomer($customer_id, $data_customer)
    {
        $this->configBaseDataAction($data_customer);
        $data_quote = $data_customer;
        if (empty($customer_id)) {
            $data_customer['code'] = Customer::getInsertCode();
            $data_customer['status'] = 0;
            $customer_id = Customer::insertGetId($data_customer);
        }
        $data_quote['seri'] = 'BG-'.getCodeInsertTable('quotes');
        $data_quote['customer_id'] = $customer_id;
        $data_quote['company_name'] = $data_customer['name'];
        return $data_quote;
    }

    public function getPaperSizeAjax(&$data){
        $data['size_length'] = (($data['length'] + $data['width']) * 2 + $data['edge']) * $data['nqty_length'];
        if ($data['nqty_height'] > 1 && $data['nqty_height'] < 7) {
            $data['size_height']  = $data['height'] + 0 + $data['lid'] + $data['nqty_space']; 
        }else{
            $data['size_height'] = ($data['height'] + 0 + $data['lid'] + $data['bottom']);
        }
        $temp_length = $data['size_length'] + 10;
        $temp_height = $data['size_height'] + 10;
        if ($temp_length < $temp_height) {
            $temp_length = $temp_length + $data['min_paper_size'];
        }else{
            $temp_height = $temp_height + $data['min_paper_size']; 
        }
        $data['temp_length'] = $temp_length / 10;
        $data['temp_height'] = $temp_height / 10;
        $data['optimal_length'] = $temp_length / 1000;
        $data['optimal_width'] = $temp_height / 1000;
    }

    private function productValidate($data_product){
        $valid = true;
        $arr = returnMessageAjax(200, 'Cập nhật dữ liệu thành công !');
        foreach ($data_product as $key => $data) {
            $num = $key + 1;
            if (empty($data['name'])) {
                $valid = false;
                $arr = returnMessageAjax(110, 'Bạn chưa nhập tên cho sản phẩm '. $num);
                return ['valid' => $valid, 'arr' => $arr];
            }else{
                if (empty($data['category'])) {
                    $valid = false;
                    $arr = returnMessageAjax(110, 'Bạn chưa chọn nhóm sản phẩm cho '. $data['name']);
                    return ['valid' => $valid, 'arr' => $arr];
                }
        
                if (empty($data['design'])) {
                    $valid = false;
                    $arr = returnMessageAjax(110, 'Bạn chưa chọn mẫu thiết kế cho '. $data['name']);
                    return ['valid' => $valid, 'arr' => $arr];
                }
            }
        }
        return ['valid' => $valid, 'arr' => $arr];
    }

    public function getDataActionProduct($data){
        $data_action['name'] = $data['name'];
        $data_action['qty'] = $data['qty'];
        $data_action['category'] = $data['category'];
        $data_action['design'] = $data['design'];
        $data_action['size'] = $data['size'];
        $data_action['quote_id'] = $data['quote_id'];
        $this->configBaseDataAction($data_action);
        return $data_action;
    }

    public function processProduct($data)
    {
        $data_process = $this->getDataActionProduct($data);
        if (!empty($data['id'])) {
            Product::where('id', $data['id'])->update($data_process);
            return $data['id'];
        }else{
            return Product::insertGetId($data_process);
        }
    }

    public function processDataProduct($data, $arr_quote)
    {
        $data_product = $data['product'];
        $product_valid = $this->productValidate($data_product);
        if (@$product_valid['valid'] == false) {
           return $product_valid['arr'];
        }
        foreach ($data_product as $product) {
            $product['quote_id'] = $arr_quote['id'];
            $product_id = $this->processProduct($product);
            $elements = TDConstant::HARD_ELEMENT;
            foreach ($elements as $el) {
                if (!empty($product[$el['pro_field']])) {
                    $model = getModelByTable($el['table']);
                    $process = $model->processData($product_id, $product, $el['pro_field']);
                }
            }
        }
        if (!empty($process)) {
            RefreshQuotePrice($arr_quote);
        }
        return returnMessageAjax(200, 'Cập nhật dữ liệu thành công !', url('/profit-config-quote?quote_id='.$arr_quote['id']));
    }

    public function getCustomerSelectDataView($id)
    {
        $data['data_customer'] = Customer::find($id);
        $data['fields'] = Customer::FIELD_UPDATE;
        return $data;
    }

    public function selectCustomerUpdateQuote($request, $id = 0)
    {
        $data_customer = $request->except('_token', 'step', 'customer_id');
        $customer_id = $request->input('customer_id');
        $data_quote = $this->dataActionCustomer($customer_id, $data_customer);
        if (!empty($id)) {
            Quote::where('id', $id)->update($data_quote);
        }else{
            $data_quote['status'] = StatusConstant::NOT_ACCEPTED;
            $insert_id = Quote::insertGetId($data_quote);
        }
        if (!empty($insert_id)) {
            return redirect(asset('create-quote?step=handle_config&id='.$insert_id))->with('message', 'Thêm dữ liệu khách hàng thành công!');
        }else{
            return redirect(asset('update/quotes/'.$id.'?step=handle_config'))->with('message', 'Cập nhật liệu khách hàng thành công!');
        }
    }

    public function processDataQuote($request, $arr_quote)
    {
        $data = $request->except('_token', 'step');
        if (empty($data['product'])) {
            return returnMessageAjax(110, 'Không tìm thấy sản phẩm !');
        }else{
            $status = $this->processDataProduct($data, $arr_quote);
            return $status;
        }
    }
}
