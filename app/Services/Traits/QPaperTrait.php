<?php  
namespace App\Services\Traits;
trait QPaperTrait
{
	private function configDataSizePaper($qty_paper, $length, $width, $paper)
	{
        $quantitative = @$paper['quantitative']?(float)$paper['quantitative']:0;
        $price = @$paper['unit_price']?(float)$paper['unit_price']:0;
        $plusPaper = (int)getDataConfigs('QConfig', 'PLUS_PAPER');
        $qty_paper = $qty_paper+$plusPaper; 
        // Công thức tính chi phí khổ in : dài x rộng x định lượng x (số tờ in + 100) x ĐG
        $total = $length*$width*$quantitative*$qty_paper*$price;
        $paper['act'] = $total>0?1:0;
        $obj = $this->getObjectConfig($paper, $total);
        return $obj;
	}

	private function configDataPrint($qty_pro, $n_qty, $length, $width, $print)
	{
		$color_num = @$print['color_num']?(int)$print['color_num']:0;
        $style = @$print['style']?$print['style']:0;
        $device_id = $print['device']?$print['device']:0;
        $subtract_paper = (int)getDataConfigs('QConfig', 'MIN_VALID_PAPER');
        $plus_paper_device = (int)getDataConfigs('QConfig', 'PLUS_PAPER_DEVICE');
        $qty_paper = ceil($qty_pro/$n_qty)-$subtract_paper+$plus_paper_device;
        $device = getPriterDevice($length, $width, $device_id);
        $model_price = @$device['model_price']?(int)$device['model_price']:0;
        $work_price = @$device['work_price']?(int)$device['work_price']:0;
        $shape_price = @$device['shape_price']?(int)$device['shape_price']:0;
        if ($style == 1) {
            $factor = 1;
            // Công thức tính chi phí in một mặt: (SL tờ in + tờ cộng thêm khi in) x số màu x DG lượt + (ĐG chỉnh máy x số màu) + (ĐG khuôn mẫu x số màu)
            $total = ($qty_paper)*$color_num*$work_price+($shape_price*$color_num)+($model_price*$color_num);
        }else{
            $factor = 2;
            // Công thức tính chi phí các kiểu in còn lại: (SL tờ in + tờ cộng thêm khi in) x số màu x 2 x DG lượt + ĐG chỉnh máy + ĐG khuôn mẫu
            $total = ($qty_paper)*$color_num*2*$work_price+$shape_price+$model_price;
        }
        $obj = $this->getObjectConfig($print, $total);
        return $obj;	
	}

    private function configDataSkin($qty_paper, $length, $width, $shape_price, $skin)
    {
    	$materal_id = @$skin['materal']?$skin['materal']:0;
        $materal_cost = $materal_id=='other'&&@$skin['materal_price']?(int)$skin['materal_price']:getPriceMateralQuote($materal_id);
        $num_face = @$skin['num_face']?(int)$skin['num_face']:0;
        // Công thức tính chi phí Cán láng: dài x rộng x ĐG chất liệu x (SL tờ in + tờ cộng thêm) x số mặt + ĐG chỉnh máy
        $total = $length*$width*$materal_cost*$qty_paper*$num_face+$shape_price;
        $obj = $this->getObjectConfig($skin, $total);
        return $obj;
    }

