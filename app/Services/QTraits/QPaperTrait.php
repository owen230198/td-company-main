<?php  
namespace App\Services\QTraits;

use App\Models\Paper;

trait QPaperTrait
{
	// private function configDataSizePaper($paper)
	// {
    //     $qttv = !empty($paper['qttv']) ? (float) $paper['qttv'] : 0;
    //     $price = !empty($paper['materal']) && $paper['materal'] != 'other' ? ((float) getFieldDataById('price', 'materals', $paper['materal'])) : 
    //             (!empty($paper['unit_price']) ? (float) $paper['unit_price'] : 0);
    //     $plus_paper = getPluspaperNumber();;
    //     $supp_qty = self::$supp_qty + $plus_paper;
    //     // Công thức tính chi phí khổ in : dài x rộng x định lượng x (số tờ in + 100) x ĐG
    //     $total = self::$length * self::$width * $qttv * $supp_qty * $price;
    //     $paper['materal_price'] = $price;
    //     $paper['supp_qty'] = $supp_qty;
    //     $obj = $this->getObjectConfig($paper, $total);
    //     return $obj;
	// }

	private function configDataPrint($print)
	{
		$color = !empty($print['color']) ? $print['color'] : 0;
        $type = !empty($print['type']) ? $print['type'] : 0;
        $device_id = !empty($print['machine']) ? $print['machine'] : 0;
        $subtract_paper = (int) getDataConfig('QuoteConfig', 'PRINT_SUBTRACT_PAPER');
        $plus_paper_device = (int) getDataConfig('QuoteConfig', 'PLUS_PAPER_DEVICE');
        $supp_qty = self::$base_supp_qty - $subtract_paper + $plus_paper_device;
        $device = $this->getPriterDevice($device_id);
        $model_price = !empty($device['model_price']) ? (float) $device['model_price'] : 0;
        $work_price = !empty($device['work_price']) ? (float) $device['work_price'] : 0;
        $shape_price = !empty($device['shape_price']) ? (float) $device['shape_price'] : 0;
        if ($color == \TDConst::APLA_PRINT_COLOR) {
            $apla_factor = (float) getDataConfig('QuoteConfig', 'APLA_PRICE_FACTOR');
            $apla_plus = (float) getDataConfig('QuoteConfig', 'APLA_PRICE_PLUS');
            $print_factor = $type == \TDConst::ONE_PRINT_TYPE ? 1 : 2;
            $apla_price = self::$length * self::$width * $apla_factor * $print_factor;
            $print['print_factor'] = $print_factor;
            $print['apla_factor'] = $apla_factor;
            $print['apla_plus'] = $apla_plus;
            $print['apla_price'] = $apla_price;
            $total = ($supp_qty * $apla_price) + $apla_plus;
        }else{
            $total = Paper::getPrintFormula($type, $supp_qty, (int) $color, $work_price, $shape_price, $model_price);
        }
        $print['supp_qty'] = $supp_qty;
        $print['handle_qty'] = self::$handle_qty;
        $print['model_price'] = $model_price;
        $print['work_price'] = $work_price;
        $print['shape_price'] = $shape_price;
        $print['printer'] = !empty($device['id']) ? $device['id'] : 0;
        return $this->getObjectConfig($print, $total);	
	}

    private function configDataMembrane($model_price, $work_price, $shape_price, $data, $key_type)
    {
        $materal_cost = $this->getPriceMateralQuote($data);
        $num_face = @$data['face'] ?? 0;
        if ($key_type == \TDConst::METALAI) {
            $plus_paper = (float) getDataConfig('QuoteConfig', 'PLUS_PAPER_METALAI');
            $supp_qty = self::$supp_qty + $plus_paper;
        }else{
            $supp_qty = self::$supp_qty;
        }
        $total = $this->getBaseTotalStage($supp_qty, $model_price, $work_price, $shape_price, $materal_cost, 
        $num_face);
        $data['supp_qty'] = $supp_qty;
        $data['handle_qty'] = self::$handle_qty;
        $data['materal_price'] = $materal_cost;
        return $this->getObjectConfig($data, $total);
    }

