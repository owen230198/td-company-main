<?php
namespace App\Services\Traits;

trait QuoteTrait
{
	public function configDataStage($qty_pro, $n_qty, $data, $length = 0, $width = 0){
        $device_id = @$data['device']?(int)$data['device']:0;
        $device = getDetailDataByID('QDevice', $device_id);
        $model_price = @$data['model_price']?(float)$data['model_price']:0;
        $work_price = @$device['work_price']?(float)$device['work_price']:0;
        $shape_price = @$device['shape_price']?(float)$device['shape_price']:0;
        $key_device = @$device['key_device']?$device['key_device']:'';
        $qty_paper = ceil($qty_pro/$n_qty);
        if ($key_device == 'skin') {
        	$plus_paper_device = (int)getDataConfigs('QConfig', 'PLUS_PAPER_DEVICE');
        	$qty_paper = ceil($qty_pro/$n_qty)+$plus_paper_device;
        	$obj = $this->configDataSkin($qty_paper, $length, $width, $shape_price, $data);
        }elseif ($key_device == 'uv') {
        	$obj = $this->configDataUv($qty_paper, $work_price, $shape_price, $data);	
        }elseif ($key_device == 'elevate') {
            $total = $qty_paper*$work_price+($device_price+$model_price);    
        }elseif($key==7){
            $model_price = isset($group_price['model_price'])?$group_price['model_price']:0;
            if (isset($data['type'])&&$data['type']==1) {
                $work_price = $work_price+5;
            }elseif (isset($data['type'])&&$data['type']==2) {
                $work_price = $work_price+10;
            }
            $total = $qty_pro*$work_price+$device_price;
        }elseif($key==9){
            $model_price = isset($group_price['model_price'])?$group_price['model_price']:0;
            if (isset($data['type'])&&$data['type']==1) {
                $foams = getDetailTableById('carton_foams', $data['name']);
                $factor = isset($foams['factor'])?$foams['factor']:1;    
            }else {
                $factor = 1;
            }
            $total = ($qty_pro*$work_price+$device_price)*$factor;
        }else{
            $model_price = isset($group_price['model_price'])?$group_price['model_price']:0;
            $factor = 1;
            $total = $qty_pro*$work_price+$device_price;     
        }
        return json_encode($obj);    
    }
}