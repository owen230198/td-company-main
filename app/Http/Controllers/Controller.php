<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct()
	{
		$this->detail_tables = new \App\Models\NDetailTable;
		$this->regions = new \App\Models\NRegion;
		$this->db = new \Illuminate\Support\Facades\DB;
	}
}

