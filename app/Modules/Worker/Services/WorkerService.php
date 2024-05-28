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
        $where['type'] = $type; 
        $where['status'] = \StatusConst::NOT_ACCEPTED;
        if (!in_array($type, [\TDConst::FINISH])) {
            $where['machine_type'] = @$worker['device'];
        }
        return getDataWorkerCommand($where, true);
    }

    public function receiveCommad($obj, $data_command, $worker)
    {
        if ($data_command->status != \StatusConst::NOT_ACCEPTED || !empty($data_command->worker)) {
            $mess = 'Lệnh này đang được xử lí ';
            if (!empty($data_command->worker_process)) {
                $mess .= 'tiếp nhận bởi : '.getFieldDataById('name', 'w_users', $data_command->worker_process);
            }
            return returnMessageAjax(100, $mess.'!');
        }
        $worker_id = $worker['id'];
        $type = $worker['type'];
        $arr_status = ['status' => \StatusConst::PROCESSING, 'worker' => $worker_id];
        if (getDataWorkerCommand($arr_status, false, true) > 0) {
            return returnMessageAjax(100, 'Bạn cần hoàn thành lệnh trước khi nhận lệnh mới !');
        }
        $check_device = $type == \TDConst::FINISH ? true : $data_command->machine_type == $worker['device'];
        if ($data_command->type != $type || !$check_device) {
            return returnMessageAjax(100, 'Bạn không thuộc tổ máy có thể nhận lệnh !');
        }
        $update = $obj->update($arr_status);
        if ($update) {
            return returnMessageAjax(200, 'Bạn đã tiếp nhận lệnh thành công, tới chi tiết lệnh để xác nhận !');
        }
    }

    public function detailCommand($data_command, $worker, $supply)
    {
        if (@$data_command->status == \StatusConst::SUBMITED) {
            return back()->with('error', 'Dữ liệu không hợp lệ !');
        }
        $data['supply'] = $supply;
        $data['data_command'] = $data_command;
        $data['all_devices'] = \TDConst::ALL_DEVICE_KEY;
        $data['title'] = 'Chi tiết lệnh sản xuất '.$data_command->command;
        $worker_type = @$worker['type'];
        $handle = !empty($supply->{$worker_type}) ? json_decode($supply->{$worker_type}, true) : [];
        $data['data_handle'] = WSalary::getHandleDataJson($worker_type, $handle, true);
        $data['data_product'] = \DB::table('products')->find($supply->product);
        $data['view_type'] = $worker_type;
        return view('Worker::commands.view', $data);
    }

    public function checkInWorkerSalary($data_command, $type, $qty, $supply, $data_handle, $worker, $obj, $table_supply, $handle_qty)
    {
        $handle_config = $type == \TDConst::FILL ? json_decode($data_command->fill_handle, true) : $data_handle;
        $obj_salary = new WSalary($supply, $handle_config, $worker);
        switch ($type) {
            case \TDConst::PRINT:
                $data_update = $obj_salary->getPrintSalary($qty);
                break;
            case \TDConst::NILON:
                $data_update = $obj_salary->getNilonSalary($qty);
                break;
            case \TDConst::METALAI:
                $data_update = $obj_salary->getMetalaiSalary($qty);
                break;
            case \TDConst::FINISH:
                $data_update = $obj_salary->getFinishSalary($qty);
                break;
            case \TDConst::ELEVATE:
                $handle_elevate = !empty($supply->handle_elevate) ? json_decode($supply->handle_elevate, true) : [];
                $elevate_num = !empty($handle_elevate['num']) ? (int) $handle_elevate['num'] : 1;
                $data_update = $obj_salary->getBaseSalaryPaper($qty * $elevate_num);
                break;
            case !isQtyFormulaBySupply($type):
                $data_update = $obj_salary->getBaseSalaryProduct($qty);
                break;
            default:
                $data_update = $obj_salary->getBaseSalaryPaper($qty);
                break;
        }
        // $data_update['status'] = \StatusConst::SUBMITED;
        $data_update['qty'] = $qty;
        $data_update['submited_at'] = \Carbon\Carbon::now();
        $update = $obj->update($data_update);
        if ($update) {
            $qty_check_update = (int) @$data_handle['handle_qty'];
            $next_data = getStageActiveStartHandle($table_supply, $data_command->supply, $type);
            if ($next_data['type'] != \StatusConst::SUBMITED) {
                //Nếu không phải là bước hoàn tất của sản lệnh
                if (isQtyFormulaBySupply($type) && !isQtyFormulaBySupply($next_data['type'])) {
                    //nếu CT lương của lệnh hiện tại tính bằng SL vật tư và CT lương của bước tiếp theo tính bằng sl sản phẩm
                    $next_qty = $qty * $supply->nqty;
                }elseif (!isQtyFormulaBySupply($type) && isQtyFormulaBySupply($next_data['type'])) {
                    //nếu CT lương của lệnh hiện tại tính bằng SL sản phẩm và CT lương của bước tiếp theo tính bằng sl vật tư
                    $next_qty = ceil($qty / $supply->nqty);
                }else{
                    $next_qty = $qty;
                }
                if ($type == \TDConst::FILL) {
                    //Nếu là bước bồi thì cần phải hoàn tất cả các công đoạn bồi mới được xuống bước hoàn thiện cuối
                    $fill_next = checkFillToFinish($supply, $data_handle, $next_data['type']);
                    $is_next = $fill_next['bool'];
                    if ($is_next && !empty($fill_next['count_handle'])) {
                        $next_qty = (int) $fill_next['min_command'];
                        $qty_check_update = $qty_check_update * $fill_next['count_handle'];
                    }
                }else{
                    $is_next = true;
                }
                if ($is_next) {
                    //thêm lệnh cho công đoạn tiếp theo
                    $where = ['table_supply' =>$table_supply, 'supply' => $supply->id, 'type' => $next_data['type'], 'status' => \StatusConst::NOT_ACCEPTED];
                    $exist_command = WSalary::where($where)->first();
                    if (empty($exist_command)) {
                        $next_data['qty'] = $next_qty;
                        $next_data['created_by'] = $data_command->created_by;
                        $product_name = getFieldDataById('name', 'products', $supply->product);
                        $next_data['name'] = getNameCommandWorker($supply, $product_name);
                        WSalary::commandStarted($data_command->command, $next_data, $table_supply, $supply);
                    }else{
                        // nếu lệnh tiếp theo có tồn tại mà chưa được ai nhận thì chỉ update thêm số lượng
                        $exist_command->qty = (int) $exist_command->qty + $next_qty;
                        $exist_command->save();
                    }
                }
            }
            
            //kiểm tra xem đã hoàn thành tất cả các công đoạn chưa thì update trạng thái của lệnh
            WSalary::checkStatusUpdate($table_supply, $supply->id, \StatusConst::SUBMITED);
            dd($data_handle['handle_qty']);
            $data_handle['handle_qty'] = $handle_qty - $qty;
            $data_handle['act'] = 2;
            \DB::table($table_supply)->where('id', $supply->id)->update([$type => json_encode($data_handle)]);
            return $update;
        }else{
            return false;
        }
    }

    public function submitCommand($obj, $data_command, $worker, $supply, $qty){
        if ($data_command->worker != $worker['id']) {
            return returnMessageAjax(100, 'Chấm công không thành công, Lệnh này không phải của bạn !');
        }
        if($data_command->status != \StatusConst::PROCESSING){
            return returnMessageAjax(100, 'Dữ liệu không hợp lệ !');
        }
        $type = $worker['type'];
        $data_handle = !empty($supply->{$type}) ? json_decode($supply->{$type}, true) : [];
        $handle_qty = @$data_command->qty ?? 0;
        $table_supply = $data_command->table_supply;
        if ($qty > $handle_qty) {
            return returnMessageAjax(100, 'Số lượng chấm công không hợp lệ !');
        }elseif ((int) $qty == 0) {
            //Trả lại trạng thái treo lệnh nếu nhập số lượng hoàn thành là 0
            $data_update['status'] = \StatusConst::NOT_ACCEPTED;
            $data_update['worker'] = 0;
            $ret = $obj->update($data_update);
            if ($ret) {
                return returnMessageAjax(200, 'Bạn đã trả lệnh thành công !', url('Worker'));
            }
        }else{
            //nếu chấm công với số lượng không hết thì thêm lệnh mới treo ở ngoài
            if ($qty < $handle_qty) {
                $re_insert['type'] = $type;
                $re_insert['machine_type'] = $data_command->machine_type;
                $re_insert['qty'] = $handle_qty - $qty;
                $re_insert['created_by'] = $data_command->created_by;
                $re_insert['name'] = $data_command->name;
                if ($type == \TDConst::FILL) {
                    $re_insert['fill_materal'] = $data_command->fill_materal;
                    $re_insert['fill_handle'] = $data_command->fill_handle;
                    $re_insert['handle'] = $data_command->handle;
                }
                WSalary::commandStarted($data_command->command, $re_insert, $table_supply, $supply);
            }
            if ($type == \TDConst::PRINT) {
                $table_after_print = 'after_prints';
                $after_print['name'] = $supply->name;
                $after_print['w_salary'] = $data_command->id;
                $after_print['worker'] = $worker['id'];
                $after_print['qty'] = $qty;
                $after_print['status'] = \StatusConst::PROCESSING;
                $after_print['created_by'] = $worker['id'];
                (new \BaseService)->configBaseDataAction($after_print, 'worker_login');
                $after_prints = \DB::table($table_after_print);
                $insert_id = $after_prints->insertGetId($after_print);
                $update = $obj->update(['status' => \StatusConst::CHECKING]);
                if ($insert_id) {
                    $after_prints->where('id', $insert_id)->update(['code' => 'QC-'.sprintf("%08s", $insert_id)]);
                    return returnMessageAjax(200, 'Đã gửi yêu cầu duyệt chấm công đến bộ phận KCS sau in !', url('Worker'));
                }else{
                    return returnMessageAjax(100, 'Có lỗi xảy ra, vui lòng thử chấm công lại !'); 
                } 
            }
            //Tính lương công nhân & lưu bảng lương
            $update = $this->checkInWorkerSalary($data_command, $type, $qty, $supply, $data_handle, $worker, $obj, $table_supply, $handle_qty);
            if (!empty($update)) {
                return returnMessageAjax(200, 'Bạn đã chấm công thành công với số lượng : '.$qty.' !', url('Worker'));  
            }else{
                return returnMessageAjax(100, 'Có lỗi xảy ra, vui lòng thử chấm công lại !'); 
            }
        }
    }
}
