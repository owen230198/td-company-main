<?php 
namespace App\Services;
use App\Services\BaseService;
use App\Services\Traits\QuoteTrait;
use App\Services\Traits\QPaperTrait;
class QuoteService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}
    use QuoteTrait, QPaperTrait;
    public function insert($table, $data, $quote_id){
        $dataAction = $data;
        $length = @$data['length']?$data['length']:0;
        $width = @$data['width']?$data['width']:0;
        $qty_paper = @$data['qty_paper']?(int)$data['qty_paper']:0;
        $qty_pro = @$data['qty_pro']?(int)$data['qty_pro']:0;
        $n_qty = @$data['n_qty']?(int)$data['n_qty']:1;
        $dataAction['paper_size'] = $this->configDataSizePaper($qty_paper, $length, $width, $data['paper_size']);
        $dataAction['print'] = $this->configDataPrint($qty_pro, $n_qty, $length, $width, $data['print']);
        $dataAction['skin'] = $this->configDataStage($qty_pro, $n_qty, $data['skin'], $length, $width);
        $dataAction['metalai'] = $this->configDataMetalai($qty_pro, $n_qty, $length, $width, $data['metalai']);
        $data_action['compress'] = $this->configDataCompress($qty_pro, $n_qty, $data['compress']);
        $data_action['uv'] = $this->configDataStage($qty_pro, $n_qty, $data['uv']);
        $data_action['elevate'] = $this->configDataStage($data['elevate']);
        $data_action['peel'] = $this->configDataStage($data['peel']);
        $data_action['paste'] = $this->configDataStage($data['paste']);
        var_dump($dataAction['paper_size']); die();
    }
}