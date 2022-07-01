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
		$dataAction['print'] = $this->configDataPrint($data);
		var_dump($dataAction['paper_size']); die();
	}

	private function configDataSizePaper($qty_paper, $length, $width, $data)
	{
        $quantitative = @$data['quantitative']?(float)$data['quantitative']:0;
        $price = @$data['unit_price']?(float)$data['unit_price']:0;
        $plusPaper = (int)getDataConfigs('QConfig', 'PLUS_PAPER');
        $qty_paper = $qty_paper+$plusPaper; 
        // Công thức tính chi phí khổ in : dài x rộng x định lượng x (số tờ in + 100) x ĐG; 
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

	private function configDataPrint()
	{
		$print_color = isset($data['print_color'])?$data['print_color']:0;
        $print_style = isset($data['print_style'])?$data['print_style']:0;
        $device = isset($data['offset_device'])?$data['offset_device']:0;
        $qty_paper = ceil($data['qty_pro']/$data['n_qty'])-1000;
        $obj = new \stdClass();
        if ($print_color>0 && $print_style>0 && $device>0 && $qty_paper>1000) {
            $length = isset($data['p_lenght'])?$data['p_lenght']:0;
            $width = isset($data['p_width'])?$data['p_width']:0;
            $group_price = $this->getPriterDevice($length, $width, $device);
            $model_price = isset($group_price['model_price'])?$group_price['model_price']:0;
            $work_price = isset($group_price['work_price'])?$group_price['work_price']:0;
            $shape_price = isset($group_price['shape_price'])?$group_price['shape_price']:0;
            if ($print_style == 1) {
                $factor = 1;
                $total = ($qty_paper+30)*$print_color*$work_price+($shape_price*$print_color)+($model_price*$print_color);
            }else{
                $factor = 2;
                $total = ($qty_paper+30)*$print_color*2*$work_price+$shape_price+$model_price;
            }
            $obj->act= 1;
            $obj->color= $print_color;
            $obj->style = $print_style;
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
}