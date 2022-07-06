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

    if (!function_exists('getLaminateMateralByKey')) {
		function getLaminateMateralByKey($key){
			$materals = getDataTable('q_laminate_materals', 'id, name', array(
		                ['key'=>'act', 'compare'=>'=', 'value'=>1],
		                ['key'=>'laminate_key', 'compare'=>'=', 'value'=>$key]
		                ), 0, 'name', 'asc');
		    $materals = $materals!=null?$materals:array();
		    return $materals;
		}
	}
}