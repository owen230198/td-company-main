<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Quote;
use App\Models\QPaper;
use App\Models\QCarton;
use App\Models\QFoam;
use App\Models\QSilk;
use App\Models\QFinish;
use App\Services\QTraits\QuoteTrait;
use App\Services\QTraits\QPaperTrait;
use App\Services\QTraits\QSupplyTrait;
use App\Models\Customer;
use App\Constants\StatusConstant;
class QuoteService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}
    use QuoteTrait, QPaperTrait, QSupplyTrait;

    public function insertCustomerQuote($customer_id, $data_customer)
    {
        $this->conFigBaseDataAction($data_customer);
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
}
