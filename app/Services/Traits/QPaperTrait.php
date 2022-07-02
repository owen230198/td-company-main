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
        $obj = new \stdClass();
        if ($total>0) {
            $obj->act= 1;
            $obj->length= $length;
            $obj->width = $width;
            $obj->quantitative = $quantitative;
            $obj->price = $price;
            $obj->total = (int)$total;
        }else{
            $obj->act= 0;    
        }
        return json_encode($obj);
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
        $obj = new \stdClass();
        if (@$print['act']&&$total>0) {
            $obj->act= 1;
            $obj->color= $color_num;
            $obj->style = $style;
            $obj->model_price = $model_price;
            $obj->work_price = $work_price;
            $obj->shape_price = $shape_price;
            $obj->factor = $factor;
            $obj->device = $device;
            $obj->total = $total;    
        }else{
            $obj->act = 0;
        }
        return json_encode($obj);	
	}

    private function configDataSkin($qty_pro, $n_qty, $length, $width, $skin)
    {
    	$materal_id = @$skin['materal']?$skin['materal']:0;
        $materal_cost = $materal_id=='other'&&@$skin['materal_price']?(int)$skin['materal_price']:getPriceMateralQuote($materal_id);
        $num_face = @$skin['num_face']?(int)$skin['num_face']:0;
        $device_id = @$skin['device']?(int)$skin['device']:0;
        $device = getDetailDataByID('QDevice', $device_id);
        $shape_price = @$device['shape_price']?(int)$device['shape_price']:0;
        $plus_paper_device = (int)getDataConfigs('QConfig', 'PLUS_PAPER_DEVICE');
        $qty_paper = ceil($qty_pro/$n_qty)+$plus_paper_device;
        // Công thức tính chi phí Cán láng: dài x rộng x ĐG chất liệu x (SL tờ in + tờ cộng thêm) x số mặt + ĐG chỉnh máy
        $total = $length*$width*$materal_cost*$qty_paper*$num_face+$shape_price;
        $obj = new \stdClass();
        if (@$skin['act']&&$total>0) {
            $obj->act= 1;
            $obj->materal = $materal_id;
            $obj->materal_cost = $materal_cost;
            $obj->num_face = $num_face;
            $obj->shape_price = $shape_price;
            $obj->device = $device_id;
            $obj->total = $total;    
        }else{
            $obj->act = 0;
        }
        return json_encode($obj);
    }

    public function configDataMetalai($qty_pro, $n_qty, $length, $width, $metalai)
    {
        $materal_id = @$metalai['materal']?$metalai['materal']:0;
        $materal_cost = $materal_id=='other'&&@$metalai['materal_price']?(int)$metalai['materal_price']:getPriceMateralQuote($materal_id);
        $num_face = @$metalai['num_face']?(int)$metalai['num_face']:0;
        $cover_materal_id = @$metalai['cover_materal']?$metalai['cover_materal']:0;
        $cover_materal_cost = $cover_materal_id=='other'&&@$metalai['cover_materal_price']?(int)$metalai['cover_materal_price']:getPriceMateralQuote($cover_materal_id);
        $cover_num_face = @$metalai['cover_num_face']?(int)$metalai['cover_num_face']:0;
        $plus_paper_device = (int)getDataConfigs('QConfig', 'PLUS_PAPER_DEVICE');
        $qty_paper = ceil($qty_pro/$n_qty)+$plus_paper_device;
        // Công thức tính chi phí cán metalai: dài x rộng x ĐG chất liệu x (SL tờ in + tờ cộng thêm) x số mặt
        $total_metalai = $length*$width*$materal_cost*$qty_paper*$num_face;
        // Công thức tính chi phí cán phủ trên: dài x rộng x ĐG chất liệu x (SL tờ in + tờ cộng thêm) x số mặt
        $total_cover = $length*$width*$cover_materal_cost*$qty_paper*$cover_num_face;
        // Công thức tính chi phí cán metalai : chi phí cán metalai + chi phí cán phủ trên
        $total = $total_metalai + $total_cover;
        $obj = new \stdClass();
        if (@$metalai['act']&&$total>0) {
            $obj->act= 1;
            $obj->materal= $materal_id;
            $obj->materal_cost = $materal_cost;
            $obj->num_face = $num_face;
            $obj->cover_materal_id= $cover_materal_id;
            $obj->cover_materal_cost = $cover_materal_cost;
            $obj->cover_num_face = $cover_num_face;
            $obj->total = $total;    
        }else{
            $obj->act = 0;
        }
        return json_encode($obj);
    }
}