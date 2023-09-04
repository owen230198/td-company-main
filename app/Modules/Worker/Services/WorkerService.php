<?php
namespace App\Modules\Worker\Services;
use App\Services\BaseService;
use App\Models\WSalary;

class WorkerService extends BaseService
{
	function __construct()
	{
		parent::__construct();
	}

    public function getListDataHome($worker, $where = [])
    {
        $type = @$worker['type'];
        $device = @$worker['device'];
        $where['status'] = $type; 
        if ($type == \TDConst::FILL) {
            $where['machine_type'] = $device;
        }
        return getDataWorkerCommand($type, $where);
    }

    public function receiveCommad($obj, $data_command, $worker)
    {
        if ($data_command->status == \StatusConst::PROCESSING || !empty($data_command->worker_process)) {
            $mess = 'Lệnh này đang được xử lí ';
            if (!empty($data_command->worker_process)) {
                $mess .= 'tiếp nhận bởi : '.getFieldDataById('name', 'w_users', $data_command->worker_process);
            }
            return returnMessageAjax(100, $mess.'!');
        }
        $worker_id = $worker['id'];
        $type = $worker['type'];
        if (getDataWorkerCommand($type, ['worker_process' => $worker_id], true) > 0) {
            return returnMessageAjax(100, 'Bạn cần hoàn thành lệnh đã nhận trước khi nhận lệnh mới !');
        }
        if ($data_command->status != $type || $data_command->machine_type != $worker['device']) {
            return returnMessageAjax(100, 'Bạn không thuộc tổ máy có thể nhận lệnh !');
        }
        $update = $obj->update(['status' => \StatusConst::PROCESSING, 'worker_process' => $worker_id]);
        if ($update) {
            return returnMessageAjax(200, 'Bạn đã tiếp nhận lệnh thành công, tới chi tiết lệnh để xác nhận !');
        }
    }

    public function detailCommand($data_command, $worker)
    {
        if (empty($data_command->status) || empty($data_command->code)) {
            return back()->with('error', 'Lệnh này chưa được duyệt sản xuất !');
        }
        $data['data_command'] = $data_command;
        $data['all_devices'] = \TDConst::ALL_DEVICE_KEY;
        $data['title'] = 'Chi tiết lệnh sản xuất '.$data_command->code;
        $worker_type = @$worker['type'];
        $data['data_handle'] = !empty($data_command->{$worker_type}) ? json_decode($data_command->{$worker_type}, true) : [];
        $data['data_product'] = \DB::table('products')->find($data_command->product);
        $data['view_type'] = $worker_type;
        return view('Worker::commands.view', $data);
    }

    public function submitCommand($obj, $data_command, $worker, $qty){
        $worker_id = $worker['id'];
        if ($data_command->worker_process != $worker_id) {
            return returnMessageAjax(100, 'Chấm công không thành công, Lệnh này không phải của bạn !');
        }
        if($data_command->status != \StatusConst::PROCESSING){
            return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
        }
        $type = $worker['type'];
        $data_handle = !empty($data_command->{$type}) ? json_decode($data_command->{$type}, true) : [];
        $key_handel_qty = !empty($data_handle['supp_qty']) ? 'supp_qty' : 'product_qty';
        $handle_qty = !empty($data_handle[$key_handel_qty]) ? $data_handle[$key_handel_qty] : 0;
        if (empty($qty) || $qty > $handle_qty) {
            return returnMessageAjax(100, 'Số lượng chấm công không hợp lệ !');
        }
        $obj_salary = new WSalary($data_command, $data_handle, $worker);  
        if ($type == \TDConst::PRINT) {
            $data_insert = $obj_salary->getPrintSalary($qty, $type);      
        }
        $data_update['worker_process'] = 0;
        if ($qty < $handle_qty) {
            $data_update['status'] = $type;
            $data_handle[$key_handel_qty] = $handle_qty - $qty;
            
        }else{
            $data_handle['act'] = 2;
            $data_update['status'] = getStageActiveStartHandle($data_command->table, $data_command->id, $type);
        }
        $data_update[$type] = json_encode($data_handle);
        $update = $obj->update($data_update);
        if ($update) {
            $data_insert['product'] = $data_command->product;
            $data_insert['command'] = $data_command->code;
            $data_insert['qty'] = $qty;
            $data_insert['type'] = $type;
            $this->configBaseDataAction($data_insert, 'worker_login');
            $insert = \DB::table('w_salaries')->insert($data_insert);
            if ($insert) {
                return returnMessageAjax(200, 'Bạn đã chấm công thành công với số lượng : '.$qty.' !', url('Worker'));
            }else{
                return returnMessageAjax(100, 'Có lỗi xảy ra, vui lòng thử chấm công lại !');     
            }    
        }else{
            return returnMessageAjax(100, 'Có lỗi xảy ra, vui lòng thử chấm công lại !'); 
        }
    }
}
