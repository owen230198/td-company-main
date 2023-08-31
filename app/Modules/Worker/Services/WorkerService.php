<?php
namespace App\Modules\Worker\Services;
use App\Services\BaseService;

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

    public function receiveCommad($obj, $data_commad, $worker)
    {
        if ($data_commad->status == \StatusConst::PROCESSING || !empty($data_commad->worker_process)) {
            $mess = 'Lệnh này đang được xử lí ';
            if (!empty($data_commad->worker_process)) {
                $mess .= 'tiếp nhận bởi : '.getFieldDataById('name', 'w_users', $data_commad->worker_process);
            }
            return returnMessageAjax(100, $mess.'!');
        }
        $worker_id = $worker['id'];
        $type = $worker['type'];
        if (getDataWorkerCommand($type, ['worker_process' => $worker_id], true) > 0) {
            return returnMessageAjax(100, 'Bạn cần hoàn thành lệnh đã nhận trước khi nhận lệnh mới !');
        }
        if ($data_commad->status != $type || $data_commad->machine_type != $worker['device']) {
            return returnMessageAjax(100, 'Bạn không thuộc tổ máy có thể nhận lệnh !');
        }
        $update = $obj->update(['status' => \StatusConst::PROCESSING, 'worker_process' => $worker_id]);
        if ($update) {
            return returnMessageAjax(200, 'Bạn đã tiếp nhận lệnh thành công, tới chi tiết lệnh để xác nhận !');
        }
    }

    public function detailCommand($data_commad, $worker)
    {
        if (empty($data_commad->status) || empty($data_commad->code)) {
            return back()->with('error', 'Lệnh này chưa được duyệt sản xuất !');
        }
        $data['data_command'] = $data_commad;
        $data['all_devices'] = \TDConst::ALL_DEVICE_KEY;
        $data['title'] = 'Chi tiết lệnh sản xuất '.$data_commad->code;
        $worker_type = @$worker['type'];
        $data['data_handle'] = !empty($data_commad->{$worker_type}) ? json_decode($data_commad->{$worker_type}, true) : [];
        $data['data_product'] = \DB::table('products')->find($data_commad->product);
        $data['view_type'] = $worker_type;
        return view('Worker::commands.view', $data);
    }

    public function submitCommand($obj, $data_commad, $worker){
        $worker_id = $worker['id'];
        if ($data_commad->worker_process != $worker_id) {
            return returnMessageAjax(100, 'Chấm công không thành công, Lệnh này không phải của bạn !');
        }
        $type = $worker['type'];
    }
}
