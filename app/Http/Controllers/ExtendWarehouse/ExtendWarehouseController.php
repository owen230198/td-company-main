<?php

namespace App\Http\Controllers\ExtendWarehouse;

use App\Http\Controllers\Controller;
use App\Models\ExtendWarehouse;

class ExtendWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\WarehouseService('extend_warehouses');
    }
    public function insert($request)
    {
        $param = $request->except('_token');
        if ($request->isMethod('GET')) {
            return $this->services->insert($param);
        }else{
            $data = @$param['warehouse'] ?? [];
            if (empty($data['type'])) {
                return returnMessageAjax(100, 'Vui lòng chọn loại vật tư !');
            }
            if (empty($data['name'])) {
                return returnMessageAjax(100, 'Vui lòng nhập tên vật tư !');
            }
            if (empty($data['unit'])) {
                return returnMessageAjax(100, 'Vui lòng nhập đơn vị tính của vật tư !');
            }
            if (ExtendWarehouse::where($data)->count() > 0) {
                return returnMessageAjax(100, 'Vật tư '.$data['name'].' đã có trong kho !');
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
            return $this->services->update($param, $id, 1);
        }
    }

    public function import($file){
        return $this->services->import($file);
    }
}
