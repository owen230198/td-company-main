<?php

namespace App\Http\Controllers\SquareWarehouse;

use App\Http\Controllers\Controller;

class SquareWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService('square_warehouses');
    }

    public function validateData($data){ 
        if (empty($data['width'])) {
            return returnMessageAjax(100, 'Vui lòng nhập kích thước khổ vật tư !');
        }

        if (empty($data['supp_price'])) {
            return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
        }
    }

    public function insert($request)
    {
        $param = $request->except('_token');
        if ($request->isMethod('GET')) {
            return $this->services->insert($param);
        }else{
            $validate = $this->validateData($request->input('warehouse'));
            if (@$validate['code'] == 100) {
                return $validate;
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
            $validate = $this->validateData($request->input('warehouse'));
            if (@$validate['code'] == 100) {
                return $validate;
            }
            return $this->services->update($param, $id, 1);
        }
    }
}
