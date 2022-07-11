<?php 
namespace App\Services;
use App\Services\BaseService;
use App\Services\QTraits\QuoteTrait;
use App\Services\QTraits\QPaperTrait;
use App\Services\QTraits\QCartonTrait;
class QuoteService extends BaseService
{
	function __construct()
	{
		parent::__construct();
        $this->quotes_products = new \App\Models\QPaper;
        $this->quotes = new \App\Models\Quote;
	}
    use QuoteTrait, QPaperTrait, QCartonTrait;

    public function refreshQuoteTotal($quote_id)
    {
        $this->quotes_products = new \App\Models\QPaper;
        // $quotes_cartons = new \App\Models\QuoteCarton;
        // $quotes_silks = new \App\Models\QuoteSilk;
        // $quotes_finishes = new \App\Models\QuoteFinish;
        $list_pro = $this->quotes_products->where('quote_id', $quote_id)->get();
        // $list_carton = $quotes_cartons->where('quote', $parent)->get();
        // $list_silk = $quotes_silks->where('quote', $parent)->get();
        // $list_finish = $quotes_finishes->where('quote', $parent)->get();
        $list = $list_pro;
        $total_cost = 0;
        if ($list!=null&&count($list)>0) {
            foreach ($list as $value) {
                $total_cost += $value['total_cost'];     
            }
        }
        
        $quote = $this->quotes->find($quote_id);
        $ship_price = @$quote['ship_price']?(float)$$quote['ship_price']:0;
        $profit = @$quote['profit']?(float)$$quote['profit']:0;
        $data['total_amount'] = $total_cost+((($total_cost+$ship_price)*$profit)/100);
        $data['total_cost'] = (float)$total_cost;
        $this->quotes->where('id', $quote_id)->update($data); 
    }

    public function doInsert($table, $data, $quote_id){
        if ($table == 'q_papers') {
            $data_insert = $this->getDataActionQPaper($data);
        }elseif ($table == 'q_cartons') {
            $data_insert = $this->getDataActionQCarton($data, $table);
        }
        $models = getModelByTable($table);
        $data_insert['quote_id'] = $quote_id;
        $insert = $models->insert($data_insert);
        $this->refreshQuoteTotal($quote_id);
        return $insert;
    }

    public function doUpdate($table, $data, $quote_id, $id){
        if ($table == 'q_papers') {
            $data_update = $this->getDataActionQPaper($data);
        }
        $models = getModelByTable($table);
        $update = $models::where('id', $id)->update($data_update);
        $this->refreshQuoteTotal($quote_id);
        return $update;
    }
}