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
			$materals = getDataTable('q_laminate_materals', '*', array(
		                ['key'=>'act', 'compare'=>'=', 'value'=>1],
		                ['key'=>'laminate_key', 'compare'=>'=', 'value'=>$key]
		                ), 0, 'name', 'asc');
		    $materals = $materals!=null?$materals:array();
		    return $materals;
		}
	}

	if (!function_exists('getNameSupplyByType')) {
		function getSupplyByType($table, $key){
			$supply = getDataTable($table, '*', array(
		                ['key'=>'act', 'compare'=>'=', 'value'=>1],
		                ['key'=>'type', 'compare'=>'=', 'value'=>$key]
		                ), 0, 'name', 'asc');
		    return $supply!=null?$supply:array();
		}
	}

	if (!function_exists('getSupplyPriceByParent')) {
		function getSupplyPriceByParent($supply_id)
		{
			$supply_prices = new \App\Models\QSupplyPrice;
			$data = $supply_prices->where('act', 1)->where('q_supply_id', $supply_id)->orderBy('name', 'asc')->get();
            return $data!=null?$data:array();
		}
	}

	if (!function_exists('getStepCreateQuote')) {
		function getStepCreateQuote($key){
			switch($key){
				case $key == 'chose_customer':
					return 'Chọn khách hàng (khách hàng cũ hoặc thêm khách hàng mới)';
					break;
				default:
					return '';
			};
		}
	}
}