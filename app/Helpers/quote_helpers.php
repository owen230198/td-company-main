<?php

use App\Models\PaperExtend;

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

	if (!function_exists('getJsonExtNamePaper')) {
		function getJsonExtNamePaper()
        {
			return PaperExtend::all()->pluck('name');
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
		function getTotalProductByArr($products, $get = '', $get_factor = false, $only_get = false)
		{
			$ret = ['total_cost' => 0, 'total_amount' => 0, 'base_total' => 0];
			$factor = 0;
			foreach ($products as $product) {
				if (empty($product->parent)) {
					$product = (object) $product;
					$pwhere = ['act' => 1, 'product' => $product->id];
					$paper_total = \DB::table('papers')->select('total_cost')->where($pwhere)->sum('total_cost');
					$supply_total = \DB::table('supplies')->select('total_cost')->where($pwhere)->sum('total_cost');
					$fill_finish_total = \DB::table('fill_finishes')->select('total_cost')->where($pwhere)->sum('total_cost');
					$cost = (string) ($paper_total + $supply_total + $fill_finish_total);
				}else{
					$cost = $product->total_cost;
				}
				$round_number = $product->qty;
				$profit = (float) @$product->profit;
				$ship_price = (float) @$product->ship_price;
				$total_cost = $round_number > 0 ? round($cost / $round_number) * $round_number : $cost;
				$ex_products = \DB::table('products')->where('parent', $product->id)->get();
				$total_ex = getTotalProductByArr($ex_products);
				$update['total_cost'] = $total_cost + $total_ex['total_cost'];
				$get_perc = (float) $update['total_cost'] + $ship_price;
				$total_amount = ($get_perc * ((100 + $profit) / 100));
				$update['base_total'] = $total_amount;
				$ret['base_total'] += $total_amount;
				$update['total_amount'] = $round_number > 0 ? round($total_amount / $round_number) * $round_number : $total_amount;
				if (!$only_get) {
					\DB::table('products')->where('id', $product->id)->update($update);
				}
				$ret['total_cost'] += $update['total_cost'];
				$ret['total_amount'] += $update['total_amount'];
				$factor ++;
			}
			if ($get_factor) {
				$ret['factor'] = $factor;
			}
			return !empty($get) && !empty($ret[$get]) ? $ret[$get] : $ret;
		}
	}

	if (!function_exists('RefreshQuotePrice')) {
		function RefreshQuotePrice($obj_refresh){
			$is_quotes = $obj_refresh->getTable() == 'quotes';
			$key_quuery = $is_quotes ? 'quote_id' : 'order';
			$products = \DB::table('products')->where($key_quuery, $obj_refresh->id)->get();
			$arr_update = getTotalProductByArr($products);
			$obj_refresh->total_cost = $arr_update['total_cost'];
			$obj_refresh->base_total = $arr_update['base_total'];
			$amount = $arr_update['total_amount'];
			$obj_related = $is_quotes ? \App\Models\Order::where('quote', $obj_refresh->id) : \App\Models\Quote::where('id', $obj_refresh->quote);
			if ($is_quotes) {
				$obj_refresh->total_amount = $amount;
				$obj_order = $obj_related->first();
				$order_amount = @$obj_order->vat == 1 ? calValuePercentPlus($amount, $amount, (float) getDataConfig('QuoteConfig', 'VAT_PERC', 0)) : $amount;
				$arr_update['total_amount'] = $order_amount;
            	$arr_update['rest'] = $order_amount - (float) @$obj_order->advance;
			}else{
				$order_amount = @$obj_refresh->vat == 1 ? calValuePercentPlus($amount, $amount, (float) getDataConfig('QuoteConfig', 'VAT_PERC', 0)) : $amount;
				$obj_refresh->total_amount = $order_amount;
				$obj_refresh->rest = $order_amount - (float) @$obj_refresh->advance;	
			}
			$obj_refresh->save();
			$obj_related->update($arr_update);
		}
	}

	if (!function_exists('refreshProfit')) {
		function refreshProfit($obj_refresh)
		{
			$is_quotes = $obj_refresh->getTable() == 'quotes';
			$key_quuery = $is_quotes ? 'quote_id' : 'order';
			$product_obj = \DB::table('products')->where($key_quuery, $obj_refresh->id);
			$arr_total =  getTotalProductByArr($product_obj->get(), '', true, true, true);
			$base_total = $obj_refresh->base_total;
			$ship_price = (float) @$obj_refresh['ship_price'];
			$total_cost = $arr_total['total_cost'];
			$factor = $arr_total['factor'];
			$data_update['total_cost'] = $total_cost;
			$data_update['profit'] = ($base_total / ($total_cost + ($ship_price * $factor)) * 100) - 100;
			$obj_refresh->total_cost = $data_update['total_cost'];
			$obj_refresh->profit = $data_update['profit'];
			$obj_refresh->save();
			$obj_related = $is_quotes ? \App\Models\Order::where('quote', $obj_refresh->id) : \App\Models\Quote::where('id', $obj_refresh->quote);
			$obj_related->update($data_update);
			$product_obj->update($data_update);
		}
	}
	
	if (!function_exists('recursiveProduct')) {
		function recursiveProduct($products, &$ret)
		{
			foreach ($products as $product) {
				$ret[] = $product;
				$childs = \DB::table('products')->where('parent', $product->id)->get();
				if (!$childs->isEmpty()) {
					recursiveProduct($childs, $ret);
				}
			}
		}
	}

	if (!function_exists('getDataProExportFile')) {
		function getDataProExportFile($product){
			$main_paper = \App\Models\Paper::where(['act' => 1, 'main' => 1, 'product' => $product['id']])->first();
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
				case \TDConst::METALAI:
					$ret = getFieldDataById('name', 'materals', @$value['materal']).' '. @$value['face'] . ' mặt ';
					if (!empty($value['cover_materal']) && $value['cover_face']) {
						$ret .= ' - Phủ trên : '.getFieldDataById('name', 'materals', @$value['cover_materal']).' '. @$value['cover_face'] . ' mặt ';
					}
					return $ret;
				case \TDConst::NILON:
					return getFieldDataById('name', 'materals', @$value['materal']).' '. @$value['face'] . ' mặt ';
				case \TDConst::UV:
					return getFieldDataById('name', 'materals', @$value['materal']).' '. @$value['face'] . ' mặt ';
				default:
					return getFieldDataById('name', 'devices', @$value['machine']);
					break;
			}
		}
	}

	if (!function_exists('getPlusPaperNumber')) {
		function getPlusPaperNumber()
		{
			return (int) getDataConfig('QuoteConfig', 'PLUS_DIRECT') + (int) getDataConfig('QuoteConfig', 'PLUS_TO_PERCENT');
		}
	}

	if (!function_exists('getTextQuoteFinish')) {
		function getTextQuoteFinish($data)
		{
			$text = '';
			if (@$data['nilon']['act'] == 1) {
				$text .= "+ Cán nilon: ".getTextdataPaperStage(\TDConst::NILON, $data['nilon']);
			}

			if (@$data['compress']['act'] == 1) {
				$text .= "+ ép nhũ theo maket";
			}

			if (@$data['uv']['act'] == 1) {
				$text .= "+ in lưới UV ".mb_strtolower(getTextdataPaperStage(\TDConst::UV, $data['uv']))." theo maket";
			}

			if (@$data['float']['act'] == 1) {
				$text .= "+ thúc nổi sản phẩm";
			}
			return $text;
		}
	}