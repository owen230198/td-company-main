<?php
namespace App\Services\QTraits;

use App\Constants\TDConstant;

trait QSupplyTrait{
   private function configDataCut($model_price, $work_price, $shape_price, $elevate)
   {
      $total = $this->getBaseTotalStage(self::$supp_qty, $model_price, $work_price, $shape_price);
      return $this->getObjectConfig($elevate, $total);
   }

   public function getDataActionSupply($data)
   {
      $this->newObjectSetProperty($data);
      static::$base_supp_qty = !empty($data['supp_qty']) ? (int) $data['supp_qty'] : 0;
      static::$supp_qty = ceil(calValuePercentPlus(self::$base_supp_qty, self::$base_supp_qty, self::$hard_compen_perc)); 
      
      if (!empty($data['size'])) {
         $data_action['size'] = $this->configDataSupplySize($data['size']);
      }

      if (!empty($data['cut'])) {
         $data_action['cut'] = $this->configDataStage($data['cut']);
      }

      if (!empty($data['mill'])) {
         $data_action['mill'] = $this->configDataStage($data['mill']);
      }

      if (!empty($data['elevate'])) {
         $data_action['elevate'] = $this->configDataStage($data['elevate']);
      }

      if (!empty($data['peel'])) {
         $data_action['peel'] = $this->configDataStage($data['peel']);
      }

      $data_action['total_cost'] = $this->priceCaculatedByArray($data_action);

      return $data_action;
   }

   private function configDataFill($fill)
   {
      $fill_price = (float) TDConstant::FILL_PRICE;
      $fill_cost = 0;
      $stage = !empty($fill['stage']) ? $fill['stage'] : [];
      foreach ($stage as $key => $item) {
         $qttv_id = @$item['materal'] ? (int) $item['materal'] : 0;
         $qttv = getDetailDataByID('SupplyPrice', $qttv_id);
         $qttv_price = @$qttv['price']?$qttv['price']:0; 
         $length = !empty($item['size']['length']) ? $item['size']['length'] : 0;
         $width = !empty($item['size']['width']) ? $item['size']['width'] : 0;
         convertCmToMeter($length, $width); 
         $fill['stage'][$key]['cost'] = ($length * $width * $qttv_price) + $fill_price; 
         $fill_cost += $fill['stage'][$key]['cost'];
      }
      $ext_price = @$fill['ext_price'] ? (float) $fill['ext_price'] : 0;
      $total = $fill_cost + ($ext_price *self::$base_qty_pro);
      return $this->getObjectConfig($fill, $total);
   }

   private function configDataFinish($finish)
   {
      $stage = !empty($finish['stage']) ? $finish['stage'] : [];
      $finish_cost = 0;
      foreach ($stage as $key => $item) {
         $qttv_id = @$item['materal'] ? (int) $item['materal'] : 0;
         $qttv = getDetailDataByID('SupplyPrice', $qttv_id);
         $qttv_price = @$qttv['price']?$qttv['price']:0; 
         $finish['stage'][$key]['cost'] = self::$base_qty_pro * $qttv_price; 
         $finish_cost += $finish['stage'][$key]['cost'];
      }
      $ext_price = @$finish['ext_price'] ? (float) $finish['ext_price'] : 0;
      $total = $finish_cost + ($ext_price *self::$base_qty_pro);
      return $this->getObjectConfig($finish, $total);
   }

   private function configDataMagnet($magnet)
   {
      $magnet_perc = TDConstant::MAGNET_PERC;
      $qttv_id = @$magnet['type'] ? (int) $magnet['type'] : 0;
      $qttv = getDetailDataByID('SupplyPrice', $qttv_id);
      $qttv_price = @$qttv['price']?$qttv['price']:0;  
      $qty = @$magnet['qty'] ? (int) $magnet['qty'] : 0; 
      $total = (self::$base_qty_pro * $qttv_price) * (($qty * $magnet_perc) / 100);
      return $this->getObjectConfig($magnet, $total);
   }

   public function getDataActionFillFinish($data)
   {
      $this->newObjectSetProperty($data);
      if (!empty($data['fill'])) {
         $data_action['fill'] = $this->configDataFill($data['fill']);
      }

      if (!empty($data['finish'])) {
         $data_action['Finish'] = $this->configDataFinish($data['finish']);
      }

      if (!empty($data['magnet'])) {
         $data_action['magnet'] = $this->configDataMagnet($data['magnet']);
      }

      $data_action['total_cost'] = $this->priceCaculatedByArray($data_action);

      return $data_action;
   }
}