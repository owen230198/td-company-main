<?php  
namespace App\Services\QTraits;

use App\Models\Paper;

trait QPaperTrait
{
	private function configDataSizePaper($paper)
	{
        $qttv = !empty($paper['qttv']) ? (float) $paper['qttv'] : 0;
        $price = !empty($paper['materal']) && $paper['materal'] != 'other' ? ((float) getFieldDataById('price', 'materals', $paper['materal'])) : 
                (!empty($paper['unit_price']) ? (float) $paper['unit_price'] : 0);
        $plus_paper = getPluspaperNumber();;
        $supp_qty = self::$supp_qty + $plus_paper;
        // Công thức tính chi phí khổ in : dài x rộng x định lượng x (số tờ in + 100) x ĐG
        $total = self::$length * self::$width * $qttv * $supp_qty * $price;
        $paper['materal_price'] = $price;
        $paper['supp_qty'] = $supp_qty;
        $obj = $this->getObjectConfig($paper, $total);
        return $obj;
	}

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

    private function configDataUVNAndNilon($model_price, $work_price, $shape_price, $uv_nilon)
    {
    	$materal_id = !empty($uv_nilon['materal']) ? $uv_nilon['materal'] : 0;
        $materal_cost = $this->getPriceMateralQuote($materal_id);
        $num_face = !empty($uv_nilon['face']) ? (int)$uv_nilon['face'] : 0;
        $total = $this->getBaseTotalStage(self::$supp_qty, $model_price, $work_price, $shape_price, $materal_cost, $num_face);
        // $total = $length*$width*$materal_cost*$supp_qty*$num_face+$shape_price;
        $uv_nilon['supp_qty'] = self::$supp_qty;
        $uv_nilon['handle_qty'] = self::$handle_qty;
        $uv_nilon['materal_price'] = $materal_cost;
        return $this->getObjectConfig($uv_nilon, $total);
    }

    private function configDataMetalai($model_price, $work_price, $shape_price, $metalai)
    {
        $materal_id = !empty($metalai['materal']) ? $metalai['materal'] : 0;
        $materal_cost = $this->getPriceMateralQuote($materal_id);
        $num_face = !empty($metalai['face']) ? (int) $metalai['face'] : 0;
        $plus_paper = (float) getDataConfig('QuoteConfig', 'PLUS_PAPER_METALAI');
        $supp_qty = self::$supp_qty + $plus_paper;
        $total_metalai = $this->getBaseTotalStage($supp_qty, $model_price, $work_price, $shape_price, $materal_cost, 
        $num_face);
        $metalai['supp_qty'] = $supp_qty;
        $metalai['handle_qty'] = self::$handle_qty;
        $metalai['cover_supp_qty'] = $supp_qty;
        $metalai['materal_price'] = $materal_cost;
        $metalai['metalai_price'] = $total_metalai;

        $cover_materal_id = !empty($metalai['cover_materal']) ? $metalai['cover_materal'] : 0;
        $cover_materal_cost = $this->getPriceMateralQuote($cover_materal_id);
        $cover_num_face = !empty($metalai['cover_face']) ? (int) $metalai['cover_face'] : 0;
        $total_cover = $this->getBaseTotalStage(self::$supp_qty, $model_price, $work_price, $shape_price, $cover_materal_cost, 
        $cover_num_face);
        $metalai['materal_cover_price'] = $cover_materal_cost;
        $metalai['metalai_cover_price'] = $total_cover;

        // Công thức tính chi phí cán metalai : chi phí cán metalai + chi phí cán phủ trên
        $total = $total_metalai + $total_cover;
        return $this->getObjectConfig($metalai, $total);
    }

    private function configDataCompressFloat($compress_float, $get_total = false)
    {
        $price = !empty($compress_float['price']) ? (float)$compress_float['price'] : 0;
        $shape_price = !empty($compress_float['shape_price']) ? (float) $compress_float['shape_price'] : 0;
        // Công thức tính chi phí ép nhũ - thúc nổi : chi phí cán metalai + chi phí cán phủ trên
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

    private function getDataActionPaper($data)
    {
        $data['supp_qty'] = !empty($data['supp_qty']) ? (int) $data['supp_qty'] - getPlusPaperNumber() : 0;
        $data['base_supp_qty'] = !empty($data['base_supp_qty']) ? (int) $data['base_supp_qty'] - (int) getDataConfig('QuoteConfig', 'PLUS_TO_DEVICE_WORKER') : 0;
        $this->newObjectSetProperty($data);
        if (!empty($data['size'])) {
            $data_action['size'] = $this->configDataSizePaper($data['size']);
        }

        $handle_type = (int) @$data['handle_type'];
        $data_action['handle_type'] = $handle_type;
        $data_action['note'] = @$data['note'];
        if ($handle_type == \TDConst::MADE_BY_OWN) {
            $data_action['nqty'] = $data['nqty'];
            $data_process['double'] = $data['double'];
            $data_process['base_supp_qty'] = $data['base_supp_qty'];
            $data_process['compent_percent'] = $data['compent_percent'];
            $data_process['compent_plus'] = $data['compent_plus'];
            $data_process['supp_qty'] = $data['supp_qty'];
            if (!empty($data['print'])) {
                $data_action['print'] = $this->configDataPrint($data['print']);
            }
            
            if (!empty($data['nilon'])) {
                $data_action['nilon'] = $this->configDataStage($data['nilon']);
            }
    
            if (!empty($data['elevate'])) {
                $data_action['elevate'] = $this->configDataStage($data['elevate']);
            }
    
            if (!empty($data['peel'])) {
                $data_action['peel'] = $this->configDataStage($data['peel']);
            }
            
            if (!empty($data['box_paste'])) {
                $data_action['box_paste'] = $this->configDataStage($data['box_paste']);
            }
            
            if (!empty($data['metalai'])) {
                $data_action['metalai'] = $this->configDataStage($data['metalai']);
            }
            
            if (!empty($data['compress'])) {
                $data_action['compress'] = $this->configDataCompressFloat($data['compress']);
            }
            if (!empty($data['float'])) {
                $data_action['float'] = $this->configDataCompressFloat($data['float']);
            }
            
            if (!empty($data['uv'])) {
                $data_action['uv'] = $this->configDataStage($data['uv']);
            }
            
            if (!empty($data['ext_price'])) {
                $data_action['ext_price'] = $this->configDataExtPrice($data['ext_price']);
            }
    
            if (!empty($data['cut'])) {
                $data_action['cut'] = $this->configDataStage($data['cut']);
            }
    
            if (!empty($data['fold'])) {
                $data_action['fold'] = $this->configDataStage($data['fold']);
            }

            if (!empty($data['bag_paste'])) {
                $data_action['bag_paste'] = $this->configDataStage($data['bag_paste']);
            }
            
            $data_action['total_cost'] = $this->priceCaculatedByArray($data_action);    
        }else{
            $data_action['total_cost'] = 0;    
        }
        return $data_action;
    }
}