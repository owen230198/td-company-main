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
}
