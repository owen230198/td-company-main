<?php
    namespace App\Http\Controllers\Customer;
    use App\Http\Controllers\Controller;
    use App\Models\Customer;
    use App\Models\Represent;
    use Illuminate\Http\Request;

    class CustomerController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->table = 'customers';
        }

        public function processDataRepresent(Request $request, $customer){
            $data_customer = Customer::find($customer);
            if (empty($data_customer)) {
                return returnMessageAjax(100, 'Khách hàng không tồn tại hoặc đã bị xóa !');
            }
            $data = $request->all();
            $represents = @$data['represent'] ?? [];
            $this->processRepresent($represents, $customer);
            return returnMessageAjax(200, 'Đã cập nhật dữ liệu Người liên hệ cho khách hàng '. $data_customer->name, \StatusConst::RELOAD);
        }

        private function processRepresent($represents, $cusomer_id)
        {
            $table = 'represents';
            foreach ($represents as $key => $represent) {
                if (empty($represent['name'])) {
                    $num = (int) $key + 1;
                    $num = $num == 1 ? 'nhất' : $num;
                    return returnMessageAjax(100, 'Bạn chưa nhập tên người liên hệ thứ '.$num.' !');
                }

                if (empty($represent['phone'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập SĐT cho '.$represent['name'].' !');
                }
                if (empty($represent['email'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập Email cho '.$represent['name'].' !');
                }
                if (empty($represent['id'])) {
                    $represent['customer'] = $cusomer_id;
                    $represent['act'] = 1;
                    $process = $this->admins->doInsertTable($table, $represent);
                    if (@$process['code'] == 100) {
                        return $process;
                    }
                    logActionUserData('insert', $table, $process['id'], $represent);
                }else{
                    $represent_id = $represent['id'];
                    $dataItem = Represent::find($represent_id);
                    if (\GroupUser::isAdmin() || isDataOwn($dataItem)) {
                        $this->admins->doUpdateTable($represent_id, $table, $represent);
                        logActionUserData('update', $table, $represent_id, $dataItem);
                    }
                }
            }
        }

        private function processField(&$data)
        {
            $data['field_list'][] = [
                'name' => 'represent', 
                'type' => 'represent', 
                'note' => 'Người Liên hệ',
                'region' => 1
            ];
        }

        public function insert($request)
        {
            $table = $this->table;
            if (!$request->isMethod('POST')) {
                $data = $this->admins->getDataActionView($table, __FUNCTION__, 'Thêm mới');
                $data['action_url'] = url('insert/'.$table);
                $this->processField($data);
                return view('action.view', $data);
            }else{
                $data_customer = $request->except(['_token', 'represent']);
                $proceess_customer = $this->admins->doInsertTable($table, $data_customer);
                if ($proceess_customer['code'] == 200) {
                    logActionUserData(__FUNCTION__, $table, $proceess_customer['id'], $data_customer);
                }else {
                    return returnMessageAjax(100, $proceess_customer['message']);
                }
                $data_represents = $request->input('represent');
                $process_reprecent = $this->processRepresent($data_represents, $proceess_customer['id']);
                if (@$process_reprecent['code'] == 100) {
                    return returnMessageAjax(100, $process_reprecent['message']);
                }
                return returnMessageAjax(200, 'Thêm mới dữ liệu khách hàng thành công !', getBackUrl());
            }
        }

        public function update($request, $id)
        {
            $table = $this->table;
            $dataItem = getModelByTable($table)->find($id);
            if (!$request->isMethod('POST')) {
                $data = $this->admins->getDataActionView($table, 'update', 'Chi tiết');
                $this->processField($data);
                $dataItem['represent'] = Represent::where('customer', $id)->get();
                $data['dataItem'] = $dataItem;
                $data['action_url'] = url('update/'.$table.'/'.$id);
                return view('action.view', $data);
            }else{
                $data_customer = $request->except(['_token', 'represent']);
                $proceess_customer = $this->admins->doUpdateTable($id, $table, $data_customer);
                if ($proceess_customer['code'] == 200) {
                    unset($dataItem['represent']);
                    logActionUserData(__FUNCTION__, $table, $id, $dataItem);
                }else {
                    return returnMessageAjax(100, $proceess_customer['message']);
                }
                $data_represents = $request->input('represent');
                $process_reprecent = $this->processRepresent($data_represents, $id);
                if (@$process_reprecent['code'] == 100) {
                    return returnMessageAjax(100, $process_reprecent['message']);
                }
                return returnMessageAjax(200, 'Cập nhật dữ liệu khách hàng thành công !', getBackUrl());   
            }
        }
    }
?>