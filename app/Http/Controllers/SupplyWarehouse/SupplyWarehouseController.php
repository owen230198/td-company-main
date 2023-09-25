<?php

namespace App\Http\Controllers\SupplyWarehouse;

use App\Http\Controllers\Controller;

class SupplyWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService;
    }
    public function insert($request)
    {
        $table = 'supply_warehouses';
        if ($request->isMethod('GET')) {
            $param = $request->except('_token');
            return $this->services->insert($table, $param);
        }else{
            $data_warehouse = $request->input('warehouse');
            if (empty($data_warehouse['length'])) {
                return returnMessageAjax(100, 'Vui lòng nhập kích thước khổ chiều dài !');
            }

            if (empty($data_warehouse['width'])) {
                return returnMessageAjax(100, 'Vui lòng nhập kích thước khổ chiều rộng !');
            }

            if (empty($data_warehouse['supp_type'])) {
                return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
            }

            if (empty($data_warehouse['supp_price'])) {
                return returnMessageAjax(100, 'Vui lòng chọn định lượng !');
            }
            return $this->services->doInsert($table, $request->all());
        }
    }
}
