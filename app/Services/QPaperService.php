<?php 
namespace App\Services;
use App\Services\BaseService;

class QPaperService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}

	public function insert($data, $quote_id){
		dd($data);
	}
}