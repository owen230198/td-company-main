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
        $this->quotes = new \App\Models\Quote;
        $this->q_papers = new \App\Models\QPaper;
        $this->q_cartons = new \App\Models\QCarton;
        $this->q_foams = new \App\Models\QFoam;
        $this->q_silks = new \App\Models\QSilk;
        $this->q_finishes = new \App\Models\QFinish;
	}
    use QuoteTrait, QPaperTrait, QSupplyTrait;

    public function getListDataQuote($quote_id)
    {
        $list_data['listPapers'] = $this->q_papers->select('total_cost')->where('quote_id', $quote_id)->get()->toArray();
        $list_data['listCatons'] = $this->q_cartons->select('total_cost')->where('quote_id', $quote_id)->get()->toArray();
        $list_data['listFoams'] = $this->q_foams->select('total_cost')->where('quote_id', $quote_id)->get()->toArray();
        $list_data['listSilks'] = $this->q_silks->select('total_cost')->where('quote_id', $quote_id)->get()->toArray();
        $list_data['listFinishes'] = $this->q_finishes->select('total_cost')->where('quote_id', $quote_id)->get()->toArray();
        return $list_data;
    }

    public function refreshQuoteTotal($quote_id)
    {
        $list_data = $this->getListDataQuote($quote_id);
        $listSupplies = array_merge($list_data['lisPapers'], $list_data['listCatons'], $list_data['listFoams'], $list_data['listSilks'], $list_data['listFinishes']);
        $total_cost = 0;
        foreach ($listSupplies as $item) {
            $total_cost += $item['total_cost'];     
        }
        $quote = $this->quotes->find($quote_id);
        $ship_price = @$quote['ship_price']?(float)$$quote['ship_price']:0;
        $profit = @$quote['profit']?(float)$$quote['profit']:0;
        $data['total_amount'] = $total_cost+((($total_cost+$ship_price)*$profit)/100);
        $data['total_cost'] = (float)$total_cost;
        $this->quotes->where('id', $quote_id)->update($data); 
    }

    private function getDataDoAction($data, $table, $quote_id)
    {
        if ($table == 'q_papers') {
            $data_action = $this->getDataActionQPaper($data);
        }elseif ($table == 'q_cartons' || $table == 'q_foams') {
            $data_action = $this->getDataActionCartonFoam($data, $table);
        }elseif ($table == 'q_silks') {
            $data_action = $this->getDataActionSilk($data);
        }elseif ($table == 'q_finishes') {
            $data_action = $this->getDataActionFinish($data, $quote_id);
        }
        $data_action['total_cost'] = $this->priceCaculatedByArray($data_action);
        return $data_action;
    }

    public function doInsert($table, $data, $quote_id){
        $data_insert = $this->getDataDoAction($data, $table, $quote_id);
        $data_insert['quote_id'] = $quote_id;
        $models = getModelByTable($table);
        $insert = $models->insert($data_insert);
        $this->refreshQuoteTotal($quote_id);
        return $insert;
    }

    public function doUpdate($table, $data, $quote_id, $id){
        $data_update = $this->getDataDoAction($data, $table, $quote_id);
        $models = getModelByTable($table);
        $update = $models::where('id', $id)->update($data_update);
        $this->refreshQuoteTotal($quote_id);
        return $update;
    }
}