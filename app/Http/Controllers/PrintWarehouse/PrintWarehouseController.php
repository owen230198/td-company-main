<?php

namespace App\Http\Controllers\PrintWarehouse;
use App\Http\Controllers\Controller;
use App\Imports\ImportPrintWarehouse;
use App\Models\PrintWarehouse;
use Maatwebsite\Excel\Facades\Excel;

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
        $count = PrintWarehouse::where($data)->count();
        if ($count > 0) {
            return returnMessageAjax(100, 'Vật tư '.PrintWarehouse::getName($data).' Đã có trong kho !');
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
            // $validate = $this->validateData($request->input('warehouse'));
            if (@$validate['code'] == 100) {
                return $validate;
            }
            return $this->services->update($param, $id, 1);
        }
    }

    public function import($file){
        Excel::import(new ImportPrintWarehouse, $file);
        return returnMessageAjax(200, 'Đã thêm vật tư giấy thành công !');
    }
}
