<?php

namespace App\Http\Controllers\ProductWarehouse;
use App\Http\Controllers\Controller;
use App\Imports\ImportProductWarehouse;
use App\Models\ProductHistory;
use App\Models\ProductWarehouse;
use App\Services\ExportExcel\ExportExcelService;
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
        $obj = new ImportProductWarehouse(31);
        $arr_file = pathinfo($file->getClientOriginalName());
        if (strpos($arr_file['filename'], 'refs') !== false) {
            $data = Excel::toArray($obj, $file);
            foreach ($data[0] as $item) {
                $obj = ProductWarehouse::where('name', 'like', '%'.$item['name'].'%')->where('warehouse_type', 32)->get()->first();
                $qty = $item['qty'];
                $obj->qty = $qty;
                $obj->save();
                ProductHistory::doLogWarehouse($obj->id, $qty, 0, $qty, 0, ['note' => 'Điều chỉnh lại số lượng kho']);
            }
        }else{
            Excel::import($obj, $file);
        }
        return returnMessageAjax(200, 'Thành công !', \StatusConst::RELOAD);
    }

    static function rolePreventInventory(){
        return !\GroupUser::isAdmin() && !\GroupUser::isAccounting() && !\GroupUser::isSale();
    }

    public function inventory(Request $request)
    {
        $is_ajax = $request->input('is_ajax') == 1;
        if (self::rolePreventInventory()) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập !']);
        }
        $table = 'product_warehouses';
        $data['title'] = 'Tổng hợp tồn kho thành phẩm';
        if (!$is_ajax) {
            $data['link_search'] = url('product-warehouse-inventory');
            $data['fields'] = $this->admins->getFieldAction($table, 'search');
            $data['export_route'] = 'product-warehouses-export-inventory';
            return view('inventories.view', $data);
        }else{
            if (empty($request->input('created_at'))) {
                return returnMessageAjax(100, 'Bạn chưa chọn khoảng thời gian !');
            }
            $this->tableDataInventoryAggregate($request, $data);
            return view('product_warehouses.table_inventory', $data);
        }   
    }

    private function tableDataInventoryAggregate($request, &$data)
    {
        $arr_where = $request->except(['is_ajax', 'created_at']);
        $where = [];
        foreach ($arr_where as $field_name => $field_value) {
            $conditions = $this->admins->getConditionTable('product_warehouses', $field_name, $field_value);
            if (!empty($conditions)) {
                foreach ($conditions as $condition) {
                    $where[] = $condition;
                }
            }
        }
        $obj = ProductWarehouse::where('act', 1);
        if (!empty($where)) {
            $obj = $obj->where($where);
        }
        $list_data = $obj->get();
        $data['list_data'] = $list_data;
        $data['range_time'] = $request->input('created_at');
        $data['count'] = $list_data->count();
    }

    public function inventoryDetail(Request $request)
    {
        $is_ajax = $request->input('is_ajax') == 1;
        if (self::rolePreventInventory()) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập !']);
        }
        $data['title'] = 'SỔ CHI TIẾT HÀNG HÓA THÀNH PHẨM';
        $data['is_detail'] = 1;
        $data['view_table'] = 'product_warehouses.inventory_detail';
        if (!$is_ajax) {
            if (empty($request->input('target'))) {
                return back()->with('error', 'Dữ liệu không hợp lệ !');
            }
            $data['data_search']['created_at'] = $request->input('created_at');
            $this->getViewDataDetailInventory($data);
        }
        $wheres = $request->except('is_ajax', 'is_detail');
        $this->admins->tableDataInventoryDetail($wheres, 'product_histories', $data);
        $data['export_route'] = 'product-warehouses-export-inventory';
        $view_return = !$is_ajax ? 'inventories.view' : $data['view_table'];
        return view($view_return, $data);
    }

    private function getViewDataDetailInventory(&$data)
    {
        $data['fields'] = [
            [
                'name' => 'created_at',
                'note' => 'Ngày chứng từ',
                'type' => 'datetime',
            ],
            [
                'name' => 'price',
                'attr' => '{"type_input":"number"}',
                'note' => 'Đơn giá',
                'type' => 'text'
            ]
        ];
        $data['link_search'] = url('product-inventory-detail');
        $data['nosidebar'] = true;
    }

    private function exportInventoryAggregate($request)
    {
        if (empty($request->input('created_at'))) {
            return back()->with('error', 'Bạn chưa chọn khoảng thời gian!');
        }
        $data['title'] = 'TỔNG HỢP TỒN KHO';
        $this->tableDataInventoryAggregate($request, $data);
        return Excel::download(new ExportExcelService($data, 'product_warehouses.table_inventory'), 'TONG_HOP_TON_KHO.xlsx');
    }

    private function exportInventoryDetail($request)
    {
        $data['title'] = 'SỔ CHI TIẾT VẬT TƯ HÀNG HÓA';
        $wheres = $request->except('is_ajax', 'is_detail');
        $this->admins->tableDataInventoryDetail($wheres, 'product_histories', $data);
        return Excel::download(new ExportExcelService($data,  'product_warehouses.inventory_detail'), 'SO_CHI_TIET_VAT_TU_HANG_HOA.xlsx');
    }

    public function inventoryExport(Request $request)
    {
        if (self::rolePreventInventory()) {
            return back()->with('error', 'Bạn không có quyền export dữ liệu này !');
        }
        if (!empty($request->input('is_detail'))) {
            return $this->exportInventoryDetail($request);
        }else{
            return $this->exportInventoryAggregate($request);    
        }
    }
}
