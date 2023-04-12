<?php  
namespace App\Services\QTraits;
use App\Constants\TDConstant;
trait QPaperTrait
{
	private function configDataSizePaper($qty_paper, $length, $width, $paper)
	{
        $qttv = !empty($paper['qttv']) ? (float) $paper['qttv'] : 0;
        $price = !empty($paper['materal']) ? ((int) getFieldDataById('unit_price', 'paper_materals', $paper['materal'])) : 
                (!empty($paper['unit_price']) ? (float) $paper['unit_price'] : 0);
        $plus_paper = (int) TDConstant::PLUS_PAPER;
        $plus_paper_perc = (int) TDConstant::COMPEN_PERCENT;
        $qty_paper = calValuePercent($qty_paper, $qty_paper, $plus_paper_perc, $plus_paper); 
        // Công thức tính chi phí khổ in : dài x rộng x định lượng x (số tờ in + 100) x ĐG
        $total = $length*$width*$qttv*$qty_paper*$price;
        $paper['act'] = $total > 0 ? 1 : 0;
        $obj = $this->getObjectConfig($paper, $total);
        return $obj;
	}

	private function configDataPrint($qty_pro, $n_qty, $length, $width, $print)
	{
		$color = !empty($print['color']) ? $print['color'] : 0;
        $type = !empty($print['type']) ? $print['type'] : 0;
        $device_id = !empty($print['machine']) ? $print['machine'] : 0;
        $subtract_paper = TDConstant::PRINT_SUBTRACT_PAPER;
        $plus_paper_device = TDConstant::PLUS_PAPER_DEVICE;
        $qty_paper = ceil($qty_pro/$n_qty)-$subtract_paper+$plus_paper_device;
        $device = $this->getPriterDevice($length, $width, $device_id);
        $model_price = !empty($device['model_price']) ? (int) $device['model_price'] : 0;
        $work_price = !empty($device['work_price']) ? (int) $device['work_price'] : 0;
        $shape_price = !empty($device['shape_price']) ? (int) $device['shape_price'] : 0;
        if ($color == TDConstant::APLA_PRINT_COLOR) {
            $apla_factor = TDConstant::APLA_PRICE_FACTOR;
            $apla_plus = TDConstant::APLA_PRICE_PLUS;
            $print_factor = $type == TDConstant::ONE_PRINT_TYPE ? 1 : 2;
            $apla_price = $length*$width*$apla_factor*$print_factor;
            $total = ($qty_paper*$apla_price)+$apla_plus;
        }else{
            $color_num = (int) $color;
            if ($type == TDConstant::ONE_PRINT_TYPE) {
                // Công thức tính chi phí in một mặt: (SL tờ in + tờ cộng thêm khi in) x số màu x DG lượt + (ĐG chỉnh máy x số màu) + (ĐG khuôn mẫu x số màu)
                $total = ($qty_paper)*$color_num*$work_price+($shape_price*$color_num)+($model_price*$color_num);
            }else{
                // Công thức tính chi phí các kiểu in còn lại: (SL tờ in + tờ cộng thêm khi in) x số màu x 2 x DG lượt + ĐG chỉnh máy + ĐG khuôn mẫu
                $total = ($qty_paper)*$color_num*2*$work_price+$shape_price+$model_price;
            }
        }
        $obj = $this->getObjectConfig($print, $total);
        return $obj;	
	}

    private function configDataNilon($qty_paper, $length, $width, $shape_price, $work_price, $nilon)
    {
    	$materal_id = !empty($nilon['materal']) ? $nilon['materal'] : 0;
        $materal_cost = $this->getPriceMateralQuote($materal_id);
        $num_face = !empty($nilon['face']) ? (int)$nilon['face'] : 0;
        $total = $this->getBaseTotalStage($qty_paper + $work_price, $shape_price, $length, $width, $materal_cost, $num_face);
        // $total = $length*$width*$materal_cost*$qty_paper*$num_face+$shape_price;
        $obj = $this->getObjectConfig($nilon, $total);
        return $obj;
    }

