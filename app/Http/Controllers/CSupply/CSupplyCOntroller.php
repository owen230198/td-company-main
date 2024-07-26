<?php
    namespace App\Http\Controllers\CSupply;
    use App\Http\Controllers\Controller;
    use App\Models\CSupply;
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
            $data['qty'] = json_encode($data['qty']);
            $table_supply = tableWarehouseByType($data['supp_type']);
            $data['name'] = getFieldDataById('name', $table_supply, $data['size_type']);
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
                if (empty($data['qty']['qty'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập số lượng cần xuất !');
                }
                $this->processData($data);
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
                $this->processData($data);
                $process = $this->admins->doUpdateTable($id, $table, $data);
                if ($process['code'] == 200) {
                    logActionUserData(__FUNCTION__, $table, $id, $dataItem);
                }else {
                    return returnMessageAjax(100, $process['message']);
                }
                return returnMessageAjax(200, 'Cập nhật dữ liệu phiếu xuất vật tư thành công !', getBackUrl());   
            }
        }
    }
?>