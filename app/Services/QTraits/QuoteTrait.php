<?php
namespace App\Services\QTraits;

trait QuoteTrait
{

    private function configDatSizePaperHard($length, $width, $paper, $qty)
    {
        $quantative_id = @$paper['quantative']?(int)$paper['quantative']:0;
        $quantative = getDetailDataByID('QSupplyPrice', $quantative_id);
        $quantative_price = @$quantative['price']?$quantative['price']:0;
        $qty_paper = $qty+(int)getDataConfigs('QConfig', 'PLUS_CARTON');
        //Công thức tính chi phí khổ giấy vật tư hộp cứng: Dài x Rộng x ĐG định lượng x SL vật tư
        $total = $length*$width*$quantative_price*$qty_paper;
        $paper['act'] = $total>0?1:0;
        return $this->getObjectConfig($paper, $total);
    }

    private function configDataHardPrice($num1, $num2, $plus, $num3, $data)
    {
        //CT tính chi phí số lỗ vật tư lụa: ((số lỗ sp(num1) x ĐG lượt số lỗ lụa(num2)) + ĐG cộng số lỗ lụa(plus)) x SL vật tư(num3)
        //CT tính chi phí bồi: ĐG bồi(num1) x SL sản phẩm(num2)
        //CT tính chi phí hoàn thiện: ĐG hoàn thiện(num1) x SL sản phẩm(num2)
        $total = (($num1*$num2)+$plus)*$num3;
        $data['act'] = $total>0?1:0;
        return $this->getObjectConfig($data, $total);
    }

    private function getObjectConfig($data, $total, $float = 0)
    {
        if (!empty($data['act']) && $total > 0) {
            $obj = $data;
            $obj['total'] = $total;    
        }else{
            $obj['act'] = 0;
        }
        return json_encode($obj);
    }

	private function configDataStage($qty_pro, $n_qty, $data, $length = 0, $width = 0, $table = '', $type = 0){
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
        }elseif($key_device=='milling'){
            if (@$table == 'q_cartons') {
                $foams = getDetailDataByID('QSupply', $type);
                $factor = @$foams['factor']?$foams['factor']:1;
            }else {
                $factor = 1;
            }
            $total = ($qty_pro*$work_price+$shape_price)*$factor;
            $obj = $this->getObjectConfig($data, $total);
        }else{
            if (@$table == 'q_cartons') {
                $work_price = $work_price+(float)getDataConfigs('QConfig', 'PEEL_CARTON_PLUS');
            }elseif (@$table == 'q_foams') {
                $work_price = $work_price+(float)getDataConfigs('QConfig', 'PEEL_FOAM_PLUS');
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