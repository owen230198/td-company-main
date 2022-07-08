<?php
namespace App\Services\Traits;

trait QuoteTrait
{

    private function getObjectConfig($data, $total, $float = 0)
    {
        if (@$data['act']&&$total>0) {
            $obj = $data;
            if ($float>0) {
                $obj['float'] = $float;    
            }
            $obj['total'] = $total;    
        }else{
            $obj['act'] = 0;
        }
        return json_encode($obj);
    }

	private function configDataStage($qty_pro, $n_qty, $data, $length = 0, $width = 0){
        $device_id = @$data['device']?(int)$data['device']:0;
        $device = getDetailDataByID('QDevice', $device_id);
        $model_price = @$data['model_price']?(float)$data['model_price']:0;
        $work_price = @$device['work_price']?(float)$device['work_price']:0;
        $shape_price = @$device['shape_price']?(float)$device['shape_price']:0;
        $key_device = @$device['key_device']?$device['key_device']:'';
        $qty_paper = ceil($qty_pro/$n_qty);
        if ($key_device == '') {
            return $this->createNonActiveObj();    
        }
        if ($key_device == 'skin') {
        	$plus_paper_device = (int)getDataConfigs('QConfig', 'PLUS_PAPER_DEVICE');
        	$qty_paper = $qty_paper+$plus_paper_device;
        	$obj = $this->configDataSkin($qty_paper, $length, $width, $shape_price, $data);
        }elseif ($key_device == 'uv') {
        	$obj = $this->configDataUv($qty_paper, $work_price, $shape_price, $data);	
        }elseif ($key_device == 'elevate') {
            $float_price = @$data['float']?(float)getDataConfigs('QConfig', 'FLOAT_PRICE'):0;
            //Công thức tính chi phí bế: SL tờ in x ĐG lượt + (ĐG chỉnh máy + ĐG khuôn mẫu)
            $total = (($qty_paper*$work_price)+($shape_price+$model_price))+$float_price;    
            $obj = $this->getObjectConfig($data, $total, $float_price);
        }elseif($key_device==9){
            if (isset($data['type'])&&$data['type']==1) {
                $foams = getDetailTableById('carton_foams', $data['name']);
                $factor = isset($foams['factor'])?$foams['factor']:1;    
            }else {
                $factor = 1;
            }
            $total = ($qty_pro*$work_price+$device_price)*$factor;
        }else{
            if (isset($data['type'])&&$data['type']==1) {
                $work_price = $work_price+(int)getDataConfigs('QConfig', 'PEEL_CARTON_PLUS');
            }elseif (isset($data['type'])&&$data['type']==2) {
                $work_price = $work_price+(int)getDataConfigs('QConfig', 'PEEL_FOAM_PLUS');
            }
            //Công thức tính chi phí bóc lề & dán hộp: SL sản phẩm x ĐG lượt + ĐG chỉnh máy
            $total = $qty_pro*$work_price+$shape_price;
            $obj = $this->getObjectConfig($data, $total);       
        }
        return $obj;    
    }

    private function getPriterDevice($length, $width, $device)
    {
        $ex_length = $length*100;
        $ex_width = $width*100;
        $printers  = new \App\Models\QPrinterDevice;
        $printer = $printers->where('device', $device)
        ->where('print_length', '>=', $ex_length)
        ->where('print_width','>=', $ex_width)->orderBy('print_length', 'asc')->first();
        return $printer;
    }

    private function getPriceMateralQuote($id)
    {
        $materals = new \App\Models\QLaminateMateral;
        $materal = $materals->find($id);
        return isset($materal['price'])?(int)$materal['price']:0;
    }

    private function createNonActiveObj()
    {
        $obj = new \stdClass();
        $obj->act = 0;
        return json_encode($obj);
    }

    private function priceCaculatedByArray($arr)
    {
        $ret = 0;
        if ($arr!=null&&count($arr)>0) {
            foreach ($arr as $key => $value) {
                $stage = json_decode($value);
                if (@$stage->total) {
                    $ret += $stage->total;
                }
            }
        }
        return $ret;
    }

    private function getPriceOnlyPro($table, $id){
        $models = getModelByTable($table);
        $data = $models->find($id);
        $total = priceCaculatedByArray($data);
        return $total;
    }
}