<?php

namespace App\Http\Controllers\SquareWarehouse;

use App\Http\Controllers\Controller;
use App\Models\SquareWarehouse;

class SquareWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService('square_warehouses');
    }

    public function validateData($data){ 
        $warehouse = $data['warehouse'];
        $log = $data['log'];
        if (empty($warehouse['type'])) {
            return returnMessageAjax(100, 'Dữ liệu vật tư không hợp lệ !');
        }
        if (empty($warehouse['width'])) {
            return returnMessageAjax(100, 'Vui lòng nhập kích thước khổ vật tư !');
        }
        $type = $warehouse['type'];
        if (SquareWarehouse::isWeightLogWarehouse($type)) {
            if (empty($warehouse['device'])) {
                return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
            }
            if ($type == \TDConst::EMULSION && empty($warehouse['name'])) {
                return returnMessageAjax(100, 'Vui lòng nhập mã màu nhũ !');
            }
        }

        if (SquareWarehouse::countPriceByWeight($type) || SquareWarehouse::countPriceBySquare($type)) {
            if (empty($warehouse['supp_price'])) {
                return returnMessageAjax(100, 'Vui lòng chọn loại màng !');
            }
        }

        $count = SquareWarehouse::where($warehouse)->count();
        if ($count > 0) {
            return returnMessageAjax(100, 'Vật tư '.$data['name'].' Đã có trong kho !');
        }
    }

    public function insert($request)
    {
        $param = $request->except('_token');
        if ($request->isMethod('GET')) {
            return $this->services->insert($param);
        }else{
            $validate = $this->validateData($param);
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
            // $validate = $this->validateData($request->input('warehouse'));
            if (@$validate['code'] == 100) {
                return $validate;
            }
            return $this->services->update($param, $id, 1);
        }
    }

    public function import($file){
        return $this->services->import($file);
    }
}
