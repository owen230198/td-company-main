<?php 
namespace App\Services;
use App\Services\BaseService;
use App\Services\QTraits\QuoteTrait;
use App\Services\QTraits\QPaperTrait;
use App\Services\QTraits\QSupplyTrait;
class QuoteService extends BaseService
{
	function __construct()
	{
		parent::__construct();
        $this->q_papers = new \App\Models\QPaper;
        $this->q_cartons = new \App\Models\QCarton;
        $this->quotes = new \App\Models\Quote;
	}
    use QuoteTrait, QPaperTrait, QSupplyTrait;

    public function refreshQuoteTotal($quote_id)
    {
        $lisPapers = $this->q_papers->where('quote_id', $quote_id)->get()->toArray();
        $listCatons = $this->q_cartons->where('quote_id', $quote_id)->get()->toArray();
        // $list_silk = $quotes_silks->where('quote', $parent)->get();
        // $list_finish = $quotes_finishes->where('quote', $parent)->get();
        $list = array_merge($lisPapers, $listCatons);
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

    private function getDataDoAction($data, $table)
    {
        if ($table == 'q_papers') {
            $data_action = $this->getDataActionQPaper($data);
        }elseif ($table == 'q_cartons' || $table == 'q_foams') {
            $data_action = $this->getDataActionCartonFoam($data, $table);
        }elseif ($table == 'q_silks') {
            $data_action = $this->getDataActionSilk($data);
        }
        $data_action['total_cost'] = $this->priceCaculatedByArray($data_action);
        return $data_action;
    }

    public function doInsert($table, $data, $quote_id){
        $data_insert = $this->getDataDoAction($data, $table);
        $data_insert['quote_id'] = $quote_id;
        $models = getModelByTable($table);
        $insert = $models->insert($data_insert);
        $this->refreshQuoteTotal($quote_id);
        return $insert;
    }

    public function doUpdate($table, $data, $quote_id, $id){
        $data_update = $this->getDataDoAction($data, $table);
        $models = getModelByTable($table);
        $update = $models::where('id', $id)->update($data_update);
        $this->refreshQuoteTotal($quote_id);
        return $update;
    }
}