    private function configDataMetalai($qty_paper, $length, $width, $metalai)
    {
        $materal_id = @$metalai['materal']?$metalai['materal']:0;
        $materal_cost = $materal_id=='other'&&@$metalai['materal_price']?(int)$metalai['materal_price']:getPriceMateralQuote($materal_id);
        $num_face = @$metalai['num_face']?(int)$metalai['num_face']:0;
        $cover_materal_id = @$metalai['cover_materal']?$metalai['cover_materal']:0;
        $cover_materal_cost = $cover_materal_id=='other'&&@$metalai['cover_materal_price']?(int)$metalai['cover_materal_price']:getPriceMateralQuote($cover_materal_id);
        $cover_num_face = @$metalai['cover_num_face']?(int)$metalai['cover_num_face']:0;
        $plus_paper = (int)getDataConfigs('QConfig', 'PLUS_PAPER');
        $qty_paper = $qty_paper+$plus_paper;
        // Công thức tính chi phí cán metalai: dài x rộng x ĐG chất liệu x (SL tờ in + tờ cộng thêm) x số mặt
        $total_metalai = $length*$width*$materal_cost*$qty_paper*$num_face;
        // Công thức tính chi phí cán phủ trên: dài x rộng x ĐG chất liệu x (SL tờ in + tờ cộng thêm) x số mặt
        $total_cover = $length*$width*$cover_materal_cost*$qty_paper*$cover_num_face;
        // Công thức tính chi phí cán metalai : chi phí cán metalai + chi phí cán phủ trên
        $total = $total_metalai + $total_cover;
        $obj = $this->getObjectConfig($metalai, $total);
        return $obj;
    }

    private function configDataCompress($qty_pro, $n_qty, $compress)
    {
        $price = @$compress['price']?(float)$compress['price']:0;
        $shape_price = @$compress['shape']?(float)$compress['shape']:0;
        $device = @$compress['device']?$compress['device']:0;
        $obj = new \stdClass();
        // Công thức tính chi phí ép nhũ: (SL sản phẩm x Giá tiền/sp) + (Số bát x Giá khuôn)
        $total = ($qty_pro*$price)+($shape_price*$n_qty);
        $obj = $this->getObjectConfig($compress, $total);
        return $obj;
    }

    private function configDataUv($qty_paper, $work_price, $shape_price, $uv)
    {
        $num_face = @$uv['num_face']?(int)$uv['num_face']:0;
        // Công thức tính chi phí in uv: (SL tờ in x ĐG lượt + ĐG chỉnh máy) x Số mặt in;
        $total = ($qty_paper*$work_price+$shape_price)*$num_face;
        $obj = $this->getObjectConfig($uv, $total);
        return $obj;
    }

    private function configDataPlus($qty_pro, $plus)
    {
        // Công thức tính chi phí phát sinh: SL sản phẩm x giá phát sinh/sản phẩm;
        $price = @$plus['price']?(float)$plus['price']:0;
        $total = $qty_pro*$price;
        $obj = $this->getObjectConfig($plus, $total);
        return $obj;
    }

    private function getDataActionQPaper($data)
    {
        $length = @$data['length']?$data['length']:0;
        $width = @$data['width']?$data['width']:0;
        $qty_paper = @$data['qty_paper']?(int)$data['qty_paper']:0;
        $qty_pro = @$data['qty_pro']?(int)$data['qty_pro']:0;
        $n_qty = @$data['n_qty']?(int)$data['n_qty']:1;
        $dataAction = $data;
        $dataAction['design_model'] = json_encode($data['design_model']);
        $dataAction['paper_size'] = $this->configDataSizePaper($qty_paper, $length, $width, $data['paper_size']);
        $dataAction['paper_size'] = $this->configDataSizePaper($qty_paper, $length, $width, $data['paper_size']);
        $dataAction['print'] = $this->configDataPrint($qty_pro, $n_qty, $length, $width, $data['print']);
        $dataAction['skin'] = $this->configDataStage($qty_pro, $n_qty, $data['skin'], $length, $width);
        $dataAction['metalai'] = $this->configDataMetalai($qty_paper, $length, $width, $data['metalai']);
        $dataAction['compress'] = $this->configDataCompress($qty_pro, $n_qty, $data['compress']);
        $dataAction['uv'] = $this->configDataStage($qty_pro, $n_qty, $data['uv']);
        $dataAction['elevate'] = $this->configDataStage($qty_pro, $n_qty, $data['elevate']);
        $dataAction['peel'] = $this->configDataStage($qty_pro, $n_qty, $data['peel']);
        $dataAction['paste'] = $this->configDataStage($qty_pro, $n_qty, $data['paste']);
        $dataAction['plus'] = $this->configDataPlus($qty_pro, $data['plus']);
        $dataAction['total_cost'] = priceCaculatedByArray($dataAction);
        return $dataAction;
    }
}