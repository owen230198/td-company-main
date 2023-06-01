<?php

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
			return @$materal->id;
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

	if (!function_exists('getProductTotalCost')) {
		function getProductTotalCost($quote_id)
		{
			$qwhere = ['act' => 1, 'quote_id' => $quote_id];
			$products = \DB::table('products')->where($qwhere)->get();
			$ret = 0;
			foreach ($products as $product) {
				$pwhere = ['act' => 1, 'product' => $product->id];
				$paper_total = \DB::table('papers')->select('total_cost')->where($pwhere)->sum('total_cost');
				$supply_total = \DB::table('supplies')->select('total_cost')->where($pwhere)->sum('total_cost');
				$fill_finish_total = \DB::table('fill_finishes')->select('total_cost')->where($pwhere)->sum('total_cost');
				$update_product['total_cost'] = (string) ($paper_total + $supply_total + $fill_finish_total);
				\DB::table('products')->where('id', $product->id)->update($update_product);
				$ret += $update_product['total_cost']; 
			}
			return (float) $ret;
		}
	}

	if (!function_exists('RefreshQuotePrice')) {
		function RefreshQuotePrice($arr_quote){
			$update_quote['total_cost'] = getProductTotalCost($arr_quote['id']);
			$get_perc = (float) $update_quote['total_cost'] + (float) $arr_quote['ship_price'];
			$update_quote['total_amount'] = (string) calValuePercentPlus($update_quote['total_cost'], $get_perc,  $arr_quote['profit']);
			\DB::table('quotes')->where('id', $arr_quote['id'])->update($update_quote);
		}
	}

	if (!function_exists('refreshQuoteProfit')) {
		function refreshQuoteProfit($arr_quote)
		{
			$update_quote['total_cost'] = getProductTotalCost($arr_quote['id']);
			$quote_total = $update_quote['total_cost'] + (float) @$arr_quote['ship_price'];
			$quote_amount = (float) @$arr_quote['total_amount'];
			$update_quote['profit'] = (($quote_amount - $quote_total) / $quote_total) * 100;
			\DB::table('quotes')->where('id', $arr_quote['id'])->update($update_quote);
		}
	}

	if (!function_exists('getDataProExportFile')) {
		function getDataProExportFile($product){
			$main_paper = \App\Models\Paper::where(['act' => 1, 'main' => 1, 'product' => $product['id']])->first()->toArray();
            $ret['size'] = !empty($main_paper['size']) ? json_decode($main_paper['size'], true) : [];
            $ret['print'] = !empty($main_paper['print']) ? json_decode($main_paper['print'], true) : []; 
            $ret['nilon'] = !empty($main_paper['nilon']) ? json_decode($main_paper['nilon'], true) : [];
            $ret['compress'] = !empty($main_paper['compress']) ? json_decode($main_paper['compress'], true) : [];
            $ret['uv'] = !empty($main_paper['uv']) ? json_decode($main_paper['uv'], true) : [];
            $elevate = !empty($main_paper['elevate']) ? json_decode($main_paper['elevate'], true) : [];
            $ret['float'] = isHardBox($product['category']) ? json_decode(@$main_paper['float'], true) : @$elevate['float'];
			$data['main_paper'] = $main_paper;
			return $ret;
		}
	}