<?php
    namespace App\Services;

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

        private function validateDataWarehouse($data)
        {
            // if (empty($data['qty'])) {
            //     return returnMessageAjax(100, 'Vui lòng nhập số lượng mua thêm !');
            // }
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
                $validate = $this->validateDataWarehouse($data_log);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $data_warehouse = $param['warehouse'];
                $data_warehouse['qty'] = $data_log['qty'];
                $model = getModelByTable($this->table);
                $name = $model::getName($data_warehouse);
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
                    // \DB::table('warehouse_histories')->insert($data_log);
                    return returnMessageAjax(200, 'Đã nhập vật tư thành công !', getBackUrl());
                }else{
                    return returnMessageAjax(100, 'Không thể thêm vật tư vào kho !');
                }
            }else{
                $data = (new AdminService)->getDataActionView($this->table, __FUNCTION__, 'Thêm mới', $param);
                $data['action_url'] = url('insert/'.$this->table);
                $data['field_logs'] = WarehouseHistory::FIELD_INSERT;
                $data['type_supp'] = $param['type'];
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
                $validate = $this->validateDataWarehouse($data_log);
                if (@$validate['code'] == 100) {
                    return $validate;
                }
                $data_warehouse['qty'] = (int) $dataItem['qty'] + (int) $data_log['qty'];
                $model = getModelByTable($this->table);
                $name = $model::getName($dataItem);
                $data_warehouse['name'] = $name;
                $this->configBaseDataAction($data_warehouse);
                $update = $model::where('id', $id)->update($data_warehouse);
                if ($update) {
                    $data_log['name'] = $name;
                    $data_log['target'] = $id;
                    $data_log['exported'] = 0;
                    $data_log['imported'] = $data_log['qty'];
                    $data_log['ex_inventory'] = $dataItem['qty'];
                    $data_log['inventory'] = $data_warehouse['qty'];
                    $this->getDataLogAction($data_log);
                    unset($data_log['qty']);
                    \DB::table('warehouse_histories')->insert($data_log);
                    return returnMessageAjax(200, 'Đã nhập thêm thành công '.$data_log['imported'].' vật tư !', getBackUrl());
                }   
            }else{
                $data = (new AdminService)->getDataActionView($this->table, 'update', 'Chi tiết', $param);
                $data['title'] = !empty($dataItem['name']) ? 'Chi tiết '.@$dataItem['name'] : @$data['title'];
                $data['action_url'] = url('update/'.$this->table.'/'.$id);
                $data['field_logs'] = WarehouseHistory::FIELD_UPDATE;
                $data['type_supp'] = $param['type'];
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