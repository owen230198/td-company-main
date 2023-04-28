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
					return 'Chi tiết sản xuất';
			};
		}
	}

	if (!function_exists('getDeviceId')) {
		function getDeviceId($where)
		{
			$device = \DB::table('devices')->select('id')->where($where)->first();
			return @$device->id ?? 0;
		}
	}

	if (!function_exists('getDefaultMateralIDByKey')) {
		function getDefaultMateralIDByKey($key)
		{
			$materal = \DB::table('materals')->select('id')->where(['act' => 1, 'type' => $key, 'default' => 1])->first();
			return $materal->id;
		}
	}

	if (!function_exists('convertCmToMeter')) {
		function convertCmToMeter(&$length, &$width){
			// $length = $length/100;
			// $width = $width/100;
			$length = $length;
			$width = $width;
		}
	}

	if (!function_exists('isHardBox')) {
		function isHardbox($category)
		{
			return $category == \TDConst::HARD_BOX;
		}
	}

	if (!function_exists('RefreshQuotePrice')) {
		function RefreshQuotePrice($arr_quote){
			$qwhere = ['act' => 1, 'quote_id' => $arr_quote['id']];
			$products = \DB::table('products')->where($qwhere)->get();
			$update_quote['total_cost'] = 0;
			foreach ($products as $product) {
				$pwhere = ['act' => 1, 'product' => $product->id];
				$paper_total = \DB::table('papers')->select('total_cost')->where($pwhere)->sum('total_cost');
				$supply_total = \DB::table('supplies')->select('total_cost')->where($pwhere)->sum('total_cost');
				$fill_finish_total = \DB::table('fill_finishes')->select('total_cost')->where($pwhere)->sum('total_cost');
				$update_product['total_cost'] = (string) ($paper_total + $supply_total + $fill_finish_total);
				\DB::table('products')->where('id', $product->id)->update($update_product);
				$update_quote['total_cost'] += $update_product['total_cost']; 
			}
			$get_perc = (float) $update_quote['total_cost'] + (float) $arr_quote['ship_price'];
			$update_quote['total_amount'] = (string) calValuePercentPlus($update_quote['total_cost'], $get_perc,  $arr_quote['profit']);
			\DB::table('quotes')->where('id', $arr_quote['id'])->update($update_quote);
		}
	}
}