<?php
namespace App\Services\QTraits;
trait QCartonTrait{

	public function getDataActionQCarton($data, $table)
	{
		$length = @$data['length']?$data['length']:0;
        $width = @$data['width']?$data['width']:0;
        $qty_paper = @$data['qty_paper']?(int)$data['qty_paper']:0;
        $qty_pro = @$data['qty_pro']?(int)$data['qty_pro']:0;
        $n_qty = @$data['n_qty']?(int)$data['n_qty']:1;
        $dataAction = $data;
        $dataAction['paper_size'] = $this->configDatSizePaperHard($length, $width, $data['paper_size'], $qty_paper);
        $dataAction['elevate'] = $this->configDataStage($qty_pro, $n_qty, $data['elevate']);
        $dataAction['milling'] =  $this->configDataStage($qty_pro, $n_qty, $data['milling'], $length, $width, $table, $data['name']);
        $dataAction['peel'] = $this->configDataStage($qty_pro, $n_qty, $data['peel'], $length, $width, $table);
        dd($dataAction);
	}
}