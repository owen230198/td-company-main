<?php
    namespace App\Http\Controllers\CSupply;
    use App\Http\Controllers\Controller;
    use App\Models\CSupply;
use App\Models\SquareWarehouse;
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
            $table_supply = tableWarehouseByType($type);
            $supply = getDetailDataObject($table_supply, $data['size_type']);
            if (empty($supply)) {
                return returnMessageAjax(100, 'Dữ liệu vật tư không tồn tại!');
            }
            if (SquareWarehouse::countPriceByHank($type)) {
                if ($type == \TDConst::EMULSION) {
                    if (empty($data['qty']['width'])) {
                        return returnMessageAjax(100, 'Số cm chiều rộng cần cắt đi của cuộn nhũ không hợp lệ !');
                    }
                    if ($data['qty']['width'] > $supply->width) {
                        return returnMessageAjax(100, 'Số cm chiều rộng cần cắt đi của cuộn nhũ vượt quá chiều rộng của vật tư!');
                    }
                }
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
                if (@$dataItem->status != CSupply::HANDLING) {
                    return returnMessageAjax(110, 'Dữ liệu không hợp lệ !');
                } 
                if (empty($dataItem->supp_type)) {
                    return returnMessageAjax(100, 'Bạn chưa chọn loại vật tư !');
                }
                $table_supply = tableWarehouseByType($dataItem->supp_type);
                if (empty($dataItem->supp_type)) {
                    return returnMessageAjax(100, 'Bạn chưa chọn loại vật tư !');
                }
                if (empty($dataItem->size_type)) {
                    return returnMessageAjax(100, 'Bạn chưa chọn vật tư trong kho !');
                }
                $supply = getDetailDataObject($table_supply, $dataItem->size_type);
                if (empty($supply)) {
                    return returnMessageAjax(110, 'Vật tư không có trong kho !');    
                }
                $qty = json_decode($dataItem->qty, true);
                if (empty($qty['qty'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập số lượng cần xuất !');
                }
                $type = $dataItem->supp_type;
                $data_log['name'] = $supply->name;
                $data_log['table'] = $table_supply;
                $data_log['type'] = $type;
                $data_log['target'] = $supply->id;
                $data_log['exported'] = $qty['qty'];
                $qty_export = SquareWarehouse::isWeightLogWarehouse($type) ? $qty['weight'] : $qty['qty'];
                $data_log['ex_inventory'] = $qty_export;
                $data_log['inventory'] = SquareWarehouse::isWeightLogWarehouse($type) ? $supply->weight : $supply->qty;
                $unit = getUnitSupplyLogWarehouse($type, $supply);
                $data_log['unit'] = $unit;
                $data_log['product'] = $dataItem->product;
                $data_log['c_supply'] = $id;
                (new \BaseService)->configBaseDataAction($data_log);
                \DB::table('warehouse_histories')->insert($data_log);
                $data_update = ['status' => CSupply::HANDLED];
                // $update = $command->where('id' , $id)->update($data_update);
                if ($update) {
                    return returnMessageAjax(200, 'Bạn đã xác nhận xuất '.$qty_export.' ('.$unit.') vật tư!', \StatusConst::RELOAD);
                }  
            }else{
                return returnMessageAjax(110, 'Bạn không có quyền duyệt xuất vật tư!');
            }
        }
    }
?>