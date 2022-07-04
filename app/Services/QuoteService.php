<?php 
namespace App\Services;
use App\Services\BaseService;
use App\Services\Traits\QuoteTrait;
use App\Services\Traits\QPaperTrait;
class QuoteService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}
    use QuoteTrait, QPaperTrait;
    public function insert($table, $data, $quote_id){
        if ($table == 'q_papers') {
            $data_insert = $this->getDataActionQPaper($data);
            $data_insert['quote_id'] = $quote_id;
        }
        $models = getModelByTable($table);
        $insert = $models->insert($data_insert);
        updateTotalAmountQuote($quote_id);
        return $insert;
    }
}