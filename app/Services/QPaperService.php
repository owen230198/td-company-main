<?php 
namespace App\Services;
use App\Services\BaseService;
use App\Services\Traits\QPaperTrait;
class QPaperService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}
    use QPaperTrait;
    public function insert($data, $quote_id){
        $dataAction = $data;
        $length = @$data['length']?$data['length']:0;
        $width = @$data['width']?$data['width']:0;
        $qty_paper = @$data['qty_paper']?(int)$data['qty_paper']:0;
        $qty_pro = @$data['qty_pro']?(int)$data['qty_pro']:0;
        $n_qty = @$data['n_qty']?(int)$data['n_qty']:0;
        $dataAction['paper_size'] = $this->configDataSizePaper($qty_paper, $length, $width, $data['paper_size']);
        $dataAction['print'] = $this->configDataPrint($qty_pro, $n_qty, $length, $width, $data['print']);
        $dataAction['skin'] = $this->configDataSkin($qty_pro, $n_qty, $length, $width, $data['skin']);
        $dataAction['metalai'] = $this->configDataMetalai($qty_pro, $n_qty, $length, $width, $data['metalai']);
        var_dump($dataAction['paper_size']); die();
    }
}