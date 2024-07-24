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
                return returnMessageAjax(200, 'Thêm mới dữ liệu khách hàng thành công !', getBackUrl());   
            }
        }
    }
?>