<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Customer;
use App\Models\Quote;
use App\Models\QProduct;
use App\Services\QTraits\QuoteTrait;
use App\Services\QTraits\QPaperTrait;
use App\Services\QTraits\QSupplyTrait;
use App\Constants\StatusConstant;
use App\Constants\TDConstant;
class QuoteService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}
    use QuoteTrait, QPaperTrait, QSupplyTrait;

    public function insertCustomerQuote($customer_id, $data_customer)
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
        $data_quote['status'] = StatusConstant::NOT_ACCEPTED;
        return Quote::insertGetId($data_quote);
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

    private function productValidate($data, $key){
        $valid = true;
        $arr = returnMessageAjax(200, 'Cập nhật dữ liệu thành công !');
        $num = $key + 1;
        if (empty($data['name'])) {
            $valid = false;
            $arr = returnMessageAjax(110, 'Bạn chưa nhập tên cho sản phẩm '. $num);
        }else{
            if (empty($data['category'])) {
                $valid = false;
                $arr = returnMessageAjax(110, 'Bạn chưa chọn nhóm sản phẩm cho '. $data['name']);
            }
    
            if (empty($data['design'])) {
                $valid = false;
                $arr = returnMessageAjax(110, 'Bạn chưa chọn mẫu thiết kế cho '. $data['name']);
            }
        }
        return ['valid' => $valid, 'arr' => $arr];
    }

    public function getDataActionProduct($data){
        $data_action['name'] = $data['name'];
        $data_action['category'] = $data['category'];
        $data_action['design'] = $data['design'];
        $data_action['quote_id'] = $data['quote_id'];
        $this->configBaseDataAction($data_action);
        return $data_action;
    }

    public function insertProduct($data)
    {
        $data_insert = $this->getDataActionProduct($data);
        return QProduct::insertGetId($data_insert);
    }

    public function insertDataProduct($data)
    {
        $data_product = $data['product'];
        foreach ($data_product as $key => $product) {
            $product_valid = ['valid' => true];
            if (@$product_valid['valid'] == false) {
               return $product_valid['arr'];
               break;
            }else{
                $product['quote_id'] = $data['id'];
                $product_id = $this->insertProduct($product);
                $elements = TDConstant::HARD_ELEMENT;
                foreach ($elements as $el) {
                    if (!empty($product[$el['pro_field']])) {
                        $model = getModelByTable($el['key']);
                        $status = $model->insertData($product_id, $product[$el['pro_field']]);
                    }
                }
            }
        }
        $code = !empty($status) ? 200 : 100;
        $message = !empty($status) ? 'Cập nhật dữ liệu thành công !' : 'Có lỗi xảy ra, vui lòng thử lại !';
        return returnMessageAjax($code, $message);
    }
}
