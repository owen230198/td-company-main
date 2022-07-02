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
        ->where('print_width','>=', $ex_width)->orderBy('print_length', 'asc')->first()->toArray();
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