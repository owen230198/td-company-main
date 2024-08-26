<?php
    namespace App\Services;

    use App\Models\SquareWarehouse;
    use App\Services\BaseService;
    use App\Services\AdminService;
    use App\Models\WarehouseHistory;
    use Maatwebsite\Excel\Facades\Excel;

    class WarehouseService extends BaseService
    {
        function __construct($table)
        {
            parent::__construct();
            $this->table = $table;
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
                    'view' => 1
                ],
                \GroupUser::ACCOUNTING => [
                    'view' => 1,
                    'insert' => 1,
                ]
            ];
        } 

        static function getQtyFieldByType($type, $readonly = false)
        {
            $unit = !empty(getUnitNameByType($type)) ? ' ('.getUnitNameByType($type).')' : '';
            $field_qty = [
                'name' => 'qty',
                'type' => 'text',
                'note' => 'Số lượng nhập thêm'. $unit,
                'attr' => [
                    'type_input' => 'number', 
                    'inject_class' => '__buying_qty_input __buying_change_input', 
                    'readonly' => $readonly
                ]
            ];
            $field_hank = [
                'name' => 'hank',
                'type' => 'text',
                'note' => 'Số cuộn nhập thêm',
                'attr' => [
                    'type_input' => 'number',
                ]
            ];
            $field_weight = [
                'name' => 'weight',
                'type' => 'text',
                'note' => 'Số kg nhập thêm',
                'attr' => [
                    'type_input' => 'number',
                ]
            ];

            $field_length = [
                'name' => 'square',
                'type' => 'text',
                'note' => 'Số cm nhập thêm',
                'attr' => [
                    'type_input' => 'number',
                    'readonly' => $readonly
                ]
            ];
            
            if (SquareWarehouse::countPriceByWeight($type)) {
                return [$field_qty, $field_hank];
            }elseif (SquareWarehouse::countPriceByHank($type)) {
                $ret =  [$field_qty];
                if ($type == \TDConst::DECAL) {
                    $ret[] = $field_length;
                }else{
                    $ret[] = $field_weight;
                }
                return $ret;
            }else{
                return [$field_qty];
            }
        }
        private function validateDataWarehouse($data, $type)
        {
            $arr_field_qty = self::getQtyFieldByType($type);
            foreach ($arr_field_qty as $field_qty) {
                $name = $field_qty['name'];
                $note = strtolower($field_qty['note']);
                if (empty($data[$name])) {
                    return returnMessageAjax(100, 'Dữ liệu '.$note.' không được để trống !');
                }
            }
            // if (empty($data['provider'])) {
            //     return returnMessageAjax(100, 'Vui lòng chọn nhà cung cấp vật tư !');
            // }
            // if (empty($data['price'])) {
            //     return returnMessageAjax(100, 'Vui lòng nhập giá mua vật tư !');
            // }
            // if (empty($data['bill'])) {
            //     return returnMessageAjax(100, 'Vui lòng upload file hóa đơn mua vật tư !');
            // }
            return $arr_field_qty;
        }

        private function getDataLogAction(&$data_log)
        {
            $import_qty = $data_log['qty'];
            unset($data_log['qty']);
            if (!empty($data_log['hank'])) {
                unset($data_log['hank']);
            }
            if (!empty($data_log['weight'])) {
                unset($data_log['weight']);
            }
            if (!empty($data_log['square'])) {
                unset($data_log['square']);
            }
            return $import_qty;
        }

        private function processQtyWarehouse($type, $dataItem, $data_log, $action = 'insert'){
            $log_qty = $data_log['qty'];
            if (SquareWarehouse::countPriceByWeight($type) && !empty($dataItem->width)) {
                $ret['qty'] = (int) SquareWarehouse::getLengthByWeight($dataItem->supp_price, $log_qty, $dataItem->width);
                $ret['hank'] = (int) $data_log['hank'];
                $ret['weight'] = $log_qty;
            }elseif(SquareWarehouse::countPriceByHank($type)){
                $ret['hank'] = $log_qty;
                if ($type == \TDConst::DECAL) {
                    $ret['qty'] = $data_log['square'];
                }else{
                    $ret['weight'] = (int) $data_log['weight'];
                }
            }else{
                $ret['qty'] = $log_qty;
            }
            if ($action == 'update') {
                foreach ($ret as $key => $value) {
                    $ret[$key] = $value + (float) $dataItem->{$key};
                }
            }
            return $ret;
        }

        public function insert($param, $type_request = 0)
        {
            $table = $this->table;
            if ($type_request == 1) {
                $data_log = $param['log'];
                $data_warehouse = $param['warehouse'];
                $type = $data_warehouse['type'];
                $arr_log = $this->validateDataWarehouse($data_log, $type);
                if (@$arr_log['code'] == 100) {
                    return $arr_log;
                }
                $model = getModelByTable($table);
                $name = @$data_warehouse['name'] ?? $model::getName($data_warehouse);
                $data_warehouse['name'] = $name;
                $this->configBaseDataAction($data_warehouse);
                $insert_id = $model::insertGetId($data_warehouse);
                if ($insert_id) {
                    $dataItem = $model::find($insert_id);
                    $update_qty = $this->processQtyWarehouse($type, $dataItem, $data_log);
                    \DB::table($table)->where('id', $insert_id)->update($update_qty);
                    $import_qty = $this->getDataLogAction($data_log);
                    WarehouseHistory::doLogWarehouse($type, $insert_id, $import_qty, 0, 0, 0, $data_log);
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
                $arr_log = $this->validateDataWarehouse($data_log, $type);
                if (@$arr_log['code'] == 100) {
                    return $arr_log;
                }
                $this->configBaseDataAction($data_warehouse);
                $update_qty = $this->processQtyWarehouse($type, $dataItem, $data_log, 'update');
                $update = \DB::table($table)->where('id', $id)->update($update_qty);
                if ($update) {
                    $import_qty = $this->getDataLogAction($data_log);
                    $feild_log = getUnitSupplyLogWarehouse($type, 'import', true);
                    WarehouseHistory::doLogWarehouse($type, $id, $import_qty, 0, $dataItem->{$feild_log}, 0, $data_log);
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