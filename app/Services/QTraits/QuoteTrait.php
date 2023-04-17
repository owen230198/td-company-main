<?php
namespace App\Services\QTraits;

use App\Constants\TDConstant;

trait QuoteTrait
{
    static $plus_paper_device = TDConstant::PLUS_PAPER_DEVICE;
    static $plus_compen_perc = TDConstant::COMPEN_PERCENT;
    static $base_qty_pro = 0;
    static $qty_pro = 0;
    static $nqty = 1;
    static $base_qty_paper = 0;
    static $qty_paper = 0;
    static $length = 0;
    static $width = 0;

    private function newObjectSetProperty($data)
    {
        static::$base_qty_pro = !empty($data['qty']) ? (int) $data['qty'] : 0;
        static::$qty_pro = ceil(calValuePercentPlus(self::$base_qty_pro, self::$base_qty_pro, self::$plus_compen_perc)); 
        static::$nqty = !empty($data['nqty']) ? (int) $data['nqty'] : 1;
        static::$base_qty_paper = !empty($data['paper_qty']) ? (int) $data['paper_qty'] : 0;
        static::$qty_paper = ceil(calValuePercentPlus(self::$base_qty_paper, self::$base_qty_paper, self::$plus_compen_perc)); 
        $length = !empty($data['size']['length']) ? $data['size']['length'] : 0;
        $width = !empty($data['size']['width']) ? $data['size']['width'] : 0;
        convertCmToMeter($length, $width);
        static::$length = $length;
        static::$width = $width;
    }
    private function configDatSizePaperHard($length, $width, $paper, $qty)
    {
        $quantative_id = @$paper['quantative']?(int)$paper['quantative']:0;
        $quantative = getDetailDataByID('QSupplyPrice', $quantative_id);
        $quantative_price = @$quantative['price']?$quantative['price']:0;
        $qty_paper = $qty+(int)getDataConfigs('QConfig', 'PLUS_CARTON');
        //Công thức tính chi phí khổ giấy vật tư hộp cứng: Dài x Rộng x ĐG định lượng x SL vật tư
        $total = $length * $width * $quantative_price * $qty_paper;
        return $this->getObjectConfig($paper, $total);
    }

    private function configDataElevate($model_price, $work_price, $shape_price, $elevate)
    {
        $ext_price = !empty($elevate['ext_price']) ? (float) $elevate['ext_price'] : 0;
        $cost = $this->getBaseTotalStage(self::$qty_paper, $model_price, $work_price, $shape_price);
        $float_cost = !empty($elevate['float']) ? $this->configDataCompressFloat($elevate, true) : 0;
        $total = $cost + $float_cost + $ext_price;
        return $this->getObjectConfig($elevate, $total);
    }

    private function configDataByOnlyDevice($model_price, $work_price, $shape_price, $peel)
    {
        $nqty = !empty($data['nqty']) ? (int) $data['nqty'] : 1;
        $total = $this->getBaseTotalStage(self::$qty_pro, $model_price, $work_price, $shape_price, 0, $nqty);
        return $this->getObjectConfig($peel, $total);
    }

    private function getObjectConfig($data, $total)
    {
        if ($total > 0) {
            $obj = $data;
            $obj['act'] = 1;
            $obj['total'] = $total;    
        }else{
            $obj['act'] = 0;
        }
        return json_encode($obj);
    }

    private function getBaseTotalStage($qty, $model_price, $work_price, $shape_price, $materal_cost = 0, $factor = 1, $plus_qty = 0)
    {
        // CPVTK: D x R x DGL (1)
        $a = self::$length * self::$width * $model_price;

        // DGVT: D x R x DGVT x (SL tờ in - sp + BH %) x hệ số (2)
        $b = self::$length * self::$width * $materal_cost * ($qty + $plus_qty) * $factor;

        // DGL = (SL tờ in hoặc SL sản phẩm + BH %) x DGL x hệ số (3)
        $c = $qty * $work_price * $factor;
        
        // Tổng chi phí  = (1) + (2) + ĐGCM + (3);
        return $a + $b + $shape_price + $c;
    }

	private function configDataStage($data){
        $device_id = !empty($data['machine']) ? (int)$data['machine'] : 0;
        $device = getDetailDataByID('Device', $device_id);
        $model_price = !empty($data['model_price']) ? (float) $data['model_price'] : 0;
        $work_price = !empty($device['work_price']) ? (float) $device['work_price'] : 0;
        $shape_price = !empty($device['shape_price']) ? (float) $device['shape_price'] : 0;
        $key_device = !empty($device['key_device']) ? $device['key_device'] : '';
        if (empty($key_device)) {
            return $this->createNonActiveObj();    
        }
        if (in_array($key_device, [TDConstant::NILON, TDConstant::UV])) {
            //Tính chi phí cán nilon
        	$obj = $this->configDataUVNAndNilon($model_price, $work_price, $shape_price, $data);
        }elseif ($key_device == TDConstant::METALAI){
            //Tính chi phí cán metalai
            $obj = $this->configDataMetalai($model_price, $work_price, $shape_price, $data);
        }elseif ($key_device == TDConstant::ELEVATE){
            //Tính chi phí máy bế
            $obj = $this->configDataElevate($model_price, $work_price, $shape_price, $data);
        }else{
            //Tính chi phí bóc lề, dán hộp, máy phay
            $obj = $this->configDataByOnlyDevice($model_price, $work_price, $shape_price, $data);        
        }
        return $obj;    
    }

    private function getPriterDevice($device)
    {
        $ex_length = self::$length*100;
        $ex_width = self::$width*100;
        $printer = \App\Models\Printer::where('device', $device)
        ->where('print_length', '>=', $ex_length)
        ->where('print_width','>=', $ex_width)->orderBy('print_length', 'asc')->first();
        return $printer;
    }

    private function getPriceMateralQuote($id)
    {
        $materal = \App\Models\Materal::find($id);
        return !empty($materal['price'])? (float) $materal['price'] : 0;
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
        if (!empty($arr)) {
            foreach ($arr as $value) {
                $stage = json_decode($value);
                if (!empty($stage->total)) {
                    $ret += $stage->total;
                }
            }
        }
        return $ret;
    }

    private function getPriceOnlyPro($table, $id){
        $models = getModelByTable($table);
        $data = $models->find($id);
        $total = $this->priceCaculatedByArray($data);
        return $total;
    }
}