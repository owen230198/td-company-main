<?php
namespace App\Services\QTraits;
trait QSupplyTrait{
  public function getDataActionCartonFoam($data, $table)
  {
      $length = @$data['length']?$data['length']:0;
      $width = @$data['width']?$data['width']:0;
      $qty_paper = @$data['qty_paper']?(int)$data['qty_paper']:0;
      $qty_pro = @$data['qty_pro']?(int)$data['qty_pro']:0;
      $n_qty = @$data['n_qty']?(int)$data['n_qty']:1;
      $dataAction = $data;
      $dataAction['paper_size'] = $this->configDatSizePaperHard($length, $width, $data['paper_size'], $qty_paper);
      $dataAction['elevate'] = $this->configDataStage($qty_pro, $n_qty, $data['elevate']);
      if ($table=='q_cartons') {
         $dataAction['milling'] =  $this->configDataStage($qty_pro, $n_qty, $data['milling'], $length, $width, $table, $data['name']);
      }
      $dataAction['peel'] = $this->configDataStage($qty_pro, $n_qty, $data['peel'], $length, $width, $table);
      return $dataAction;
  }

   public function getDataActionSilk($data)
   {
      $length = @$data['length']?$data['length']:0;
      $width = @$data['width']?$data['width']:0;
      $qty_paper = @$data['qty_paper']?(int)$data['qty_paper']:0;
      $qty_pro = @$data['qty_pro']?(int)$data['qty_pro']:0;
      $n_qty = @$data['n_qty']?(int)$data['n_qty']:1;
      $hole_num = @$data['hole_price']['num']?(int)$data['hole_price']['num']:0;
      $dataAction = $data;
      $dataAction['name'] = @$data['paper_size']['quantative'];
      $dataAction['paper_size'] = $this->configDatSizePaperHard($length, $width, $data['paper_size'], $qty_paper);
      $dataAction['hole_price'] = $this->configDataHardPrice($hole_num, (int)getDataConfigs('QConfig', 'PRICE_SHAPE_HOLE'), (int)getDataConfigs('QConfig', 'PRICE_PLUS_HOLE'), $qty_pro, $data['hole_price']);
      return $dataAction;

   }
}