    private function configDataCompressFloat($compress_float, $get_total = false)
    {
        $price = !empty($compress_float['price']) ? (float)$compress_float['price'] : 0;
        $shape_price = !empty($compress_float['shape_price']) ? (float) $compress_float['shape_price'] : 0;
        // Công thức tính chi phí ép nhũ - thúc nổi : SL sản phẩm x giá tiền sx 1 sản phẩm + số bát x chi phí khuôn
        $total = (self::$qty_pro * $price) + (self::$nqty * $shape_price);
        $compress_float['qty_pro'] = self::$qty_pro;
        $compress_float['handle_qty'] = self::$handle_qty;
        $compress_float['nqty'] = self::$nqty;
        return !empty($get_total) ? $total : $this->getObjectConfig($compress_float, $total);
    }

    private function configDataExtPrice($plus)
    {
        // Công thức tính chi phí phát sinh: SL sản phẩm x giá phát sinh/sản phẩm;
        $temp_price = !empty($plus['temp_price']) ? (float) $plus['temp_price'] : 0;
        $pre_price = !empty($plus['prescript_price']) ? (float) $plus['prescript_price'] : 0;
        $supp_price = !empty($plus['supp_price']) ? (float) $plus['supp_price'] : 0;
        $total = self::$base_qty_pro * ($temp_price + $pre_price + $supp_price);
        $plus['qty_pro'] = self::$base_qty_pro;
        $obj = $this->getObjectConfig($plus, $total);
        return $obj;
    }

    private function getDataActionPaper($data, $dataItem)
    {
        $data['supp_qty'] = !empty($data['supp_qty']) ? (int) $data['supp_qty'] - getPlusPaperNumber() : 0;
        $base_supp_qty = !empty($data['base_supp_qty']) ? (int) $data['base_supp_qty'] : 0;
        $data['handle_qty'] = $base_supp_qty;
        $data['base_supp_qty'] = $base_supp_qty - (int) getDataConfig('QuoteConfig', 'PLUS_DIRECT');
        $this->newObjectSetProperty($data);
        $handle_type = (int) @$data['handle_type'];
        $data_action['handle_type'] = $handle_type;
        $data_action['note'] = @$data['note'];
        if ($handle_type == \TDConst::MADE_BY_OWN) {
            $data_action['nqty'] = $data['nqty'];
            $data_action['double'] = !empty($data['double']) ? 1 : 0;
            $data_action['compent_percent'] = @$data['compent_percent'] ?? 0;
            $data_action['compent_plus'] = @$data['compent_plus'] ?? 0;
            if (!empty($data['size'])) {
                $data_action['size'] = $this->configDataSupplySize($data['size'], \TDConst::PAPER);
            }
            $handle_arr = getArrHandleField('papers');
            foreach ($handle_arr as $stage) {
                if (!empty($data[$stage])) {
                    $item_stage = !empty($dataItem[$stage]) ? json_decode($dataItem[$stage],true) : []; 
                    $data[$stage]['handled_qty'] = @$item_stage['handled_qty'] ?? 0;
                    if ($stage == \TDConst::PRINT) {
                        $data_action[$stage] = $this->configDataPrint($data[$stage]);
                    }elseif (in_array($stage, [\TDConst::COMPRESS, \TDConst::FLOAT])) {
                        $data_action[$stage] = $this->configDataCompressFloat($data[$stage]);
                    }else{
                        if ($stage == \TDConst::COVER && !empty($data[\TDConst::METALAI]['machine'])) {
                            $data[$stage]['machine'] = $data[\TDConst::METALAI]['machine'];  
                        }
                        $data_action[$stage] = $this->configDataStage($data[$stage], $stage);
                    }
                }
            }

            if (!empty($data['ext_price'])) {
                $data_action['ext_price'] = $this->configDataExtPrice($data['ext_price']);
            }
            $data_action['total_cost'] = $this->priceCaculatedByArray($data_action);    
        }else{
            $data_action['total_cost'] = 0;    
        }
        return $data_action;
    }
}