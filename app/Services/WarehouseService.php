<?php
    namespace App\Services;

use App\Models\SquareWarehouse;
use App\Models\SupplyWarehouse;
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
                ]
            ];
        } 

        static function getQtyFieldByType($type, $readonly = false)
        {
            $unit = !empty(getUnitNameByType($type)) ? ' ('.getUnitNameByType($type).')' : '';
            $field_qty = [
                'name' => 'qty',
                'type' => 'text',
                'note' => 'Số lượng'. $unit,
                'attr' => [
                    'type_input' => 'number', 
                    'inject_class' => '__buying_qty_input __buying_change_input', 
                    'readonly' => $readonly
                ]
            ];
            $field_hank = [
                'name' => 'hank',
                'type' => 'text',
                'note' => 'Số cuộn',
                'attr' => [
                    'type_input' => 'number',
                    'readonly' => $readonly
                ]
            ];
            $field_weight = [
                'name' => 'weight',
                'type' => 'text',
                'note' => 'Số kg',
                'attr' => [
                    'type_input' => 'number',
                    'readonly' => $readonly
                ]
            ];

            $field_weight = [
                'name' => 'weight',
                'type' => 'text',
                'note' => 'Số kg',
                'attr' => [
                    'type_input' => 'number',
                    'readonly' => $readonly
                ]
            ];

            $field_length = [
                'name' => 'square',
                'type' => 'text',
                'note' => 'Số cm',
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
        private function validateDataWarehouse($data)
        {
            // if (empty($data['provider'])) {
            //     return returnMessageAjax(100, 'Vui lòng chọn nhà cung cấp vật tư !');
            // }
            // if (empty($data['price'])) {
            //     return returnMessageAjax(100, 'Vui lòng nhập giá mua vật tư !');
            // }
            // if (empty($data['bill'])) {
            //     return returnMessageAjax(100, 'Vui lòng upload file hóa đơn mua vật tư !');
            // }
        }

        private function getDataLogAction(&$data_log)
        {
            $data_log['table'] = $this->table;
            $data_log['created_by'] = \User::getCurrent('id');
            $data_log['created_at'] = \Carbon\Carbon::now(); 
        }

        public function insert($param, $type_request = 0)
        {
            if ($type_request == 1) {
                $data_log = $param['log'];
                $data_warehouse = $param['warehouse'];
                if (!empty($data_log['hank'])) {
                    $data_warehouse['hank'] = @$data_log['hank'];
                    unset($data_log['hank']);
                }
                if (!empty($data_log['weight'])) {
                    $data_warehouse['weight'] = @$data_log['weight'];
                    if (empty($data_log['qty'])) {
                        $data_log['qty'] = @$data_log['weight'];
                    }
                    unset($data_log['weight']);
                }
                if ($data_warehouse['type'] != \TDConst::SKRINK) {
                    $data_warehouse['qty'] = @$data_log['qty'];
                }
                $validate = $this->validateDataWarehouse($data_log);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $model = getModelByTable($this->table);
                $name = @$data_warehouse['name'] ?? $model::getName($data_warehouse);
                $data_warehouse['name'] = $name;
                $this->configBaseDataAction($data_warehouse);
                $insert_id = $model::insertGetId($data_warehouse);
                if ($insert_id) {
                    $data_log['name'] = $name;
                    $data_log['target'] = $insert_id;
                    $data_log['ex_inventory'] = 0;
                    $data_log['imported'] = $data_log['qty'];
                    $data_log['exported'] = 0;
                    $data_log['inventory'] = $data_log['qty'];
                    $this->getDataLogAction($data_log);
                    unset($data_log['qty']);
                    \DB::table('warehouse_histories')->insert($data_log);
                    return returnMessageAjax(200, 'Đã nhập vật tư thành công !', getBackUrl());
                }else{
                    return returnMessageAjax(100, 'Không thể thêm vật tư vào kho !');
                }
            }else{
                $where = !empty($param['type']) ? [['key' => 'type', 'value' => $param['type']]] : [];
                $data = (new AdminService)->getDataActionView($this->table, __FUNCTION__, 'Thêm mới', $param, $where);
                $data['action_url'] = url('insert/'.$this->table);
                $data['field_logs'] = WarehouseHistory::getFieldAction(@$param['type']);
                if (!empty($param['type'])) {
                    $data['type_supp'] = $param['type'];
                }
                return view('warehouses.actions.view', $data);
            }
        }
        
        public function update($param, $id, $type_request = 0)
        {
            $dataItem = getModelByTable($this->table)->find($id);
            if (@$dataItem->status != SupplyWarehouse::IMPORTED) {
                return customReturnMessage(false, $type_request == 1, ['message' => 'Không thể cập nhật số lượng cho vật tư này !']);
            }
            if ($type_request == 1) {
                $data_log = $param['log'];
                $data_warehouse = $param['warehouse'];
                if (!empty($data_log['hank'])) {
                    $data_warehouse['hank'] = (float) $dataItem['hank'] + (float) $data_log['hank'];
                    unset($data_log['hank']);
                }
                if (!empty($data_log['weight'])) {
                    $data_warehouse['weight'] = @(float) $dataItem['weight'] + (float) $data_log['weight'];
                    if (empty($data_log['qty'])) {
                        $data_log['qty'] = $data_log['weight'];
                    }
                    unset($data_log['weight']);
                }
                $is_skrink = $data_warehouse['type'] != \TDConst::SKRINK;
                if ($is_skrink) {
                    $data_warehouse['qty'] = (float) $dataItem['qty'] + (float) $data_log['qty'];
                }
                $validate = $this->validateDataWarehouse($data_log);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $model = getModelByTable($this->table);
                $name = @$dataItem['name'] ?? $model::getName($dataItem);
                $data_warehouse['name'] = $name;
                $this->configBaseDataAction($data_warehouse);
                $update = $model::where('id', $id)->update($data_warehouse);
                if ($update) {
                    $data_log['name'] = $name;
                    $data_log['target'] = $id;
                    $data_log['exported'] = 0;
                    $data_log['imported'] = @$data_log['weight'] ?? $data_log['qty'];
                    $data_log['ex_inventory'] = @$dataItem['weight'] ?? $dataItem['qty'];
                    $data_log['inventory'] = @$data_warehouse['weight'] ?? @$data_warehouse['qty'];
                    $this->getDataLogAction($data_log);
                    unset($data_log['qty']);
                    \DB::table('warehouse_histories')->insert($data_log);
                    return returnMessageAjax(200, 'Đã nhập thêm thành công '.$data_log['imported'].' vật tư !', getBackUrl());
                }   
            }else{
                $where = !empty($param['type']) ? [['key' => 'type', 'value' => $param['type']]] : [];
                $data = (new AdminService)->getDataActionView($this->table, 'update', 'Chi tiết', $param, $where);
                $data['title'] = !empty($dataItem['name']) ? 'Chi tiết '.@$dataItem['name'] : @$data['title'];
                $data['action_url'] = url('update/'.$this->table.'/'.$id);
                $data['field_logs'] = WarehouseHistory::getFieldAction(@$param['type']);;
                if (!empty($param['type'])) {
                    $data['type_supp'] = $param['type'];
                }
                $data['dataItem'] = $dataItem;
                $data['data_item_log'] = WarehouseHistory::where(['table' => $this->table, 'target' => $id])->orderBy('created_at', 'desc')->paginate(20);
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