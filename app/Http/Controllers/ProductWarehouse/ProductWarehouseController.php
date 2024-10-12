<?php

namespace App\Http\Controllers\ProductWarehouse;
use App\Http\Controllers\Controller;
use App\Imports\ImportProductWarehouse;
use Illuminate\Http\Request;
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

    public function inventory(Request $request)
    {
        $is_ajax = $request->input('is_ajax') == 1;
        if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting()) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập !']);
        }
        $data['title'] = 'Tổng hợp tồn kho thành phẩm';
        if (!$is_ajax) {
            $data['link_search'] = url('product-warehouse-inventory');
            $data['fields'] = $this->admins->getFieldAction('product_warehouses', 'search');
            return view('inventories.view', $data);
        }else{
            if (empty($request->input('created_at'))) {
                return returnMessageAjax(100, 'Bạn chưa chọn khoảng thời gian !');
            }
            $this->tableDataInventory($request, $data);
            return view('inventories.table', $data);
        }   
    }
}
