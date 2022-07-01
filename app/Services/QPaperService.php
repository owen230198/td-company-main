<?php 
namespace App\Services;
use App\Services\BaseService;

class QPaperService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}

	public function insert($data, $quote_id){
		$dataAction = $data;
		$length = @$data['length']?$data['length']:0;
		$width = @$data['width']?$data['width']:0;
		$qty_paper = @$data['qty_paper']?(int)$data['qty_paper']:0;
		$qty_pro = @$data['qty_pro']?(int)$data['qty_pro']:0;
		$n_qty = @$data['n_qty']?(int)$data['n_qty']:0;
		$dataAction['paper_size'] = $this->configDataSizePaper($qty_paper, $length, $width, $data['paper_size']);
		$dataAction['print'] = $this->configDataPrint($qty_pro, $n_qty, $length, $width, $data['print']);
		var_dump($dataAction['paper_size']); die();
	}

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
        $device = $print['device']?$print['device']:0;
        $obj = new \stdClass();
        $subtract_paper = (int)getDataConfigs('QConfig', 'MIN_VALID_PAPER');
        $qty_paper = ceil($qty_pro/$n_qty)-$subtract_paper;
        $device = getPriterDevice($length, $width, $device);
        $model_price = @$device['model_price']?(int)$device['model_price']:0;
        $work_price = @$device['work_price']?(int)$device['work_price']:0;
        $shape_price = @$device['shape_price']?(int)$device['shape_price']:0;
        if ($style == 1) {
            $factor = 1;
            // Công thức tính chi phí in một mặt (SL tờ in + tờ cộng thêm khi in) x số màu x DG lượt + (ĐG chỉnh máy x số màu) + (ĐG khuôn mẫu x số màu)
            $total = ($qty_paper+30)*$color_num*$work_price+($shape_price*$color_num)+($model_price*$color_num);
        }else{
            $factor = 2;
            // Công thức tính chi phí các kiểu in còn lại (SL tờ in + tờ cộng thêm khi in) x số màu x 2 x DG lượt + ĐG chỉnh máy + ĐG khuôn mẫu
            $total = ($qty_paper+30)*$color_num*2*$work_price+$shape_price+$model_price;
        }
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
        dd($obj);
        return json_encode($obj);	
	}
}