<?php
if (!function_exists('getExactQuantityPaper')) {
	function getExactQuantityPaper($qty_pro = 0, $n_qty = 1)
	{
		$add_percent = getDataConfigs('QConfig', 'PLUS_PERCENT');
		$n_qty = $n_qty==0?1:$n_qty;
		$qty_paper = (int)($qty_pro/$n_qty);
		$ext = getValueWithPlusPercent($qty_paper, $add_percent);
		return ceil($ext);
	}
}

if (!function_exists('getLaminateMateralByKey')) {
	function getgetLaminateMateralByKey($key){
		$materals = getDataTable('q_laminate_materals', 'id, name', array(
	                ['key'=>'act', 'compare'=>'=', 'value'=>1],
	                ['key'=>'laminate_key', 'compare'=>'=', 'value'=>$key]
	                ), 0, 'name', 'asc');
	    $materals = $materals!=null?$materals:array();
	    return $materals;
	}
}

if (!function_exists('getPriterDevice')) {
	function getPriterDevice($length, $width, $device)
	{
		$ex_length = $length*100;
        $ex_width = $width*100;
        $printers  = new \App\Models\QPrinterDevice;
        $printer = $printers->where('device', $device)
        ->where('print_length', '>=', $ex_length)
        ->where('print_width','>=', $ex_width)->orderBy('print_length', 'asc')->first();
        return $printer;
	}
}

if (!function_exists('getLaminateMateralQuote')) {
	function getPriceMateralQuote($id)
	{
		$materals = new \App\Models\QLaminateMateral;
        $materal = $materals->find($id);
        return isset($materal['price'])?(int)$materal['price']:0;
	}
}

if (!function_exists('createNonActiveObj')) {
	function createNonActiveObj()
	{
		$obj = new \stdClass();
        $obj->act = 0;
        return json_encode($obj);
	}	
}

if (!function_exists('priceCaculatedByArray')) {
	function priceCaculatedByArray($arr)
	{
		$ret = 0;
		if ($arr!=null&&count($arr)>0) {
            foreach ($arr as $key => $value) {
                $stage = json_decode($value);
                if (@$stage->total) {
                    $ret += $stage->total;
                }
            }
        }
        return $ret;
	}
}

if (!function_exists('function_name')) {
	if (!function_exists('getPriceOnlyPro')) {
	    function getPriceOnlyPro($table, $id){
	        $models = getModelByTable($table);
	        $data = $models->find($id);
	        $total = priceCaculatedByArray($data);
	        return $total;
	    }
	}
}


if (!function_exists('updateTotalCostQuote')) {
    function updateTotalCostQuote($quote_id)
    {
        $quotes_products = new \App\Models\QPaper;
        // $quotes_cartons = new \App\Models\QuoteCarton;
        // $quotes_silks = new \App\Models\QuoteSilk;
        // $quotes_finishes = new \App\Models\QuoteFinish;
        $list_pro = $quotes_products->where('quote_id', $quote_id)->get();
        // $list_carton = $quotes_cartons->where('quote', $parent)->get();
        // $list_silk = $quotes_silks->where('quote', $parent)->get();
        // $list_finish = $quotes_finishes->where('quote', $parent)->get();
        $list = $list_pro;
        $data['total_cost'] = 0;
        if ($list!=null&&count($list)>0) {
            foreach ($list as $value) {
                $data['total_cost'] += $value['total_cost'];     
            }
        }
        $quotes = new \App\Models\Quote;
        $quotes->where('id', $quote_id)->update($data);
        return $data['total_cost'];   
    }
}