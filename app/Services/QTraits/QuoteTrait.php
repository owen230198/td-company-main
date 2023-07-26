<?php
namespace App\Services\QTraits;

use App\Constants\TDConstant;

trait QuoteTrait
{
    static $base_qty_pro = 0;
    static $qty_pro = 0;
    static $nqty = 1;
    static $base_qty_paper = 0;
    static $qty_paper = 0;
    static $base_supp_qty = 0;
    static $supp_qty = 0;
    static $length = 0;
    static $width = 0;

    private function newObjectSetProperty($data)
    {
        $plus_compen_perc = (float) getDataConfig('QuoteConfig', 'COMPEN_PERCENT_PRO');
        static::$base_qty_pro = !empty($data['qty']) ? (int) $data['qty'] : 0;
        static::$qty_pro = ceil(calValuePercentPlus(self::$base_qty_pro, self::$base_qty_pro, $plus_compen_perc)); 
        static::$nqty = !empty($data['nqty']) ? (int) $data['nqty'] : 1;
        static::$base_supp_qty = !empty($data['supp_qty']) ? (int) $data['supp_qty'] : 0;
        $length = !empty($data['size']['length']) ? $data['size']['length'] : 0;
        $width = !empty($data['size']['width']) ? $data['size']['width'] : 0;
        convertCmToMeter($length, $width);
        static::$length = $length;
        static::$width = $width;
    }
    private function configDataSupplySize($supply)
    {
        $qttv_id = !empty($supply['supply_price']) ? $supply['supply_price'] : 0;
        $qttv = getDetailDataByID('SupplyPrice', $qttv_id);
        $qttv_price = !empty($qttv['price']) ? (float) $qttv['price'] : 0;
        //Công thức tính chi phí khổ giấy vật tư hộp cứng: Dài x Rộng x ĐG định lượng x SL vật tư
        $total = self::$length * self::$width * $qttv_price * self::$supp_qty;
        if (!empty($supply['prescript_price'])) {
            $total = $total + ((float) $supply['prescript_price'] * self::$supp_qty);
        }
        $supply['qttv_price'] = $qttv_price;
        $supply['supp_qty'] = self::$supp_qty;
        return $this->getObjectConfig($supply, $total);
    }

    private function configDataElevate($model_price, $work_price, $shape_price, $elevate)
    {
        $ext_price = !empty($elevate['ext_price']) ? (float) $elevate['ext_price'] : 0;
        $cost = $this->getBaseTotalStage(self::$supp_qty, $model_price, $work_price, $shape_price);
        $float_cost = !empty($elevate['float']) ? $this->configDataCompressFloat($elevate['float'], true) : 0;
        if ($float_cost > 0) {
            $elevate['float']['qty_pro'] = self::$qty_pro;
            $elevate['float']['nqty'] = self::$nqty;
            $elevate['float']['float_cost'] = $float_cost;
        }else{
            unset($elevate['float']);
        }
        $elevate['supp_qty'] = self::$supp_qty;
        $elevate['cost'] = $cost;
        $total = $cost + $float_cost + $ext_price;
        return $this->getObjectConfig($elevate, $total);
    }

    private function configDataByOnlyDevice($model_price, $work_price, $shape_price, $data)
    {
        $nqty = !empty($data['nqty']) ? (int) $data['nqty'] : 1;
        $data['qty_pro'] = self::$qty_pro;
        if ($nqty > 1) {
            $data['nqty'] = $nqty;
        }
        $total = $this->getBaseTotalStage(self::$qty_pro, $model_price, $work_price, $shape_price, 0, $nqty);
        return $this->getObjectConfig($data, $total);
    }

    private function getObjectConfig($data, $total)
    {
        $obj = $data;
        $obj['act'] = $total > 0 ? 1 : 0;
        $obj['total'] = $total; 
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
        $model_price = !empty($device['model_price']) ? (float) $device['model_price'] : 0;
        $work_price = !empty($device['work_price']) ? (float) $device['work_price'] : 0;
        $shape_price = !empty($device['shape_price']) ? (float) $device['shape_price'] : 0;
        $key_device = !empty($device['key_device']) ? $device['key_device'] : '';
        $data['model_price'] = $model_price;
        $data['work_price'] = $work_price;
        $data['shape_price'] = $shape_price;
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
        }elseif ($key_device == TDConstant::CUT){
            //Tính chi phí máy xén
            $obj = $this->configDataCut($model_price, $work_price, $shape_price, $data);
        }elseif ($key_device == TDConstant::FILL){
            //Tính chi phí bồi
            $obj = $this->configDataFill($work_price, $shape_price, $data);
        }else{
            //Tính chi phí bóc lề, dán hộp, máy phay, máy gấp vạch
            $obj = $this->configDataByOnlyDevice($model_price, $work_price, $shape_price, $data);        
        }
        return $obj;    
    }

    private function getPriterDevice($device)
    {
        $ex_length = self::$length;
        $ex_width = self::$width;
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
                if (!empty($stage->total) && $stage->total > 0) {
                    $ret += $stage->total;
                }
            }
        }
        return (string) $ret;
    }
}