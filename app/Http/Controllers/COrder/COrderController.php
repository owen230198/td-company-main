<?php
    namespace App\Http\Controllers\COrder;
    use App\Http\Controllers\Controller;
    use App\Models\COrder;
use App\Models\ProductWarehouse;
use Illuminate\Http\Request;

    class COrderController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->table = 'c_orders';
        }

        private function getDataView($action)
        {
            $data = $this->admins->getDataActionView($this->table, $action, $action == 'insert' ? 'Thêm mới' : 'Chi tiết');
            $field_list = $data['field_list'];
            $data['field_customers'] = array_slice($field_list, 0, 2);
            $data['field_costs'] = array_slice($field_list, 2);
            return $data;
        }

        private function processData(&$data)
        {
            if (empty($data['type'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn loại hàng (hàng đặt hoặc hàng bán sẵn) !');
            }
            if (empty($data['customer'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn khách hàng - công ty !');
            }
            if (empty($data['represent'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn người đại diện công ty !');
            }
            if ($data['type'] == COrder::ORDER && empty($data['order'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn đơn khách hàng đã đặt sản xuất !');
            }
            if (empty($data['object'])) {
                return returnMessageAjax(100, 'Bạn cần thêm thành phẩm cho chứng từ !');
            }
            foreach ($data['object'] as $key => $object) {
                $temp_name = 'mặt hàng '.$key + 1;
                if (empty($object['id'])) {
                    return returnMessageAjax(100, 'Bạn chưa chọn thành phẩm cho '.$temp_name.' !');
                }
                $product = ProductWarehouse::find($object['id']);
                if (empty($product)) {
                    return returnMessageAjax(100, 'Dữ liệu '.$temp_name.' Không tồn tại hoặc đã bị xóa !');
                }
                $name = !empty($product->name) ? $product->name : $temp_name;
                if (empty($object['qty'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập số lượng cho '.$name.' !');
                }
                if ((int) $object['qty'] > (int) $product->qty) {
                    return returnMessageAjax(100, 'Tồn kho'.$name.' không đủ để xuất cho đơn này !');
                }
            }
            $data['object'] = json_encode($data['object']);
            $data['name'] = getFieldDataById('name', 'customers', $data['customer']);
            $data['order'] = !empty($data['order']) ? $data['order'] : 0;
        }

        public function insert($request)
        {
            $table = $this->table;
            if (!$request->isMethod('POST')) {
                $data = $this->getDataView(__FUNCTION__);
                $data['action_url'] = url('insert/'.$table);
                $data['check_readonly'] = \GroupUser::isAdmin() || \GroupUser::isSale() ? 0 : 1;
                return view('c_orders.view', $data);
            }else{
                $data = $request->except(['_token']);
                $process_data = $this->processData($data);
                if (@$process_data['code'] == 100) {
                    return $process_data;
                }
                $data['status'] = \StatusConst::NOT_ACCEPTED;
                $proceess= $this->admins->doInsertTable($table, $data);
                if ($proceess['code'] == 200) {
                    logActionUserData(__FUNCTION__, $table, $proceess['id'], $data);
                }else {
                    return returnMessageAjax(100, $proceess['message']);
                }
                return returnMessageAjax(200, 'Thêm chứng từ bán hàng thành công !', getBackUrl());
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
                $data['check_readonly'] = \GroupUser::isAdmin() || \GroupUser::isSale() ? 0 : 1;
                return view('c_orders.view', $data);
            }else{
                $data = $request->except(['_token']);
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
    }
?>