<?php
namespace App\Services\QTraits;

use App\Constants\TDConstant;

trait QuoteTrait
{
    static $plus_paper_device = TDConstant::PLUS_PAPER_DEVICE;
    static $plus_compen_perc = TDConstant::COMPEN_PERCENT;
    static $qty_pro = 0;
    static $nqty = 1;
    static $base_qty_paper = 0;
    static $qty_paper = 0;
    static $length = 0;
    static $width = 0;
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
        if ($total > 0) {
            $obj = $data;
            $obj['total'] = $total;    
        }else{
            $obj['act'] = 0;
        }
        return json_encode($obj);
    }

    private function getBaseTotalStage($qty, $work_price, $shape_price, $length, $width, $materal_cost = 0, $factor = 1, $plus_qty = 0)
    {
        // CPVTK: D x R x DGL (1)
        $a = $length*$width*$work_price;

        // DGVT: D x R x DGVT x (SL tờ in - sp + BH %) x hệ số (2)
        $b = $length*$width*$materal_cost*($qty + $plus_qty)*$factor;

        // DGL = (SL tờ in hoặc SL sản phẩm + BH %) x DGL x hệ số (3)
        $c = $qty*$work_price*$factor;
        
        // Tổng chi phí  = (1) + (2) + ĐGCM + (3);
        return $a + $b + $shape_price + $c;
    }

	private function configDataStage($data, $qty_pro, $qty_paper,  $length = 0, $width = 0){
        $device_id = !empty($data['machine']) ? (int)$data['machine'] : 0;
        $device = getDetailDataByID('Device', $device_id);
        $model_price = !empty($data['model_price']) ? (float) $data['model_price'] : 0;
        $work_price = !empty($device['work_price']) ? (float) $device['work_price'] : 0;
        $shape_price = !empty($device['shape_price']) ? (float) $device['shape_price'] : 0;
        $key_device = !empty($device['key_device']) ? $device['key_device'] : '';
        if (empty($key_device)) {
            return $this->createNonActiveObj();    
        }
        if ($key_device == TDConstant::NILON) {
            //Tính chi phí cán nilon
        	$obj = $this->configDataNilon($qty_paper, $length, $width, $shape_price, $work_price, $data);
        }elseif ($key_device == TDConstant::METALAI){
            //Tính chi phí cán metalai
            $obj = $this->configDataMetalai($qty_paper, $length, $width, $shape_price, $work_price, $data);
        }elseif ($key_device == TDConstant::COMPRESS) {
            //Tính chi phí ép nhũ
            // $total = ($qty_paper*$work_price*$float_price)+($shape_price+$model_price);   
            $obj = $this->configDataCompress($qty_paper, $length, $width, $data);
        }elseif($key_device == TDConstant::ELEVATE){
            
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