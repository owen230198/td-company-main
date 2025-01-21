<?php
    namespace App\Services;

use App\Models\ProviderDebt;
use App\Models\SupplyBuying;
    use App\Services\BaseService;
    use App\Services\AdminService;
    use App\Models\WarehouseHistory;
    use Maatwebsite\Excel\Facades\Excel;
use NunoMaduro\Collision\Contracts\Provider;

    class WarehouseService extends BaseService
    {
        function __construct($table, $type)
        {
            parent::__construct();
            $this->table = $table;
            $this->isSizeSupp = SupplyBuying::hasSizeSupply($type);
        }
        //source
        const BUY = 1;
        const OVER = 2;
        static function getRole() {
            return [
                \GroupUser::WAREHOUSE => [
                    'view' => ['with' => 
                            [
                                'type' => 'group',
                                'query' => [
                                    ['key' => 'type', 'compare' => 'in', 'value' => \User::getSupplyRole()],
                                ]
                            ],
                        ]
                    // 'insert' => 1,
                    // 'update' => 1,
                ],
                \GroupUser::PLAN_HANDLE => [
                    'insert' => 1,
                    'update' => 1,
                    'view' => 1,
                ],
                \GroupUser::ACCOUNTING => [
                    'view' => 1,
                    'insert' => 1,
                ],
                \GroupUser::DO_BUYING => [
                    'view' => 1,
                ]
            ];
        }
        private function validateDataWarehouse($data, $warehouse, $action)
        {
            if ($action == 'insert') {
                if (empty($warehouse['type']) || empty($warehouse['target']) || empty($warehouse['target'])) {
                    return returnMessageAjax(100, 'Dữ liệu vật tư nhập kho không hợp lệ !');
                }
                if ($this->isSizeSupp) {
                    if (empty($warehouse['width']) || empty($warehouse['length'])) {
                        return returnMessageAjax(100, 'Dữ liệu kích thước vật tư không hợp lệ !');
                    }
                }
            }
            if ($this->isSizeSupp && (empty($data['lenth_qty']) || empty($data['weight']))) {
                return returnMessageAjax(100, 'Dữ liệu số lượng nhập kho không hợp lệ !');   
            }
            if (empty($data['qty'])) {
                return returnMessageAjax(100, 'Số lượng nhập kho không hợp lệ !');
            }
            if (empty($data['provider'])) {
                return returnMessageAjax(100, 'Vui lòng chọn nhà cung cấp vật tư !');
            }
            if (empty($data['price'])) {
                return returnMessageAjax(100, 'Vui lòng nhập giá mua vật tư !');
            }
            if (empty($data['bill'])) {
                return returnMessageAjax(100, 'Vui lòng upload file hóa đơn mua vật tư !');
            }
        }

        private function getDataLogAction(&$data_log)
        {
            $import_qty = $data_log['qty'];
            unset($data_log['qty']);
            if (!empty($data_log['lenth_qty'])) {
                unset($data_log['lenth_qty']);
            }
            if (!empty($data_log['weight'])) {
                unset($data_log['weight']);
            }
            return $import_qty;
        }

        private function processQtyWarehouse($type, $dataItem, $data_log, $action = 'insert'){
            $ret['qty'] = $data_log['qty'];
            if ($this->isSizeSupp) {
                $data['lenth_qty'] = $data_log['lenth_qty'];
                $data['weight'] = $data_log['weight'];
            }
            if ($action == 'update') {
                foreach ($ret as $key => $value) {
                    $ret[$key] = $value + (float) $dataItem->{$key};
                }
            }
            return $ret;
        }

        function insertDebt($id, $name, $import_qty, $data_log){
            $arr_supply = [
                'supply' => $id, 
                'price' => $data_log['price'], 
                'qty' => $import_qty, 
                'other_price' => $data_log['other_price'], 
                'total' => $data_log['total'], 
                'rest' => $data_log['total'], 
                'bill' => $data_log['bill']
            ];
            ProviderDebt::insertData($name, ProviderDebt::DEBT, $data_log['provider'], $arr_supply); 
        }

        public function insert($param, $type_request = 0)
        {
            $table = $this->table;
            if ($type_request == 1) {
                $data_log = $param['log'];
                $data_warehouse = $param['warehouse'];
                $type = $data_warehouse['type'];
                $validate = $this->validateDataWarehouse($data_log, $data_warehouse, __FUNCTION__);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $model = getModelByTable($table);
                $name = @$data_warehouse['name'] ?? $model::getName($data_warehouse);
                $data_warehouse['name'] = $name;
                $this->configBaseDataAction($data_warehouse);
                $insert_id = $model::insertGetId($data_warehouse);
                if ($insert_id) {
                    $dataItem = $model::find($insert_id);
                    $update_qty = $this->processQtyWarehouse($type, $dataItem, $data_log);
                    $model::where('id', $insert_id)->update($update_qty);
                    $import_qty = $this->getDataLogAction($data_log);
                    WarehouseHistory::doLogWarehouse($insert_id, $import_qty, 0, 0, 0, $data_log);
                    if (!empty($data_log['total'])) {
                        $this->insertDebt($insert_id, $name, $import_qty, $data_log);
                    }
                    return returnMessageAjax(200, 'Đã nhập vật tư thành công !', getBackUrl());
                }else{
                    return returnMessageAjax(100, 'Không thể thêm vật tư vào kho !');
                }
            }else{
                $where = !empty($param['type']) ? [['key' => 'type', 'value' => $param['type']]] : [];
                $data = (new AdminService)->getDataActionView($table, __FUNCTION__, 'Thêm mới', $param, $where);
                $data['action_url'] = url('insert/'.$table);
                $data['field_logs'] = WarehouseHistory::getFieldAction(@$param['type']);
                if (!empty($param['type'])) {
                    $data['type_supp'] = $param['type'];
                }
                return view('warehouses.actions.view', $data);
            }
        }
        
        public function update($param, $id, $type_request = 0)
        {
            $table = $this->table;
            $dataItem = getModelByTable($table)->find($id);
            if (@$dataItem->status != \StatusConst::IMPORTED) {
                return customReturnMessage(false, $type_request == 1, ['message' => 'Không thể cập nhật số lượng cho vật tư này !']);
            }
            if ($type_request == 1) {
                $data_log = $param['log'];
                $data_warehouse = $param['warehouse'];
                $type = $data_warehouse['type'];
                $validate = $this->validateDataWarehouse($data_log, $data_warehouse, __FUNCTION__);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $this->configBaseDataAction($data_warehouse);
                $update_qty = $this->processQtyWarehouse($type, $dataItem, $data_log, 'update');
                $update = \DB::table($table)->where('id', $id)->update($update_qty);
                if ($update) {
                    $import_qty = $this->getDataLogAction($data_log);
                    $feild_log = getUnitSupplyLogWarehouse($type, 'import', true);
                    WarehouseHistory::doLogWarehouse($id, $import_qty, 0, $dataItem->{$feild_log}, 0, $data_log);
                    if (!empty($data_log['total'])) {
                        $this->insertDebt($id, $dataItem->name, $import_qty, $data_log);
                    }
                    return returnMessageAjax(200, 'Đã nhập thêm thành công '.$import_qty.' vật tư !', getBackUrl());
                }   
            }else{
                $where = !empty($param['type']) ? [['key' => 'type', 'value' => $param['type']]] : [];
                $data = (new AdminService)->getDataActionView($table, 'update', 'Chi tiết', $param, $where);
                $data['title'] = !empty($dataItem['name']) ? 'Chi tiết '.@$dataItem['name'] : @$data['title'];
                $data['action_url'] = url('update/'.$table.'/'.$id);
                $data['field_logs'] = WarehouseHistory::getFieldAction(@$param['type']);;
                if (!empty($param['type'])) {
                    $data['type_supp'] = $param['type'];
                }
                $data['dataItem'] = $dataItem;
                $data['data_item_log'] = WarehouseHistory::where(['table' => $table, 'target' => $id])->orderBy('created_at', 'desc')->paginate(20);
                return view('warehouses.actions.view', $data);
            }
        }

        public function import($file)
        {
            $arr_file = pathinfo($file->getClientOriginalName());
            $name_space = '\App\Imports\Import'.getClassByTable($this->table);
            $obj = new $name_space($arr_file['filename']);
            Excel::import($obj, $file);
            return returnMessageAjax(200, 'Đã thêm vật tư thành công !', \StatusConst::RELOAD);
        }
    }
    
?>