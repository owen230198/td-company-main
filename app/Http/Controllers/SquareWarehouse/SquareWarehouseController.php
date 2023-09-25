<?php

namespace App\Http\Controllers\SquareWarehouse;

use App\Http\Controllers\Controller;

class SquareWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService;
    }
    public function insert($request)
    {
        $table = 'square_warehouses';
        if ($request->isMethod('GET')) {
            $param = $request->except('_token');
            return $this->services->insert($table, $param);
        }else{
            return $this->services->doInsert($table, $request->all());
        }
    }
}
