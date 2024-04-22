<?php

namespace App\Http\Controllers\PrintWarehouse;
use App\Http\Controllers\Controller;

class PrintWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService('print_warehouses');
    }
    
    public function validateData($data){ 
        if (empty($data['length'])) {
            return returnMessageAjax(100, 'Vui lòng nhập kích thước khổ chiều dài !');
        }

        if (empty($data['width'])) {
            return returnMessageAjax(100, 'Vui lòng nhập kích thước khổ chiều rộng !');
        }

        if (empty($data['supp_price'])) {
            return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
        }

        if ($data['qtv'] == '') {
            return returnMessageAjax(100, 'Vui lòng nhập định lượng !');
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
