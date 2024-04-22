<?php

namespace App\Http\Controllers\OtherWarehouse;

use App\Http\Controllers\Controller;

class OtherWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService('other_warehouses');
    }
    public function insert($request)
    {
        $param = $request->except('_token');
        if ($request->isMethod('GET')) {
            return $this->services->insert($param);
        }else{
            $data = @$param['warehouse'] ?? [];
            if (empty($data['supp_price'])) {
                return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
            }
            return $this->services->insert($param, 1);
        }
    }

    public function update($request, $id)
    {
        $param = $request->except('_token');
        if (!$request->isMethod('POST')) {
            return $this->services->update($param, $id);
        }else{
            $data = @$param['warehouse'] ?? [];
            if (empty($data['supp_price'])) {
                return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
            }
            return $this->services->update($param, $id, 1);
        }
    }
}
