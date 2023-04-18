<?php  
namespace App\Services\QTraits;
use App\Constants\TDConstant;
trait QPaperTrait
{
	private function configDataSizePaper($paper)
	{
        $qttv = !empty($paper['qttv']) ? (float) $paper['qttv'] : 0;
        $price = !empty($paper['materal']) ? ((int) getFieldDataById('unit_price', 'paper_materals', $paper['materal'])) : 
                (!empty($paper['unit_price']) ? (float) $paper['unit_price'] : 0);
        $plus_paper = (int) TDConstant::PLUS_PAPER;
        $qty_paper = self::$qty_paper + $plus_paper;
        // Công thức tính chi phí khổ in : dài x rộng x định lượng x (số tờ in + 100) x ĐG
        $total = self::$length * self::$width * $qttv * $qty_paper * $price;
        $obj = $this->getObjectConfig($paper, $total);
        return $obj;
	}

	private function configDataPrint($print)
	{
		$color = !empty($print['color']) ? $print['color'] : 0;
        $type = !empty($print['type']) ? $print['type'] : 0;
        $device_id = !empty($print['machine']) ? $print['machine'] : 0;
        $subtract_paper = TDConstant::PRINT_SUBTRACT_PAPER;
        $qty_paper = self::$base_qty_paper - $subtract_paper + self::$plus_paper_device;
        $device = $this->getPriterDevice($device_id);
        $model_price = !empty($device['model_price']) ? (int) $device['model_price'] : 0;
        $work_price = !empty($device['work_price']) ? (int) $device['work_price'] : 0;
        $shape_price = !empty($device['shape_price']) ? (int) $device['shape_price'] : 0;
        if ($color == TDConstant::APLA_PRINT_COLOR) {
            $apla_factor = TDConstant::APLA_PRICE_FACTOR;
            $apla_plus = TDConstant::APLA_PRICE_PLUS;
            $print_factor = $type == TDConstant::ONE_PRINT_TYPE ? 1 : 2;
            $apla_price = self::$length * self::$width * $apla_factor * $print_factor;
            $total = ($qty_paper * $apla_price) + $apla_plus;
        }else{
            $color_num = (int) $color;
            if ($type == TDConstant::ONE_PRINT_TYPE) {
                // Công thức tính chi phí in một mặt: (SL tờ in + tờ cộng thêm khi in) x số màu x DG lượt + (ĐG chỉnh máy x số màu) + (ĐG khuôn mẫu x số màu)
                $total = ($qty_paper) * $color_num * $work_price + ($shape_price * $color_num) + ($model_price * $color_num);
            }else{
                // Công thức tính chi phí các kiểu in còn lại: (SL tờ in + tờ cộng thêm khi in) x số màu x 2 x DG lượt + ĐG chỉnh máy + ĐG khuôn mẫu
                $total = ($qty_paper) * $color_num * 2 * $work_price + $shape_price + $model_price;
            }
        }
        return $this->getObjectConfig($print, $total);	
	}

    private function configDataUVNAndNilon($model_price, $work_price, $shape_price, $uv_nilon)
    {
    	$materal_id = !empty($uv_nilon['materal']) ? $uv_nilon['materal'] : 0;
        $materal_cost = $this->getPriceMateralQuote($materal_id);
        $num_face = !empty($uv_nilon['face']) ? (int)$uv_nilon['face'] : 0;
        $total = $this->getBaseTotalStage(self::$qty_paper, $model_price, $work_price, $shape_price, $materal_cost, $num_face);
        // $total = $length*$width*$materal_cost*$qty_paper*$num_face+$shape_price;
        return $this->getObjectConfig($uv_nilon, $total);
    }

    private function configDataMetalai($model_price, $work_price, $shape_price, $metalai)
    {
        $materal_id = !empty($metalai['materal']) ? $metalai['materal'] : 0;
        $materal_cost = $this->getPriceMateralQuote($materal_id);
        $num_face = !empty($metalai['face']) ? (int) $metalai['face'] : 0;
        $total_metalai = $this->getBaseTotalStage(self::$qty_paper, $model_price, $work_price, $shape_price, $materal_cost, $num_face, self::$plus_paper_device);
        // $total_metalai = $length*$width*$materal_cost*$qty_paper*$num_face;

        $cover_materal_id = !empty($metalai['cover_materal']) ? $metalai['cover_materal'] : 0;
        $cover_materal_cost = $this->getPriceMateralQuote($cover_materal_id);
        $cover_num_face = !empty($metalai['cover_face']) ? (int) $metalai['cover_face'] : 0;
        $total_cover = $this->getBaseTotalStage(self::$qty_paper, $model_price, $work_price, $shape_price, $cover_materal_cost, $cover_num_face, self::$plus_paper_device);
        // $total_cover = $length*$width*$cover_materal_cost*$qty_paper*$cover_num_face;

        // Công thức tính chi phí cán metalai : chi phí cán metalai + chi phí cán phủ trên
        $total = $total_metalai + $total_cover;
        return $this->getObjectConfig($metalai, $total);
    }

    private function configDataCompressFloat($compress_float, $get_total = false)
    {
        $price = !empty($compress_float['price']) ? (float)$compress_float['price'] : 0;
        $shape_price = !empty($compress_float['shape_price']) ? (float) $compress_float['shape_price'] : 0;
        $total = (self::$qty_pro * $price) + (self::$nqty * $shape_price);
        return !empty($get_total) ? $total : $this->getObjectConfig($compress_float, $total);
    }

    private function configDataExtPrice($plus)
    {
        // Công thức tính chi phí phát sinh: SL sản phẩm x giá phát sinh/sản phẩm;
        $temp_price = !empty($plus['temp_price']) ? (float) $plus['temp_price'] : 0;
        $pre_price = !empty($plus['prescript_price']) ? (float) $plus['prescript_price'] : 0;
        $supp_price = !empty($plus['supp_price']) ? (float) $plus['supp_price'] : 0;
        $total = self::$base_qty_pro * ($temp_price + $pre_price + $supp_price);
        $obj = $this->getObjectConfig($plus, $total);
        return $obj;
    }

    private function getDataActionPaper($data)
    {
        $this->newObjectSetProperty($data);
        static::$base_qty_paper = !empty($data['paper_qty']) ? (int) $data['paper_qty'] : 0;
        static::$qty_paper = ceil(calValuePercentPlus(self::$base_qty_paper, self::$base_qty_paper, self::$plus_compen_perc)); 
        if (!empty($data['size'])) {
            $data_action['size'] = $this->configDataSizePaper($data['size']);
        }

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
        
        $data_action['total_cost'] = $this->priceCaculatedByArray($data_action);

        return $data_action;
    }
}