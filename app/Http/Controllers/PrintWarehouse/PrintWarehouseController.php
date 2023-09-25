<?php

namespace App\Http\Controllers\PrintWarehouse;
use App\Http\Controllers\Controller;

class PrintWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService;
    }
    public function insert($request)
    {
        $table = 'print_warehouses';
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

            if (empty($data_warehouse['supp_price'])) {
                return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
            }

            if ($data_warehouse['qtv'] == '') {
                return returnMessageAjax(100, 'Vui lòng nhập định lượng !');
            }
            return $this->services->doInsert($table, $request->all());
        }
    }
}
