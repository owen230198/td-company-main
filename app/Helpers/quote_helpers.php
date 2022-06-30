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