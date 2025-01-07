<?php
    namespace App\Http\Controllers\SupplyBuying;
    use App\Http\Controllers\Controller;
    use App\Models\PrintWarehouse;
    use App\Models\SquareWarehouse;
    use App\Models\SupplyBuying;
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
            $data['supply'] = json_encode($data['supply']);
        }

        private function validateData($data)
        {
            if (empty($data['name'])) {
                return returnMessageAjax(100, 'Bạn chưa nhập tên lệnh mua !');   
            }
            if (empty($data['supply'])) {
                return returnMessageAjax(100, 'Bạn chưa có vật tư cần mua !');   
            }
            foreach ($data['supply'] as $key => $supply) {
                $num = $key + 1;
                if (empty($supply['type'])) {
                    return returnMessageAjax(100, 'Bạn chưa chọn nhóm vật tư thứ '.$num.'!');
                    break;
                }
                if (empty($supply['target'])) {
                    return returnMessageAjax(100, 'Bạn chưa chọn loại vật tư thứ '.$num.'!');
                    break;
                }
                if (SupplyBuying::hasSizeSupply($supply['type'])) {
                    if (empty($supply['length'])) {
                        return returnMessageAjax(100, 'Bạn chưa nhập KT chiều dài cho vật tư thứ '.$num.'!');
                        break;
                    }
                    if (empty($supply['width'])) {
                        return returnMessageAjax(100, 'Bạn chưa nhập KT chiều rộng cho vật tư thứ '.$num.'!');
                        break;
                    }
                }
                if (empty($supply['qty'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập số lượng mua thêm cho vật tư thứ '.$num.'!');
                    break;
                }
            }
            
        }    
        public function insert($request)
        {
            $nosidebar = !empty($request->input('nosidebar'));
            $table = 'supply_buyings';
            if (!$request->isMethod('POST')) {
                $data = $this->admins->getDataActionView($table, __FUNCTION__, 'Thêm mới');
                $data['action_url'] = url('insert/'.$table);
                if (!empty($request->input('name'))) {
                    if ($nosidebar) {
                        $data['action_url'] .= '?nosidebar=1';
                    }
                    $dataItem['name'] = $request->input('name');
                    $dataItem['note'] = 'Mua vật tư cho đơn hàng: '.$request->input('name');
                    $data['dataItem'] = collect($dataItem);
                }
                return view('action.view', $data);
            }else{
                $data = $request->except(['_token', 'nosidebar']);
                $vaildate = $this->validateData($data);
                if (@$vaildate['code'] == 100) {
                    return $vaildate;    
                }
                $this->processData($data);
                $data['status'] = \StatusConst::PROCESSING;
                $this->admins->configBaseDataAction($data);
                $insert_id = SupplyBuying::insertGetId($data);
                if ($insert_id) {
                    SupplyBuying::where('id', $insert_id)->update(['code' => 'CT-'.formatCodeInsert($insert_id)]);
                    $back_routes = $nosidebar ? \StatusConst::CLOSE_POPUP_NO_RELOAD : (getBackUrl() ?? url('view/'.$table));
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
                $data['nosidebar'] = $request->input('nosidebar');
                $data['dataItem'] = $dataItem;
                $data['action_url'] = url('update/'.$table.'/'.$id);
                return view('action.view', $data);
            }else{
                $data = $request->except('_token');
                $vaildate = $this->validateData($data);
                if (@$vaildate['code'] == 100) {
                    return $vaildate;    
                }
                $this->processData($data);
                $data['id'] = $id;
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
            return view('supply_buyings.supply_item', $request->all());
        }

        private function handleConfirmData($list_supp, $data_supply, $supp_buying, $data, $is_processing)
        {
            if (!$is_processing && !\GroupUser::isAdmin()) {
                return returnMessageAjax(100, 'Bạn không có quyền duyệt mua !');
            }
            $buying_total = 0;
            foreach ($list_supp as $key => $supply) {
                if (!empty($data_supply[$key]['price'])) {
                    $price = (float) $data_supply[$key]['price'];
                    $list_supp[$key]['price'] = $price;
                    $qty = (int) $data_supply[$key]['qty'];
                    $price_qtv = getFieldDataById('price_purchase', 'supply_prices', @$supply['qtv']);
                    $qtv = !empty($price_qtv) ? (float) $price_qtv : 1; 
                    $length = !empty($data_supply[$key]['length']) ? (float) $data_supply[$key]['length'] : 1; 
                    $width = !empty($data_supply[$key]['width']) ? (float) $data_supply[$key]['width'] : 1; 
                    $supp_total = $length * $width * $qtv * $price * $qty;
                    $list_supp[$key]['length'] = $length;
                    $list_supp[$key]['width'] = $width;
                    $list_supp[$key]['total'] = (int) $supp_total;
                    $list_supp[$key]['qty'] = $qty;
                    $buying_total += (int) $supp_total;
                }else{
                    return returnMessageAjax(100, 'Bạn cần nhập đầy đủ thông tin đơn giá mua !');
                }
            }
            $ship_price = (float) @$data['ship_price'];
            $other_price = (float) @$data['other_price'];
            $dataItem = $supp_buying->replicate();
            $supp_buying->supply = json_encode($list_supp);
            $supp_buying->ship_price = $ship_price;
            $supp_buying->other_price = $other_price;
            $supp_buying->total = $buying_total;
            $supp_buying->note = @$data['note'];
            $supp_buying->status = $is_processing ? \StatusConst::NOT_ACCEPTED : \StatusConst::ACCEPTED;
            $user_key = $is_processing ? 'contact_by' : 'applied_by';
            $supp_buying->{$user_key} = \User::getCurrent('id');
            $supp_buying->save();
            $action_log = $is_processing ? 'contact_confirm' : 'apply';
            logActionUserData($action_log, 'supply_buyings', $supp_buying->id, $dataItem);
            $success_mess = $is_processing ? 'Đã liên hệ với NCC '  : 'Đã duyệt mua thành công ';
            return returnMessageAjax(200, $success_mess.' cho chứng từ mua hàng '. $supp_buying->code.' !', getBackUrl());
        }

        public function confirmSupplyBought(Request $request, $status, $id)
        {
            if (\GroupUser::isAdmin() || \GroupUser::isDoBuying()) {
                $supp_buying = SupplyBuying::find($id);
                $list_supp = !empty($supp_buying->supply) ? json_decode($supp_buying->supply, true) : [];
                $data = $request->except('_token');
                $data_supply = !empty($data['supply']) ? $data['supply'] :[];
                if (count($list_supp) <= 0 || count($list_supp) != count($data_supply)) {
                    return returnMessageAjax(100, 'Dữ liệu mua hàng không hợp lệ !');    
                }
                if ($supp_buying->status != $status) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                if ($status == \StatusConst::ACCEPTED) {
                    $dataItem = $supp_buying->replicate();
                    $supp_buying->status = SupplyBuying::BOUGHT;
                    $supp_buying->bought_by = \User::getCurrent('id');
                    $supp_buying->save();
                    logActionUserData('confirm_bought', 'supply_buyings', $id, $dataItem);
                    return returnMessageAjax(200, 'Đã xác nhận mua vật tư thành công cho chứng từ mua hàng '. $supp_buying->code.' !', getBackUrl());
                }else{
                    return $this->handleConfirmData($list_supp, $data_supply, $supp_buying, $data, $status == \StatusConst::PROCESSING);   
                }
            }else{
                return returnMessageAjax(100, 'Không có quyền thực hiện thao tác này !');
            }
        }

        public function confirmWarehouseImported(Request $request, $id)
        {
            if (\GroupUser::isWarehouse() || \GroupUser::isAdmin()) {
                $supp_buying = SupplyBuying::find($id);
                if (@$supp_buying->status != SupplyBuying::BOUGHT) {
                    return returnMessageAjax(100, 'Vật tư chưa được xác nhận mua về !');
                }
                if (empty($request->input('bill'))) {
                    return returnMessageAjax(100, 'Bạn chưa upload hóa đơn mua hàng !');
                }
                $data_supply = !empty($supp_buying->supply) ? json_decode($supp_buying->supply, true) : [];
                if (count($data_supply) == 0) {
                    return returnMessageAjax(100, 'Dữ liệu vật tư không tồn tại !');
                }
                $supply_list = $request->input('supply');
                $bill = $request->input('bill');
                $update_supply = $data_supply;
                $where = [];
                foreach ($data_supply as $key => $supply) {
                    $type = $supply['type'];
                    $table_supply = tableWarehouseByType($type);
                    $data['log'] = [];
                    $data['log']['type'] = @$supply['supp_type'];
                    $supply_qty = (float) $supply['qty'];
                    if (SquareWarehouse::countPriceByWeight($type) && !empty($supply['width'])) {
                        $data['log']['qty'] = $supply_qty;
                        $data['log']['hank'] = (int) $supply['hank'];
                        $data['log']['weight'] = $supply_qty;
                    }elseif(SquareWarehouse::countPriceByHank($type)){
                        $data['log']['qty'] = $supply_qty;
                        $data['log']['hank'] = $supply_qty;
                        if (SquareWarehouse::isWeightSupply($type)) {
                            if (empty($supply_list[$key]['weight'])) {
                                return returnMessageAjax(100, 'Bạn chưa nhập số kg cho vật tư '. @$supply['name'].' !');
                            }
                            $weight = $supply_list[$key]['weight'];
                            $data['log']['weight'] = $weight;
                            $update_supply[$key]['weight'] = $weight;
                        }
                        if ($type == \TDConst::DECAL) {
                            $data['log']['qty'] = $supply['square'];
                            $data['log']['square'] = $supply['square'];
                        }
                    }else{
                        $data['log']['qty'] = $supply_qty;
                    }
                    $data['log']['provider'] = @$supp_buying->provider;
                    $data['log']['price'] = @$supply['price'];
                    $data['log']['bill'] = $bill;
                    $warehouse_service = new WarehouseService($table_supply);
                    $where = $supply;
                    unset($where['qty'], $where['price'], $where['total']);
                    if (!empty($where['hank'])) {
                        unset($where['hank']);
                    }
                    if (!empty($where['weight'])) {
                        unset($where['weight']);
                    }
                    if (!empty($where['square'])) {
                        unset($where['square']);
                    }
                    $where['status'] = \StatusConst::IMPORTED;
                    $data['warehouse'] = $where;
                    $exist_obj = \DB::table($table_supply);
                    if (!empty($where['width'])) {
                        $width = (float) $where['width'];
                        $exist_obj->whereBetween('width', [$width - 0.1, $width + 0.1]);
                        unset($where['width']);
                    }
                    if (!empty($where['length'])) {
                        $length = (float) $where['length'];
                        $exist_obj->whereBetween('length', [$length - 0.1, $length + 0.1]);
                        unset($where['length']);
                    }
                    $exist_obj->where($where);
                    $exist_supply = $exist_obj->first();
                    if (!empty($exist_supply)) {
                        $status = $warehouse_service->update($data, $exist_supply->id, 1);
                        
                    }else{
                        $status = $warehouse_service->insert($data, 1);
                    }
                    if (@$status['code'] == 100) {
                        return $status;
                    }
                }
                $dataItem = $supp_buying->replicate();
                $supp_buying->status = \StatusConst::SUBMITED;
                $supp_buying->submited_by = \User::getCurrent('id');
                $supp_buying->bill = $bill;
                $supp_buying->supply = json_encode($update_supply);
                $supp_buying->save();
                logActionUserData('confirm_import', 'supply_buyings', $id, $dataItem);
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
            if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting() && !\GroupUser::isDoBuying()) {
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
                                    "emulsion":"Nhũ",
                                    "skrink":"Màng co",
                                    "other":"Vật tư khác"
                                }
                            }
                        }'
                    ],
                ];
                $data['is_supply'] = 1;
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
            $where = [['status', '=', \StatusConst::IMPORTED]];
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
        
        private function handleWhereInventory($request)
        {
            $wheres = $request->except('is_ajax', 'is_detail');
            if (!empty($wheres['type'])) {
                $wheres['table'] = tableWarehouseByType($wheres['type']);
                unset($wheres['type']);
            }
            return $wheres;
        }

        public function inventoryDetail(Request $request) {
            $is_ajax = $request->input('is_ajax') == 1;
            if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting() && !\GroupUser::isDoBuying()) {
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
            $wheres = $this->handleWhereInventory($request);
            $this->admins->tableDataInventoryDetail($wheres, 'warehouse_histories', $data);
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
            $wheres = $this->handleWhereInventory($request);
            $this->admins->tableDataInventoryDetail($wheres, 'warehouse_histories', $data);
            return Excel::download(new ExportExcelService($data,  'inventories.detail'), 'SO_CHI_TIET_VAT_TU_HANG_HOA.xlsx');
        }

        public function inventoryExport(Request $request)
        {
            if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting() && !\GroupUser::isDoBuying()) {
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
            $data['fields'] = $table == 'print_warehouses' ? PrintWarehouse::getFieldSearch() : (new \App\Services\AdminService())->getFieldAction($table, 'search', [['key' => 'type', 'value' => $type]]);
            $data['default_field']['type'] = $type;
            return view('inventories.field_search', $data);
        }

        public function getViewBuyingSupplyType(Request $request)
        {
            $type = $request->input('supp_type');
            if (empty($type)) {
                return '';
            }
            $index = $request->input('index');
            $data = getViewSuppluBuyingByType($type, $index);
            return view('supply_buyings.field_buying', $data);
        }

        public function supplyDebt(Request $request)
        {
            if (\GroupUser::isAdmin() || \GroupUser::isAccounting()) {
                $where = $request->except('nosidebar');
                $data = $this->admins->getDataDebt('supply_buyings', $where);
                $data['title'] = 'Chi tiết công nợ';
                $data['link_search'] = 'supply-debt';
                $data['link_insert'] = 'ajax-respone/insertSupplyPayment';
                $data['size_popup'] = 'medium_popup';
                $data['nosidebar'] = $request->input('nosidebar');
                return view('debts.view', $data);
            }else{
                return back()->with('error', 'Bạn không có quyền xem chi tiết công nợ !', \StatusConst::CLOSE_POPUP);
            }
        }
    }
