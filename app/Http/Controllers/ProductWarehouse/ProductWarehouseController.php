<?php

namespace App\Http\Controllers\ProductWarehouse;
use App\Http\Controllers\Controller;
use App\Imports\ImportProductWarehouse;
use Maatwebsite\Excel\Facades\Excel;

class ProductWarehouseController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function import($file)
    {
        Excel::import(new ImportProductWarehouse(31), $file);
        return returnMessageAjax(200, 'Đã thêm vật tư thành công !', \StatusConst::RELOAD);
    }
}
