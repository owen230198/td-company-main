<?php
    namespace App\Http\Controllers\SupplyBuying;
    use App\Http\Controllers\Controller;
    use App\Models\BuyingItem;
    use App\Models\PrintWarehouse;
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

        public function ProcessDataSupply($supplies, $parent)
        {
            foreach ($supplies as $supply) {
                BuyingItem::ProcessData($supply, $parent);
            }
        }

        public function validateData($data)
        {
            if (empty($data['name'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn tiêu đề lệnh mua !');   
            }
            if (empty($data['supply'])) {
                return returnMessageAjax(100, 'Bạn chưa có vật tư cần mua !');   
            }
            $validate_supply = BuyingItem::validate($data['supply']);
            if (@$validate_supply['code'] == 100) {
                return $validate_supply;
            }
            return ['supply' => $data['supply']];
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
                $data['status'] = \StatusConst::PROCESSING;
                unset($data['supply']);
                $this->admins->configBaseDataAction($data);
                $insert_id = SupplyBuying::insertGetId($data);
                if ($insert_id) {
                    $this->processDataSupply($vaildate['supply'], $insert_id);
                    SupplyBuying::getInsertCode($insert_id);
                    logActionUserData(__FUNCTION__, $table, $insert_id, $data);
                    $back_routes = $nosidebar ? \StatusConst::CLOSE_POPUP_NO_RELOAD : (getBackUrl() ?? url('view/'.$table));
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
                $dataItem['supply'] = BuyingItem::where('parent', $id)->get();
                $data['dataItem'] = $dataItem;
                $data['action_url'] = url('update/'.$table.'/'.$id);
                return view('action.view', $data);
            }else{
                $data = $request->except('_token');
                $vaildate = $this->validateData($data);
                if (@$vaildate['code'] == 100) {
                    return $vaildate;    
                }
                $data['id'] = $id;
                unset($data['supply']);
                $this->admins->configBaseDataAction($data);
                $update = SupplyBuying::where('id', $id)->update($data);
                if ($update) {
                    $this->processDataSupply($vaildate['supply'], $id);
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

        public function confirmSupplyBought(Request $request, $status, $id)
        {
            $is_apply_action = $status == \StatusConst::NOT_ACCEPTED;
            if (\GroupUser::isAdmin() || (\GroupUser::isDoBuying() && !$is_apply_action) || (\GroupUser::isApplyBuying() && $is_apply_action)) {
                $buyingItem = BuyingItem::find($id);
                if ($buyingItem->status != $status) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                }
                $data = $request->except('_token');
                $data_supply = !empty($data['supply']) ? $data['supply'] :[];
                $validate = BuyingItem::validate($data_supply);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $data_update = reset($data['supply']);
                $data_update['note'] = @$data['note'];
                BuyingItem::where('id', $id)->update($data_update);
                $dataItem = $buyingItem->replicate();
                $buyingItem->status = $is_apply_action ? SupplyBuying::BOUGHT : \StatusConst::NOT_ACCEPTED;
                $key_log_action = $is_apply_action ? 'applied_by' : 'contact_by';
                $buyingItem->{$key_log_action} = \User::getCurrent('id');
                $action_log = $is_apply_action ? 'apply' : 'contact_confirm';
                $buyingItem->save();
                logActionUserData($action_log, 'buying_items', $id, $dataItem);
                $title_mess = $is_apply_action ? 'duyệt mua' : 'hỏi mua';
                if (!empty($buyingItem->parent)) {
                    SupplyBuying::checkUpdateStatus($buyingItem->parent, $buyingItem->status);
                }
                return returnMessageAjax(200, 'Đã xác nhận '.$title_mess.' vật tư thành công !', getBackUrl());
            }else{
                return returnMessageAjax(100, 'Không có quyền thực hiện thao tác này !');
            }
        }

        public function confirmWarehouseImported(Request $request, $id)
        {
            $is_ajax = $request->isMethod('POST');
            if (\GroupUser::isWarehouse() || \GroupUser::isAdmin()) {
                $buyingItem = BuyingItem::find($id);
                if (@$buyingItem->status != SupplyBuying::BOUGHT || empty($buyingItem->type)) {
                    return customReturnMessage(false, $is_ajax, ['message' => 'Dữ liệu không hợp lệ !']);
                }
                if (!$is_ajax) {
                    $data['title'] = 'Xác nhận nhập kho vật tư ';
                    $dataItem = $buyingItem->replicate();
                    $dataItem->qty = 0;
                    $dataItem->lenth_qty = 0;
                    $dataItem->weight = 0;
                    $dataItem->total = 0;
                    $data['dataItem'] = $dataItem;
                    $data['field_exts'] = [
                        [
                           'name' => 'other_price',
                           'note' => 'Chi phí phát sinh',
                           'attr' => [
                                'type_input' => 'price',
                                'inject_class' => '__buying_other_price_input __buying_change_input'
                            ],
                           'type' => 'text'
                        ],
                        [
                            'name' => 'receipt',
                            'attr' => ['required' => 1],
                            'note' => 'Phiếu nhập kho',
                            'type' => 'filev2',
                            'value' => '',
                            'other_data' => ['role_update' => [\GroupUser::WAREHOUSE]] 
                        ],
                        [
                            'name' => 'note',
                            'note' => 'Ghi chú thanh toán',
                            'type' => 'textarea',
                            'value' => ''
                        ]
                    ];
                    $data['no_suggest'] = 1;
                    $data['action_url'] = url('confirm-warehouse-imported/'.$id);
                    return view('buying_items.view', $data);    
                }else{
                    $data = $request->all();
                    $data_supply = reset($data['supply']);
                    $deliveried = (float)$buyingItem->deliveried;
                    $data_qty = (float) $data_supply['qty'];
                    $qty_buy = $deliveried + $data_qty;
                    $qty = (float) $buyingItem->qty;
                    if ($qty_buy > $qty) {
                        return customReturnMessage(false, $is_ajax, ['message' => 'Số lượng đã nhập đã đạt số lượng yêu cầu mua về!']);
                    }
                    $type = $data_supply['type'];
                    $isSizeSupp = SupplyBuying::hasSizeSupply($type);
                    $param['log']['qty'] = $data_qty;
                    if ($isSizeSupp) {
                        $param['log']['lenth_qty'] = $data_supply['lenth_qty'];
                        $param['log']['weight'] = $data_supply['weight'];
                    }
                    $param['log']['provider'] = @$data_supply['provider'];
                    $param['log']['price'] = @$data_supply['price'];
                    $param['log']['other_price'] = @$data['other_price'];
                    $param['log']['total'] = @$data_supply['total'];
                    $param['log']['bill'] = $data['receipt'];
                    $param['log']['buying_item'] = $id;
                    $where = ['type' => $type, 'target' => $data_supply['target'], 'qtv' => $data_supply['qtv']]; 
                    $where['status'] = \StatusConst::IMPORTED;
                    if (!empty($data_supply['name']) && $data_supply['target'] == \StatusConst::OTHER) {
                        $where['name'] = $data_supply['name'];
                    }
                    if ($isSizeSupp) {
                        $where['width'] = $data_supply['width'];
                        $where['length'] = $data_supply['length'];
                    }
                    $exist_obj = \DB::table('supply_warehouses');
                    $param['warehouse'] = $where;
                    if (!empty($where['width'])) {
                        $width = (float) $where['width'];
                        $exist_obj->whereBetween('width', getRangeFloatNumber($width));
                        unset($where['width']);
                    }
                    if (!empty($where['length'])) {
                        $length = (float) $where['length'];
                        $exist_obj->whereBetween('length', getRangeFloatNumber($length));
                        unset($where['length']);
                    }
                    $exist_obj->where($where);
                    $exist_supply = $exist_obj->first();
                    $warehouse_service = new WarehouseService('supply_warehouses', $type);
                    if (!empty($exist_supply)) {
                        $status = $warehouse_service->update($param, $exist_supply->id, 1);
                    }else{
                        $status = $warehouse_service->insert($param, 1);
                    }
                    if (@$status['code'] == 100) {
                        return $status;
                    }
                }
                if ($qty_buy == $qty) {
                    $buyingItem->status = \StatusConst::SUBMITED;
                    SupplyBuying::checkUpdateStatus($buyingItem->parent, \StatusConst::SUBMITED);
                }
                $buyingItem->deliveried += $data_qty;
                $buyingItem->save();
                return returnMessageAjax(200, 'Xác nhận nhập kho thành công !', \StatusConst::CLOSE_POPUP);
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
                                    "rubber":"Cao su non",
                                    "styrofoam":"Mút phẳng",
                                    "decal":"Nhung",
                                    "silk":"Vải lụa",
                                    "mica":"Mi ca",
                                    "magnet":"Nam châm",
                                    "emulsion":"Nhũ",
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
