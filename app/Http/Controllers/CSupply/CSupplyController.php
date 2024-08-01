<?php
    namespace App\Http\Controllers\CSupply;
    use App\Http\Controllers\Controller;
    use App\Models\CSupply;
use App\Models\SquareWarehouse;
use App\Models\WarehouseHistory;
use Illuminate\Http\Request;

    class CSupplyController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->table = 'c_supplies';
        }

        public function qtyBySupplyType(Request $request)
        {
            $type = $request->get('type');
            if (empty($type)) {
                return '';
            }
            $data['type'] = $type;
            return view('view_update.c_supply_qty', $data);
        }

        private function getDataView($action)
        {
            $data = $this->admins->getDataActionView($this->table, $action, 'Thêm mới');
            $field_list = $data['field_list'];
            $data['field_type'] = array_slice($field_list, 0, 1);
            $data['field_action'] = array_slice($field_list, 1);
            return $data;
        }

        private function processData(&$data)
        {
            if (empty($data['supp_type'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn loại vật tư !');
            }
            if (empty($data['size_type'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn vật tư trong kho !');
            }
            if (empty($data['qty']['qty'])) {
                return returnMessageAjax(100, 'Số lượng vật tư cần xuất không hợp lệ !');
            }
            $type = $data['supp_type'];
            $table_warehouse = tableWarehouseByType($type);
            $supply = getDetailDataObject($table_warehouse, $data['size_type']);
            if (empty($supply)) {
                return returnMessageAjax(100, 'Dữ liệu vật tư không tồn tại!');
            }
            if (SquareWarehouse::countPriceByHank($type)) {
                if (empty($data['qty']['weight'])) {
                    return returnMessageAjax(100, 'Số kg cần xuất không hợp lệ!');
                }

                if ($data['qty']['weight'] > $supply->weight) {
                    return returnMessageAjax(100, 'Số kg cần xuất vượt quá tồn kho !');
                }
                $supp_qty = $supply->hank;
            }elseif (SquareWarehouse::countPriceByWeight($type)) {
                $supp_qty = $supply->weight;
                if (!empty($data['qty']['hank']) && $data['qty']['hank'] > $supply->hank) {
                    return returnMessageAjax(100, 'Số cuộn cần xuất vượt quá tồn kho !');
                }
            }else{
                $supp_qty = $supply->qty;
            }
            if ($data['qty']['qty'] > $supp_qty) {
                return returnMessageAjax(100, 'Số lượng vật tư cần xuất vượt quá số lượng tồn kho!');
            }
            $data['qty'] = json_encode($data['qty']);
            $data['name'] = $supply->name;
        }

        public function insert($request)
        {
            $table = $this->table;
            if (!$request->isMethod('POST')) {
                $data = $this->getDataView(__FUNCTION__);
                $data['action_url'] = url('insert/'.$this->table);
                return view('c_supplies.view', $data);
            }else{
                $data = $request->except(['_token']);
                $process_data = $this->processData($data);
                if (@$process_data['code'] == 100) {
                    return $process_data;
                }
                $data['status'] = CSupply::HANDLING;
                $proceess= $this->admins->doInsertTable($table, $data);
                if ($proceess['code'] == 200) {
                    logActionUserData(__FUNCTION__, $table, $proceess['id'], $data);
                }else {
                    return returnMessageAjax(100, $proceess['message']);
                }
                return returnMessageAjax(200, 'Thêm phiếu xuất xuất vật tư thành công !', getBackUrl());
            }
        }

        public function update($request, $id)
        {
            $table = $this->table;
            $dataItem = getModelByTable($table)->find($id);
            if (!$request->isMethod('POST')) {
                $data = $this->getDataView(__FUNCTION__);
                $data['dataItem'] = $dataItem;
                $data['action_url'] = url('update/'.$table.'/'.$id);
                return view('c_supplies.view', $data);
            }else{
                $data = $request->except(['_token']);
                if (empty($data['qty']['qty'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập số lượng cần xuất !');
                }
                $process_data = $this->processData($data);
                if (@$process_data['code'] == 100) {
                    return $process_data;
                }
                $process = $this->admins->doUpdateTable($id, $table, $data);
                if ($process['code'] == 200) {
                    logActionUserData(__FUNCTION__, $table, $id, $dataItem);
                }else {
                    return returnMessageAjax(100, $process['message']);
                }
                return returnMessageAjax(200, 'Cập nhật dữ liệu phiếu xuất vật tư thành công !', getBackUrl());   
            }
        }

        public function takeOutSupply(Request $request, $id)
        {
            if (\GroupUser::isAdmin() || \GroupUser::isWarehouse()) {
                $data = $request->except('_token');
                $proceess = $this->processData($data);
                if (@$proceess['code'] == 100) {
                    return $proceess;
                }
                $dataItem = CSupply::find($id);
                $dataItem->qty = $data['qty'];
                if (empty($data['bill'])) {
                    return returnMessageAjax(100, 'Bạn chưa upload phiếu xuất kho (file giấy) !');
                }
                if (@$dataItem->status != CSupply::HANDLING) {
                    return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
                } 
                if (empty($dataItem->supp_type)) {
                    return returnMessageAjax(100, 'Bạn chưa chọn loại vật tư !');
                }
                $table_warehouse = tableWarehouseByType($dataItem->supp_type);
                if (empty($dataItem->size_type)) {
                    return returnMessageAjax(100, 'Bạn chưa chọn vật tư trong kho !');
                }
                $supply = getDetailDataObject($table_warehouse, $dataItem->size_type);
                if (empty($supply)) {
                    return returnMessageAjax(100, 'Vật tư không có trong kho !');    
                }
                $qty = json_decode($dataItem->qty, true);
                if (empty($qty['qty'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập số lượng cần xuất !');
                }
                $type = $dataItem->supp_type;
                if (SquareWarehouse::isHasDeviceSupply($type)) {
                    $length = $supply->qty - SquareWarehouse::getLengthByWeight($supply->supp_price, $qty['qty'], $supply->width);
                    $update_supply = [
                        'qty' => $length > 0 ? $length : 0,
                        'hank' => $supply->hank - (int) @$qty['hank'],
                        'weight' => $supply->weight - $qty['qty'],
                    ];     
                }elseif (SquareWarehouse::isWeightSupply($type)) {
                    $update_supply = [
                        'hank' => $supply->hank - $qty['qty'],
                        'weight' => $supply->weight - $qty['weight'],
                    ];  
                }else{
                    $update_supply = ['qty' => $supply->qty - $qty['qty']];
                }
                \DB::table($table_warehouse)->where('id', $supply->id)->update($update_supply);
                if (SquareWarehouse::isWeightSupply($type)) {
                    $qty_export = $qty['weight'];    
                }else{
                    $qty_export = $qty['qty']; 
                }
                $field_qty = SquareWarehouse::isWeightLogWarehouse($type) ? 'weight' : 'qty';
                WarehouseHistory::doLogWarehouse($type, $supply->id, 0, $qty_export, $supply->{$field_qty}, $dataItem->product, ['note' => $dataItem->note]);
                $data_update = ['status' => CSupply::HANDLED, 'bill' => $data['bill']];
                CSupply::where('id', $id)->update($data_update);
                logActionUserData('apply_import', 'c_supplies', $id, $dataItem);
                return returnMessageAjax(200, 'Bạn đã xác nhận xuất vật tư thành công!', getBackUrl());
            }else{
                return returnMessageAjax(100, 'Bạn không có quyền duyệt xuất vật tư!');
            }
        }

        public function reImportEmulsion(Request $request, $id)
        {
            if (\GroupUser::isAdmin() || \GroupUser::isWarehouse()) {
                $data = $request->except('_token');
                if (empty($data['width'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập chiều rộng cuộn nhũ!');
                }
                if (empty($data['weight'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập số kg nhũ!');
                }
                $dataItem = CSupply::find($id);
                if (empty($dataItem->supp_type) || empty($dataItem->size_type)) {
                    return returnMessageAjax(100, 'Dữ liệu vật tư không hợp lệ !');
                }
                if ($dataItem->supp_type != \TDConst::EMULSION) {
                    return returnMessageAjax(100, 'Dữ liệu vật tư không hợp lệ !');
                }
                $table_warehouse = tableWarehouseByType($dataItem->supp_type);
                $supply = getDetailDataObject($table_warehouse, $dataItem->size_type);
                if (empty($supply)) {
                    return returnMessageAjax(100, 'Vật tư nhũ không có trong kho !');    
                }
                $data_process = [];
                foreach ($supply as $key => $value) {
                    if (!in_array($key, ['id', 'qty', 'note', 'created_at', 'updated_at', 'created_by'])) {
                        $data_process[$key] = $value;
                    }
                }
                $data_process['width'] = $data['width'];
                $where = $data_process;
                $exist_data = SquareWarehouse::where($where)->first();
                $data_process['note'] = 'Nhập lại cuộn nhũ đã cắt để dùng cho đơn '.getFieldDataById('name', 'products', $dataItem->product);
                $data_process['weight'] = $data['weight'];
                $data_process['hank'] = 1;
                $this->admins->configBaseDataAction($data_process);
                if (!empty($exist_data)) {
                    $supply_id = $exist_data->id;
                    SquareWarehouse::where('id', $supply_id)->update($data_process);
                }else{
                    $supply_id = SquareWarehouse::insertGetId($data_process);    
                }
                if ($supply_id) {
                    WarehouseHistory::doLogWarehouse($dataItem->supp_type, $supply_id, 1, 0, 0, 0, 0, ['note' => $data_process['note']]);
                    return returnMessageAjax(200, 'Bạn đã nhập lại kho thành công cuộn nhũ đã cắt !', getBackUrl());
                }else{
                    return returnMessageAjax(100, 'Đã có lỗi xảy ra, vui lòng thử lại !');
                }
            }else{
                return returnMessageAjax(100, 'Bạn không có quyền thao tác!');
            }
        }
    }
?>