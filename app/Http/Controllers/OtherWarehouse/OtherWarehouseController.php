<?php

namespace App\Http\Controllers\OtherWarehouse;

use App\Http\Controllers\Controller;

class OtherWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService;
    }
    public function insert($request)
    {
        $table = 'other_warehouses';
        if ($request->isMethod('GET')) {
            $param = $request->except('_token');
            return $this->services->insert($table, $param);
        }else{
            $data_warehouse = $request->input('warehouse');
            if (empty($data_warehouse['qty'])) {
                return returnMessageAjax(100, 'Vui lòng nhập số lượng nhập kho !');
            }

            if (empty($data_warehouse['supp_price'])) {
                return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
            }
            return $this->services->doInsert($table, $request->all());
        }
    }
}
