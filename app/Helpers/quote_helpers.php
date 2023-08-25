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
			$where['act'] = 1;
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
			return $category == \App\Models\ProductCategory::HARD_BOX;
		}
	}

	if (!function_exists('getTotalProductByArr')) {
		function getTotalProductByArr($products, $arr_quote = [], $get = '')
		{
			$ret = ['total_cost' => 0, 'total_amount' => 0];
			foreach ($products as $product) {
				$pwhere = ['act' => 1, 'product' => $product->id];
				$paper_total = \DB::table('papers')->select('total_cost')->where($pwhere)->sum('total_cost');
				$supply_total = \DB::table('supplies')->select('total_cost')->where($pwhere)->sum('total_cost');
				$fill_finish_total = \DB::table('fill_finishes')->select('total_cost')->where($pwhere)->sum('total_cost');
				$total_cost = (string) ($paper_total + $supply_total + $fill_finish_total);
				$update_product['total_cost'] = $total_cost;
				$get_perc = (float) $total_cost + (float) @$arr_quote['ship_price'];
				$update_product['total_amount'] = (string) calValuePercentPlus($total_cost, $get_perc,  @$arr_quote['profit']);
				\DB::table('products')->where('id', $product->id)->update($update_product);
				$ret['total_cost'] += $update_product['total_cost'];
				$ret['total_amount'] += $update_product['total_amount'];  
			}
			return !empty($get) && !empty($ret[$get]) ? $ret[$get] : $ret;
		}
	}

	if (!function_exists('getProductTotalCost')) {
		function getProductTotalCost($arr_quote, $get = '')
		{
			$qwhere = ['act' => 1, 'quote_id' => $arr_quote['id']];
			$products = \DB::table('products')->where($qwhere)->get();
			$ret = getTotalProductByArr($products, $arr_quote);
			return !empty($get) && !empty($ret[$get]) ? $ret[$get] : $ret;
		}
	}

	if (!function_exists('RefreshQuotePrice')) {
		function RefreshQuotePrice($arr_quote){
			$update_quote = getProductTotalCost($arr_quote);
			\DB::table('quotes')->where('id', $arr_quote['id'])->update($update_quote);
		}
	}

	if (!function_exists('refreshQuoteProfit')) {
		function refreshQuoteProfit($arr_quote)
		{
			$update_quote['total_cost'] = getProductTotalCost($arr_quote, 'total_cost');
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

	if (!function_exists('getTextDataPaperStage')) {
		function getTextdataPaperStage($stage, $value)
		{
			switch ($stage) {
				case \TDConst::PRINT:
					return \TDConst::PRINT_TECH[$value];
					break;
				case \TDConst::NILON:
					return getFieldDataById('name', 'materals', @$value['materal']).' '. @$value['face'] . ' mặt ';
				case \TDConst::UV:
					return getFieldDataById('name', 'materals', @$value['materal']);
				default:
					return '';
					break;
			}
		}
	}