<?php

namespace App\Http\Controllers\SupplyBuying;
use App\Http\Controllers\Controller;
use App\Models\SupplyBuying;
use App\Models\SupplyWarehouse;
use App\Models\WarehouseHistory;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class SupplyBuyingController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function ProcessData(&$data)
    {
        $data['code'] = 'CT-'.getCodeInsertTable('supply_buyings');
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
            $insert = SupplyBuying::insert($data);
            if ($insert) {
                $back_routes = getBackUrl() ?? url('view/'.$table);
                logActionUserData(__FUNCTION__, $table, $insert, $data);
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
        if (\GroupUser::isAdmin() || \GroupUser::isApplyBuying()) {
            $supp_buying = SupplyBuying::find($id);
            if (@$supp_buying->status != \StatusConst::NOT_ACCEPTED) {
                return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
            }
            $supp_buying->status = \StatusConst::ACCEPTED;
            $supp_buying->applied_by = \User::getCurrent('id');
            $supp_buying->save();
            return returnMessageAjax(200, 'Đã duyệt mua thành công cho yêu cầu mua '. $supp_buying->code.' !', 'view/supply_buyings?default_data=%7B"status"%3A"'.\StatusConst::NOT_ACCEPTED.'"%7D');
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
                return returnMessageAjax(200, 'Đã xác nhận mua thành công cho yêu cầu mua '. $supp_buying->code.' !', 'view/supply_buyings?default_data=%7B"status"%3A"'.\StatusConst::ACCEPTED.'"%7D');
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
                $table_supply = getTableWarehouseByType((object) $supply);
                $data['log']['exported'] = (int) $supply['qty'];
                $data['log']['provider'] = @$supp_buying->provider;
                $data['log']['price'] = @$supply['price'];
                $data['log']['bill'] = @$supp_buying->bill;
                $warehouse_service = new WarehouseService($table_supply);
                $status = $warehouse_service->update($data, $supply['size_type'], 1);
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

    private function configDataAggregate($collection, &$data)
    {
        
    }

    public function inventoryAggregate(Request $request)
    {
        $is_ajax = $request->input('is_ajax') == 1;
        if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting()) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập !']);
        }
        $data['title'] = 'Tổng hợp tồn kho';
        $data['link_search'] = url('inventory-aggregate');
        if (!$is_ajax) {
            $data['fields'] = [
                [
                    'name' => 'created_at',
                    'attr' => '{"class_on_search":"change_submit"}',
                    'note' => 'Khoảng thời gian',
                    'type' => 'datetime'
                ],
                [
                    'name' => 'name',
                    'attr' => '{"class_on_search":"change_submit"}',
                    'note' => 'Tên hàng',
                    'type' => 'text'
                ],
            ];
            return view('inventories.view', $data);
        }else{
            $where = [['status', '=', SupplyWarehouse::IMPORTED]];
            if (!empty($request->input('name'))) {
                $name = '%'.$request->input('name').'%';
                $where[] = ['name', 'like', $name];
            }
            $list_data =  WarehouseHistory::getInventoryAllTable($where)->paginate(1000);
            $data['list_data'] = $list_data;
            $data['range_time'] = $request->input('created_at');
            $data['count'] = $list_data->count();
            return view('inventories.table', $data);
        }     
    }

    public function inventoryDetail(Request $request) {
        $is_ajax = $request->input('is_ajax') == 1;
        if (!\GroupUser::isAdmin() && !\GroupUser::isAccounting()) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền truy cập !']);
        }
        if (empty($request->input('table')) || empty($request->input('type')) || empty($request->input('target')) || empty($request->input('created_at'))) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Dữ liệu không hợp lệ !']);
        }
        $where = $request->except('is_ajax', 'created_at');
        $where_time = getDateRangeToQuery($request->input('created_at'));
        $obj = WarehouseHistory::where($where)->whereBetween('created_at', $where_time);
        $data['title'] = 'Sổ chi tiết vật tư hàng hóa';
        $data['is_detail'] = true;
        if (!$is_ajax) {
            $data['fields'] = [
                [
                    'name' => 'name',
                    'attr' => '{"class_on_search":"change_submit"}',
                    'note' => 'Tên hàng',
                    'type' => 'text'
                ],
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
            $data['data_item'] = $request->except('is_ajax');
            $data['link_search'] = url('inventory-detail');
            $data['nosidebar'] = true;
            $list_data = $obj->get();
            $data['list_data'] = $list_data;
        }
        $this->configDataAggregate($list_data, $data);
        return view('inventories.view', $data);
    }
}
