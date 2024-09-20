<?php
    namespace App\Http\Controllers\COrder;
    use App\Http\Controllers\Controller;
    use App\Imports\ImportCOrder;
    use App\Models\COrder;
use App\Models\Customer;
use App\Models\Represent;
use Maatwebsite\Excel\Facades\Excel;

    class COrderController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->table = 'c_orders';
        }

        public function getDataView($action)
        {
            $data = $this->admins->getDataActionView($this->table, $action, $action == 'insert' ? 'Thêm mới' : 'Chi tiết');
            $field_list = $data['field_list'];
            $data['field_customers'] = array_slice($field_list, 0, 2);
            $data['field_costs'] = array_slice($field_list, 2);
            return $data;
        }

        public function processData(&$data)
        {
            if (empty($data['type'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn loại hàng (hàng đặt hoặc hàng bán sẵn) !');
            }
            $type = $data['type'];
            if (empty($data['customer'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn khách hàng - công ty !');
            }
            if (empty($data['represent'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn người đại diện công ty !');
            }
            if ($type == COrder::ORDER && empty($data['order'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn đơn khách hàng đã đặt sản xuất !');
            }
            if (in_array($type, [COrder::ORDER, COrder::SELL])) {
                if (empty($data['object'])) {
                    return returnMessageAjax(100, 'Bạn cần thêm thành phẩm cho chứng từ !');
                }
                foreach ($data['object'] as $key => $object) {
                    $temp_name = 'mặt hàng '.$key + 1;
                    $validate = COrder::validateArrObject($object, $temp_name);
                    if (@$validate['code'] == 100) {
                        return $validate;
                    }
                }
                $data['object'] = json_encode($data['object']);
            }
            if ($type == COrder::ADVANCE && empty($data['advance'])) {
                return returnMessageAjax(100, 'Bạn chưa nhập tiền tạm ứng cho phiếu này !');
            }

            if ($type == COrder::OTHER && empty($data['other_price'])) {
                return returnMessageAjax(100, 'Bạn chưa nhập chi phí khác cho phiếu này !');
            }

            
            $data['name'] = getFieldDataById('name', 'customers', $data['customer']);
            $data['order'] = !empty($data['order']) ? $data['order'] : 0;
        }

        public function insert($request)
        {
            $table = $this->table;
            if (!$request->isMethod('POST')) {
                $data = $this->getDataView(__FUNCTION__);
                $data['action_url'] = url('insert/'.$table);
                $data['check_readonly'] = COrder::canHandle() ? 0 : 1;
                $data['nosidebar'] = $request->input('nosidebar');
                $data['dataItem'] = $request->except(['nosidebar']);
                return view('c_orders.view', $data);
            }else{
                $data = $request->except(['_token', 'nosidebar']);
                $process_data = $this->processData($data);
                if (@$process_data['code'] == 100) {
                    return $process_data;
                }
                $data['status'] = @$data['type'] == COrder::SELL ? \StatusConst::NOT_ACCEPTED : \StatusConst::ACCEPTED;
                $proceess= $this->admins->doInsertTable($table, $data);
                if ($proceess['code'] == 200) {
                    logActionUserData(__FUNCTION__, $table, $proceess['id'], $data);
                }else {
                    return returnMessageAjax(100, $proceess['message']);
                }
                return returnMessageAjax(200, 'Thêm chứng từ bán hàng thành công !', !empty($request->input('nosidebar')) ? \StatusConst::CLOSE_POPUP : getBackUrl());
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
                $data['check_readonly'] = COrder::canHandle() ? 0 : 1;
                $data['nosidebar'] = $request->input('nosidebar');
                return view('c_orders.view', $data);
            }else{
                $data = $request->except(['_token', 'nosidebar']);
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
                return returnMessageAjax(200, 'Cập nhật dữ liệu phiếu xuất vật tư thành công !', !empty($request->input('nosidebar')) ? \StatusConst::CLOSE_POPUP : getBackUrl());   
            }
        }

        public function import($file)
        {
            $arr_file = pathinfo($file->getClientOriginalName());
            $obj = new ImportCOrder($arr_file['filename']);
            $data = Excel::toArray($obj, $file);
            $none_customer = 0;
            $has_customer = 0;
            $data_insert = [
                'type' => COrder::OTHER,
                'advance' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'status' => \StatusConst::ACCEPTED,
                'created_by' => 25,
                'note' => 'Lấy dữ liệu công nợ tháng 9 từ phần mềm Misa'
            ];
            foreach ($data[0] as $value) {
                $name = $value['name'];
                $arr_name = explode(':', $name);
                $s_name = preg_replace('/\s*\(.*\)$/', '', $arr_name[0]);
                $customer = Customer::where('name', 'like', '%'.trim($s_name).'%')->first();
                if (!empty($customer)) {
                    $customer_id = $customer->id;
                    preg_match('/\(([^)]+)\)[^()]*$/', $arr_name[0], $matches);
                    $represent_name = !empty($matches[1]) ? $matches[1] : '';
                    if (!empty($represent_name)) {
                        $represent = Represent::where('name', 'like', '%'.trim($represent_name).'%')->first();
                    }else{
                        $represent = Represent::where('customer', $customer->id)->first();
                    }
                    $represent_id = @$represent->id;
                }else{
                    $insert_customer = [
                        'name' => $s_name,
                        'note' => 'Khách nợ lấy từ Misa',
                        'act' => 1,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                        'created_by' => 25
                    ];
                    $customer_id = Customer::insertGetId($insert_customer);
                    Customer::getInsertCode($customer_id);
                    $insert_represent = [
                        'name' => $s_name,
                        'note' => 'Khách nợ lấy từ Misa',
                        'customer' => $customer_id,
                        'act' => 1,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                        'created_by' => 25
                    ];
                    $represent_id = Represent::insertGetId($insert_represent);
                }
                $data_insert['customer'] = $customer_id;
                $data_insert['represent'] = $represent_id;
                $total = $value['total'];
                $data_insert['other_price'] = $total;
                $data_insert['total'] = $total;
                $data_insert['rest'] = $total;
                $data_insert['name'] = 'Công nợ tháng 9 - '.getFieldDataById('name', 'customers', $customer_id);
                $id = COrder::insertGetId($data_insert);
                COrder::getInsertCode($id);
            }
            return returnMessageAjax(200, 'Thành công !', \StatusConst::RELOAD);
        }
    }
?>