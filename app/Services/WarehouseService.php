<?php
    namespace App\Services;
    use App\Services\BaseService;
    use App\Services\AdminService;
    use App\Models\WarehouseHistory;
    class WarehouseService extends BaseService
    {
        function __construct()
        {
            parent::__construct();
        }

        public function insert($table, $param)
        {
            $data = (new AdminService)->getDataActionView($table, __FUNCTION__, 'Thêm mới', $param);
            $data['action_url'] = url('insert/'.$table);
            $data['field_list'] = $data['field_list'];
            $data['field_logs'] = WarehouseHistory::FIELD_INSERT;
            $data['type_supp'] = $param['type'];
            return view('warehouses.actions.view', $data);
        }
        
        public function doInsert($table, $data)
        {
            $data_log = $data['log'];
            if (empty($data_log['provider'])) {
                return returnMessageAjax(100, 'Vui lòng chọn nhà cung cấp vật tư !');
            }
            if (empty($data_log['price'])) {
                return returnMessageAjax(100, 'Vui lòng nhập giá mua vật tư !');
            }
            if (empty($data_log['bill'])) {
                return returnMessageAjax(100, 'Vui lòng upload file hóa đơn mua vật tư !');
            }

            $data_warehouse = $data['warehouse'];
            $this->configBaseDataAction($data_warehouse);
            $insert_id = \DB::table($table)->insertGetId($data_warehouse);
            if ($insert_id) {
                $data_log['action'] = 'insert';
                $data_log['table'] = $table;
                $data_log['target'] = $insert_id;
                $data_log['qty'] = $data_warehouse['qty'];
                $data_log['created_by'] = \User::getCurrent('id');
                $data_log['created_at'] = date('Y-m-d H:i:s', Time()); 
                \DB::table('warehouse_histories')->insert($data_log);
                return returnMessageAjax(200, 'Đã nhập vật tư thành công !', getBackUrl());
            }else{
                return returnMessageAjax(100, 'Không thể thêm vật tư vào kho !');
            }
        }
    }
    
?>