    private function configDataMetalai($qty_paper, $length, $width, $shape_price, $work_price, $metalai)
    {
        $materal_id = !empty($metalai['materal']) ? $metalai['materal'] : 0;
        $materal_cost = $this->getPriceMateralQuote($materal_id);
        $num_face = !empty($metalai['face']) ? (int) $metalai['face'] : 0;
        $total_metalai = $this->getBaseTotalStage($qty_paper + $work_price, $shape_price, $length, $width, $materal_cost, $num_face);
        // $total_metalai = $length*$width*$materal_cost*$qty_paper*$num_face;

        $cover_materal_id = !empty($metalai['cover_materal']) ? $metalai['cover_materal'] : 0;
        $cover_materal_cost = $this->getPriceMateralQuote($cover_materal_id);
        $cover_num_face = !empty($metalai['cover_face']) ? (int) $metalai['cover_face'] : 0;
        $total_cover = $this->getBaseTotalStage($qty_paper + $work_price, $shape_price, $length, $width, $cover_materal_cost, $cover_num_face);
        // $total_cover = $length*$width*$cover_materal_cost*$qty_paper*$cover_num_face;

        // Công thức tính chi phí cán metalai : chi phí cán metalai + chi phí cán phủ trên
        $total = $total_metalai + $total_cover;
        $obj = $this->getObjectConfig($metalai, $total);
        return $obj;
    }

    private function configDataCompress($qty_pro, $n_qty, $compress)
    {
        $price = !empty($compress['price']) ? (float)$compress['price'] : 0;
        $shape_price = !empty($compress['shape_price']) ? (float) $compress['shape_price'] : 0;
        $obj = new \stdClass();
        // Công thức tính chi phí ép nhũ: (SL sản phẩm x Giá tiền/sp) + (Số bát x Giá khuôn)
        $total = ($qty_pro*$price)+($shape_price*$n_qty);
        $obj = $this->getObjectConfig($compress, $total);
        return $obj;
    }

    private function configDataUv($qty_paper, $work_price, $shape_price, $uv)
    {
        $num_face = !empty($uv['face']) ? (int) $uv['face']:0;
        // Công thức tính chi phí in uv: (SL tờ in x ĐG lượt + ĐG chỉnh máy) x Số mặt in;
        $total = ($qty_paper*$work_price+$shape_price)*$num_face;
        $obj = $this->getObjectConfig($uv, $total);
        return $obj;
    }

    private function configDataPlus($qty_pro, $plus)
    {
        // Công thức tính chi phí phát sinh: SL sản phẩm x giá phát sinh/sản phẩm;
        $temp_price = !empty($plus['temp_price']) ? (float) $plus['temp_price'] : 0;
        $pre_price = !empty($plus['prescript_price']) ? (float) $plus['prescript_price'] : 0;
        $supp_price = !empty($plus['supp_price']) ? (float) $plus['supp_price'] : 0;
        $total = $qty_pro*($temp_price + $pre_price + $supp_price);
        $obj = $this->getObjectConfig($plus, $total);
        return $obj;
    }

    private function getDataActionPaper($data)
    {
        $length = !empty($data['size']['length']) ? $data['size']['length'] : 0;
        $width = !empty($data['size']['width']) ? $data['size']['width'] : 0;
        convertCmToMeter($length, $width);
        $qty_paper = !empty($data['paper_qty']) ? (int) $data['paper_qty'] : 0;
        $qty_pro = !empty($data['qty']) ? (int) $data['qty'] : 0;
        $n_qty = !empty($data['n_qty']) ? (int) $data['n_qty'] : 1;
        $data_action['size'] = $this->configDataSizePaper($qty_paper, $length, $width, $data['size']);
        $data_action['print'] = $this->configDataPrint($qty_pro, $n_qty, $length, $width, $data['print']);
        $data_action['nilon'] = $this->configDataStage($data['nilon'], $qty_pro, $n_qty, $length, $width);
        $data_action['elevate'] = $this->configDataStage($qty_pro, $n_qty, $data['elevate'], $length, $width);
        $data_action['peel'] = $this->configDataStage($qty_pro, $n_qty, $data['peel'], $length, $width);
        $data_action['box_paste'] = $this->configDataStage($qty_pro, $n_qty, $data['box_paste'], $length, $width);
        $data_action['metalai'] = $this->configDataStage($qty_pro,$n_qty, $data['metalai'], $length, $width);
        $data_action['compress'] = $this->configDataCompress($qty_pro, $n_qty, $data['compress'], $length, $width);
        $data_action['uv'] = $this->configDataStage($qty_pro, $n_qty, $data['uv'], $length, $width);
        $data_action['ext_price'] = $this->configDataPlus($qty_pro, $data['ext_price']);
        $data_action['total_cost'] = $this->priceCaculatedByArray($data_action);
        return $data_action;
    }
}