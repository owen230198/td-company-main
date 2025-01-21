<?php
namespace App\Services\QTraits;

use App\Constants\TDConstant;
use App\Models\SupplyPrice;

trait QuoteTrait
{
    static $base_qty_pro = 0;
    static $qty_pro = 0;
    static $nqty = 1;
    static $base_qty_paper = 0;
    static $qty_paper = 0;
    static $base_supp_qty = 0;
    static $supp_qty = 0;
    static $handle_qty = 0;
    static $handle_product = 0;
    static $length = 0;
    static $width = 0;

    private function newObjectSetProperty($data)
    {
        $plus_compen_perc = (float) getDataConfig('QuoteConfig', 'COMPEN_PERCENT_PRO');
        static::$base_qty_pro = !empty($data['qty']) ? (int) $data['qty'] : 0;
        static::$qty_pro = ceil(calValuePercentPlus(self::$base_qty_pro, self::$base_qty_pro, $plus_compen_perc));
        static::$nqty = !empty($data['nqty']) ? (int) $data['nqty'] : 1;
        static::$base_supp_qty = !empty($data['base_supp_qty']) ? (int) $data['base_supp_qty'] : 0;
        static::$supp_qty = !empty($data['supp_qty']) ? (int) $data['supp_qty'] : 0;
        static::$handle_qty = self::$base_supp_qty;
        static::$handle_product =  self::$handle_qty * self::$nqty;
        $length = !empty($data['size']['length']) ? $data['size']['length'] : 0;
        $width = !empty($data['size']['width']) ? $data['size']['width'] : 0;
        convertCmToMeter($length, $width);
        static::$length = $length;
        static::$width = $width;
    }
    private function configDataSupplySize($supply, $type)
    {
        if (@$supply['materal'] == \StatusConst::OTHER) {
            $price = @$supply['unit_price'] ?? 0;
            $qtv_num = @$supply['qtv'] ?? 1;
        }else{
            $qtv_id = @$supply['qtv'] ?? 0;
            $qtv = getDetailDataByID('SupplyPrice', $qtv_id);
            $price = @$qtv['price'] ?? 0;
            $qtv_num = @$qtv['price_purchase'] ?? 1;
        }
        if ($type == \TDConst::PAPER) {
            $plus_paper = getPluspaperNumber();;
            $supp_qty = self::$supp_qty + $plus_paper;
        }else{
            $supp_qty = self::$supp_qty;
        }
        //Công thức tính chi phí khổ giấy vật tư hộp cứng: Dài x Rộng x ĐG x định lượng x SL vật tư
        $total = self::$length * self::$width * $price * $qtv_num * $supp_qty;
        if (!empty($supply['prescript_price'])) {
            $total = $total + ((float) $supply['prescript_price'] * self::$supp_qty);
        }
        $supply['qtv_price'] = $price;
        $supply['qtv_num'] = $qtv_num;
        $supply['supp_qty'] = $supp_qty;
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
        }
        $elevate['supp_qty'] = self::$supp_qty;
        $elevate['handle_qty'] = self::$handle_qty;
        $elevate['cost'] = $cost;
        $total = $cost + $float_cost + $ext_price;
        return $this->getObjectConfig($elevate, $total);
    }

    public function configDataCut($model_price, $work_price, $shape_price, $cut)
   {
      $total = $this->getBaseTotalStage(self::$supp_qty, $model_price, $work_price, $shape_price);
      $cut['supp_qty'] = self::$supp_qty;
      $cut['handle_qty'] = self::$handle_qty;
      return $this->getObjectConfig($cut, $total);
   }

    private function configDataByOnlyDevice($model_price, $work_price, $shape_price, $data)
    {
        $nqty = !empty($data['nqty']) ? (int) $data['nqty'] : 1;
        $data['qty_pro'] = self::$qty_pro;
        $data['handle_qty'] = self::$handle_product;
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

	private function configDataStage($data, $key_device){
        $device_id = !empty($data['machine']) ? (int)$data['machine'] : 0;
        $device = getDetailDataByID('Device', $device_id);
        $model_price = !empty($device['model_price']) ? (float) $device['model_price'] : 0;
        $work_price = !empty($device['work_price']) ? (float) $device['work_price'] : 0;
        $shape_price = !empty($device['shape_price']) ? (float) $device['shape_price'] : 0;
        $data['model_price'] = $model_price;
        $data['work_price'] = $work_price;
        $data['shape_price'] = $shape_price;
        if (empty($key_device)) {
            return $this->createNonActiveObj();    
        }
        if (in_array($key_device, [TDConstant::NILON, TDConstant::UV, \TDconst::METALAI, \TDConst::COVER])) {
            //Tính chi phí cán màng
        	$obj = $this->configDataMembrane($model_price, $work_price, $shape_price, $data, $key_device);
        }elseif ($key_device == TDConstant::ELEVATE){
            //Tính chi phí máy bế
            $obj = $this->configDataElevate($model_price, $work_price, $shape_price, $data);
        }elseif ($key_device == TDConstant::CUT){
            //Tính chi phí máy xén
            $obj = $this->configDataCut($model_price, $work_price, $shape_price, $data);
        }elseif ($key_device == TDConstant::MILL){
            //Tính chi phí phay
            $obj = $this->configDataMill($model_price, $work_price, $shape_price, $data);
        }else{
            //Tính chi phí bóc lề, dán hộp, dán túi, máy gấp vạch
            $obj = $this->configDataByOnlyDevice($model_price, $work_price, $shape_price, $data);
        }
        return $obj;    
    }

    private function configDataMill($model_price, $work_price, $shape_price, $data)
    {
      $data['qty_pro'] = self::$qty_pro;
      $data['handle_qty'] = self::$handle_product;
      $total = $this->getBaseTotalStage(self::$qty_pro, $model_price, $work_price, $shape_price, 0, $data['factor']);
      return $this->getObjectConfig($data, $total);
    }

    private function getPriterDevice($device)
    {
        $ex_length = self::$length;
        $ex_width = self::$width;
        $printer = \App\Models\Printer::where('device', $device)
        ->where('print_length', '>=', $ex_length)
        ->where('print_width', '>=', $ex_width)->orWhere(function($query) use($device, $ex_length, $ex_width){
            $query->where('device', $device)
            ->where('print_length', '>=', $ex_width)
            ->where('print_width', '>=', $ex_length);
        })
        ->orderBy('print_length', 'asc')->first();
        return $printer;
    }

    private function getPriceMateralQuote(&$supply)
    {
        if (@$supply['materal'] == \StatusConst::OTHER) {
            $price = @$supply['unit_price'] ?? 0;
            $qtv_num = @$supply['qtv'] ?? 1;
        }else{
            $qtv_id = @$supply['qtv'] ?? 0;
            $qtv = getDetailDataByID('SupplyPrice', $qtv_id);
            $price = @$qtv['price'] ?? 0;
            $qtv_num = @$qtv['price_purchase'] ?? 1;
        }
        $supply['qtv_price'] = $price;
        $supply['qtv_num'] = $qtv_num;
        return $price * $qtv_num;
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