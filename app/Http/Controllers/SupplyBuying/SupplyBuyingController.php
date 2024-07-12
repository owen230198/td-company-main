<?php

namespace App\Http\Controllers\SupplyBuying;
use App\Http\Controllers\Controller;
use App\Models\PrintWarehouse;
use App\Models\SupplyBuying;
use App\Models\SupplyWarehouse;
use App\Models\WarehouseHistory;
use App\Services\WarehouseService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ExportExcel\ExportExcelService;

class SupplyBuyingController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function ProcessData(&$data)
    {
        $data['status'] = \StatusConst::NOT_ACCEPTED;
        $data['supply'] = json_encode($data['supply']);
    }
    
    public function insert($request)
    {
        $table = 'supply_buyings';
        if (!$request->isMethod('POST')) {
            $data = $this->admins->getDataActionView($table, __FUNCTION__, 'Thêm mới');
            $data['action_url'] = url('insert/'.$table);
            return view('action.view', $data);
        }else{
            $data = $request->except('_token');
            $this->processData($data);
            $this->admins->configBaseDataAction($data);
            $insert_id = SupplyBuying::insertGetId($data);
            if ($insert_id) {
                SupplyBuying::where('id', $insert_id)->update(['code' => 'CT-'.formatCodeInsert($insert_id)]);
                $back_routes = getBackUrl() ?? url('view/'.$table);
                logActionUserData(__FUNCTION__, $table, $insert_id, $data);
                return returnMessageAjax(200, 'Thêm dữ liệu thành công!', $back_routes);
            }else {
                return returnMessageAjax(100, 'Lỗi không xác định !');
            }
        }
    }

    public function update($request, $id)
    {
        $table = 'supply_buyings';
        $dataItem = getModelByTable($table)->find($id);
        if (!$request->isMethod('POST')) {
            $data = $this->admins->getDataActionView($table, __FUNCTION__, 'Chi tiết');
            $data['dataItem'] = $dataItem;
            $data['action_url'] = url('update/'.$table.'/'.$id);
            return view('action.view', $data);
        }else{
            $data = $request->except('_token');
            $this->processData($data);
            $this->admins->configBaseDataAction($data);
            $update = SupplyBuying::where('id', $id)->update($data);
            if ($update) {
                $back_routes = getBackUrl() ?? url('view/'.$table);
                logActionUserData(__FUNCTION__, $table, $id, $dataItem);
                return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', $back_routes);
            }else {
                return returnMessageAjax(100, 'Lỗi không xác định !');
            }
        }    
    }

    public function addSupplyBuying(Request $request)
    {
        return view('supply_buyings.supply_item', ['index' => (int) $request->input('index')]);
    }

    public function confirmSupplyBuy(Request $request, $id)
    {
        if (!$request->isMethod('POST')) {
            return back()->with('error', 'Yêu cầu không hợp lệ !');
        }
        if (\GroupUser::isAdmin() || \GroupUser::isApplyBuying()) {
            $supp_buying = SupplyBuying::find($id);
            $dataItem = $supp_buying->replicate();
            if (@$supp_buying->status != \StatusConst::NOT_ACCEPTED) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
            }
            $supp_buying->status = \StatusConst::ACCEPTED;
            $supp_buying->applied_by = \User::getCurrent('id');
            $supp_buying->save();
            logActionUserData('apply', 'supply_buyings', $id, $dataItem);
            return returnMessageAjax(200, 'Đã duyệt mua thành công cho yêu cầu mua '. $supp_buying->code.' !', getBackUrl());
        }else{
            return returnMessageAjax(100, 'Không có quyền thực hiện thao tác này !');
        }
    }

    public function confirmSupplyBought(Request $request, $id)
    {
        if (\GroupUser::isAdmin() || \GroupUser::isDoBuying()) {
            $supp_buying = SupplyBuying::find($id);
            if ($supp_buying->status != \StatusConst::ACCEPTED) {
                return returnMessageAjax(100, 'Yêu cầu chưa được phòng mua duyệt !');
            }
            $list_supp = !empty($supp_buying->supply) ? json_decode($supp_buying->supply, true) : [];
            $data = $request->except('_token');
            $data_supply = !empty($data['supply']) ? $data['supply'] :[];
            if (count($list_supp) > 0 && count($list_supp) == count($data_supply)) {
                if (empty($data['bill'])) {
                    return returnMessageAjax(100, 'Bạn cần upload Hóa đơn mua hàng !');
                }
                $buying_total = 0;
                foreach ($list_supp as $key => $supply) {
                    if (!empty($data_supply[$key]['price'])) {
                        $price = (float) $data_supply[$key]['price'];
                        $list_supp[$key]['price'] = $price;
                        $supp_total = $price * (int) @$supply['qty'];
                        $list_supp[$key]['total'] = $supp_total;
                        $buying_total += $supp_total;
                    }else{
                        return returnMessageAjax(100, 'Bạn cần nhập đầy đủ thông tin đơn giá mua !');
                    }
                }
                $supp_buying->supply = json_encode($list_supp);
                $supp_buying->total = $buying_total;
                $supp_buying->bill = $data['bill'];
                $supp_buying->status = SupplyBuying::BOUGHT;
                $supp_buying->bought_by = \User::getCurrent('id');
                $supp_buying->save();
                return returnMessageAjax(200, 'Đã xác nhận mua thành công cho yêu cầu mua '. $supp_buying->code.' !', getBackUrl());
            }else{
                return returnMessageAjax(100, 'Dữ liệu mua hàng không hợp lệ !');
            }
        }else{
            return returnMessageAjax(100, 'Không có quyền thực hiện thao tác này !');
        }
    }

    public function confirmWarehouseImported($id)
    {
        if (\GroupUser::isAdmin() || \GroupUser::isWarehouse()) {
            $supp_buying = SupplyBuying::find($id);
            if (@$supp_buying->status != SupplyBuying::BOUGHT) {
                return returnMessageAjax(100, 'Vật tư chưa được xác nhận mua về !');
            }
            if (empty($supp_buying->bill)) {
                return returnMessageAjax(100, 'Hóa đơn mua hàng chưa được upload !');
            }
            $data_supply = !empty($supp_buying->supply) ? json_decode($supp_buying->supply, true) : [];
            if (count($data_supply) == 0) {
                return returnMessageAjax(100, 'Dữ liệu vật tư không tồn tại !');
            }
            foreach ($data_supply as $supply) {
                $table_supply = tableWarehouseByType($supply['type']);
                $data['log']['type'] = @$supply['supp_type'];
                $data['log']['qty'] = (int) $supply['qty'];
                $data['log']['provider'] = @$supp_buying->provider;
                $data['log']['price'] = @$supply['price'];
                $data['log']['bill'] = @$supp_buying->bill;
                $warehouse_service = new WarehouseService($table_supply);
                $where = $supply;
                unset($where['qty'], $where['price'], $where['total']);
                $where['status'] = SupplyWarehouse::IMPORTED;
                if (getCountDataTable($table_supply, $where) == 0) {
                    $data['warehouse'] = $where;
                    $status = $warehouse_service->insert($data, 1);
                }else{
                    $data_supply = \DB::table($table_supply)->where($where)->first();
                    if (!empty($data_supply)) {
                        $status = $warehouse_service->update($data, $data_supply->id, 1);
                    }
                }
                if (@$status['code'] == 100) {
                    return $status;
                    break;
                }
            }
            $supp_buying->status = \StatusConst::SUBMITED;
            $supp_buying->submited_by = \User::getCurrent('id');
            $supp_buying->save();
            return returnMessageAjax(200, 'Xác nhận nhập kho thành công !', 'view/supply_buyings?default_data=%7B"status"%3A"'.SupplyBuying::BOUGHT.'"%7D');
        }else{
            return returnMessageAjax(100, 'Không có quyền thực hiện thao tác này !');
        }
    }

    public function listSupplyBuying($id)
    {
        $supply_buying = SupplyBuying::find($id);
        $data['data_buying'] = $supply_buying;
        $data['nosidebar'] = true;
        $data['title'] = 'Danh sách vật tư cần mua của chứng từ '.@$supply_buying->code;
        $data['list_data'] = !empty($supply_buying->supply) ? json_decode($supply_buying->supply) : new \stdClass();
        return view('supply_buyings.list_supply', $data);
    }

    public function getQuantitativeInPaper(Request $request)
    {
        $html = '<option value="">Danh sách định lượng</option>';
        $id = $request->input('param');
        if (!empty($id)) {
            $data = \DB::table('print_warehouses')->select('qtv')->where(['supp_price' => $id])->get();
            if (!$data->isEmpty()) {
                $papers = $data->unique('qtv');
                foreach ($papers as $paper) {
                    $html .= '<option value="'.@$paper->qtv.'">Định lượng: '.@$paper->qtv.'</option>';
                }
            }
        }
        echo $html;
    }

    public function inventoryAggregate(Request $request)
    {
        $is_ajax = $request->input('is_ajax') == 1;
        if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting()) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập !']);
        }
        $data['title'] = 'Tổng hợp tồn kho';
        if (!$is_ajax) {
            $data['link_search'] = url('inventory-aggregate');
            $data['fields'] = [
                [
                    'name' => 'created_at',
                    'attr' => '{"class_on_search":"change_submit"}',
                    'note' => 'Khoảng thời gian',
                    'type' => 'datetime'
                ],
                [
                    'name' => 'type',
                    'attr' => '{"class_on_search":"__select_type_supply_search_history"}',
                    'note' => 'Loại hàng',
                    'type' => 'select',
                    'other_data' => '{
                        "config":{
                            "searchbox":1
                        },
                        "data":{
                            "options":{
                                "":"Chọn loại hàng",
                                "paper":"Giấy in", 
                                "nilon":"Màng nilon", 
                                "metalai":"Màng metalai",
                                "cover":"Màng phủ trên",
                                "carton":"Carton",
                                "rubber":"Cao su",
                                "styrofoam":"Mút phẳng",
                                "decal":"Nhung",
                                "silk":"Vải lụa",
                                "mica":"Mi ca",
                                "magnet":"Nam châm",
                                "other":"Vật tư khác"
                            }
                        }
                    }'
                ],
            ];
            return view('inventories.view', $data);
        }else{
            if (empty($request->input('created_at'))) {
                return returnMessageAjax(100, 'Bạn chưa chọn khoảng thời gian !');
            }
            $this->tableDataInventoryAggregate($request, $data);
            return view('inventories.table', $data);
        }     
    }

    private function tableDataInventoryAggregate($request, &$data)
    {
        $where = [['status', '=', SupplyWarehouse::IMPORTED]];
        $where_table = [];
        if (!empty($request->input('type'))) {
            if ($request->input('type') != 'other') {
                $where[] = ['type', '=', $request->input('type')];
            }
            $table = tableWarehouseByType($request->input('type'));
            $names = $request->except(['is_ajax', 'created_at', 'type']);
            foreach ($names as $key => $value) {
                $conditions = (new \App\Services\AdminService)->getConditionTable($table, $key, $value);
                if (!empty($conditions)) {
                    foreach ($conditions as $cond) {
                        $compare = @$cond['compare'] ?? '=';
                        $where_table[$table][] = [$cond['key'], $compare, $cond['value']];
                    }
                }
            }
        }
        $list_data =  WarehouseHistory::getInventoryAllTable($where, $where_table)->get();
        $data['list_data'] = $list_data;
        $data['range_time'] = $request->input('created_at');
        $data['count'] = $list_data->count();
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
                'name' => 'provider',
                'note' => 'Nhà cung cấp',
                'type' => 'linking',
                'other_data' => '{
                    "config":{
                        "search":1
                    },
                    "data":{
                        "table":"warehouse_providers"
                    }
                }'
            ],
            [
                'name' => 'price',
                'attr' => '{"type_input":"number"}',
                'note' => 'Đơn giá',
                'type' => 'text'
            ]
        ];
        $data['link_search'] = url('inventory-detail');
        $data['nosidebar'] = true;
    }

    private function tableDataInventoryDetail($request, &$data)
    {
        $wheres = $request->except('is_ajax', 'is_detail');
        $where = [];
        foreach ($wheres as $key => $value) {
            if (!empty($value)) {
                if ($key == 'price'){
                    if (!empty($value['from'])) {
                        $where[] = [$key, '>=', $value['from']];
                    }
                    if (!empty($value['to'])) {
                        $where[] = [$key, '<=', $value['to']];
                    }
                }elseif($key == 'created_at'){
                    $arr_time = getDateRangeToQuery($request->input('created_at')); 
                    $where[] = [$key, '>=', $arr_time[0]];
                    $where[] = [$key, '<=', $arr_time[1]];   
                }else{
                    $where[] = [$key, '=', $value];
                }
            }
        }
        $obj = WarehouseHistory::where($where);
        $data['data_item'] = $wheres;
        $list_data = $obj->get();
        $data['count'] = $list_data->count();
        $data['price'] = $list_data->sum('price');
        $data['imported'] = $list_data->sum('imported');
        $data['exported'] = $list_data->sum('exported');
        $data['inventory'] = $list_data->sum('inventory');
        $data['list_data'] = $list_data;
    }

    public function inventoryDetail(Request $request) {
        $is_ajax = $request->input('is_ajax') == 1;
        if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting()) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập !']);
        }
        $data['title'] = 'SỔ CHI TIẾT VẬT TƯ HÀNG HÓA';
        if (!$is_ajax) {
            if (empty($request->input('table')) || empty($request->input('type')) || empty($request->input('target')) || empty($request->input('created_at'))) {
                return back()->with('error', 'Dữ liệu không hợp lệ !');
            }
            $data['is_detail'] = true;
            $data['data_search']['created_at'] = $request->input('created_at');
            $this->getViewDataDetailInventory($data);
        }
        $this->tableDataInventoryDetail($request, $data);
        $view_return = !$is_ajax ? 'view' : 'detail';
        return view('inventories.'.$view_return, $data);
    }

    private function exportInventoryAggregate($request)
    {
        if (empty($request->input('created_at'))) {
            return back()->with('error', 'Bạn chưa chọn khoảng thời gian!');
        }
        $data['title'] = 'TỔNG HỢP TỒN KHO';
        $this->tableDataInventoryAggregate($request, $data);
        return Excel::download(new ExportExcelService($data, 'inventories.table'), 'TONG_HOP_TON_KHO.xlsx');
    }

    private function exportInventoryDetail($request)
    {
        $data['title'] = 'SỔ CHI TIẾT VẬT TƯ HÀNG HÓA';
        $this->tableDataInventoryDetail($request, $data);
        return Excel::download(new ExportExcelService($data,  'inventories.detail'), 'SO_CHI_TIET_VAT_TU_HANG_HOA.xlsx');
    }

    public function inventoryExport(Request $request)
    {
        if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting()) {
            return back()->with('error', 'Bạn không có quyền export dữ liệu này !');
        }
        if (!empty($request->input('is_detail'))) {
            return $this->exportInventoryDetail($request);
        }else{
            return $this->exportInventoryAggregate($request);    
        }
    }

    public function fieldSearchHistory(Request $request)
    {
        $type = $request->input('type');
        if (empty($type)) {
            return false;
        }
        $table = tableWarehouseByType($type);
        $data['fields'] = $table == 'print_warehouses' ? PrintWarehouse::getFieldSearch() : (new \App\Services\AdminService())->getFieldAction($table, 'search');
        $data['default_field']['type'] = $type;
        return view('inventories.field_search', $data);
    }

    public function getViewBuyingSupplyType(Request $request)
    {
        $type = $request->input('type');
        if (empty($type)) {
            return '';
        }
        $index = $request->input('index');
        $data = getViewSuppluBuyingByType($type, $index);
        return view('supply_buyings.field_buying', $data);
    }
}
