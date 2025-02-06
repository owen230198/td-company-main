<?php
namespace App\Modules\Worker\Services;

use App\Models\Notify;
use App\Models\Order;
use App\Models\Paper;
use App\Models\Product;
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
        if (empty($worker['dev'])) {
            $type = @$worker['type'];
            $where['type'] = $type; 
            $where['status'] = \StatusConst::NOT_ACCEPTED;
            if (!in_array($type, [\TDConst::FINISH])) {
                $where['machine_type'] = @$worker['device'];
            }
        }
        return getDataWorkerCommand($where, true);
    }

    public function workerfeedBack($command, $worker, $data)
    {
        if ($worker['type'] != $command->type) {
            return returnMessageAjax(100, 'Bạn không có quyền phản hồi lệnh !');
        }

        $data_insert = [
            'name' => 'Yêu cầu cập nhật lệnh sản xuất',
            'description' =>'Công nhân: '.$worker['name'].' '.getDeviceGroupName($worker['type'], $worker['device']).' đã yêu cầu quản đốc cập nhật lệnh sản xuất '.$command->name,
            'group_user' => \GroupUser::PRODUCTION_MANAGER,
            'user' => 0,
            'handle_method' => 'workerFeedBack',
            'param' => json_encode($data),
            'act' => 1,
            'table_created' => 'w_users',
            'created_by' => $worker['id'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $insert = Notify::insert($data_insert);
        if (!$insert) {
            return returnMessageAjax(100, 'Đã có lỗi xảy ra, vui lòng thử lại !');
        }
        return returnMessageAjax(200, 'Đã gửi yêu cầu đến quả đốc, vui lòng chờ xác nhận !');
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
        $data['all_devices'] = getArrHandleField($data_command->table_supply, true);
        $data['title'] = 'Chi tiết lệnh sản xuất '.$data_command->command;
        $worker_type = @$worker['type'];
        $handle = !empty($supply->{$worker_type}) ? json_decode($supply->{$worker_type}, true) : [];
        $data['data_handle'] = WSalary::getHandleDataJson($worker_type, $handle, true);
        $data_product = Product::find($supply->product);
        $data['data_product'] = $data_product;
        $data['data_order'] = Order::find(@$data_product->order);
        $data['arr_handle'] = $handle;
        $data['handled'] = !empty($handle['handled']) ? $handle['handled'] : 0;
        $data['data_size'] = !empty($supply->size) ? json_decode($supply->size, true) : [];
        $data['view_type'] = $worker_type;
        if (WSalary::showPrintHandle($worker_type, $supply)) {
            $data['print_handle'] = json_decode($supply->print, true);
        }
        return view('Worker::commands.view', $data);
    }

    public function checkInWorkerSalary($data_command, $type, $qty, $supply, $data_handle, $worker, $obj, $table_supply, $demo_qty)
    {
        $handle_config = $type == \TDConst::FILL ? json_decode($data_command->fill_handle, true) : $data_handle;
        $obj_salary = new WSalary($supply, $handle_config, $worker);
        $data_update = $obj_salary->totalhandle($qty, $type);
        $data_update['status'] = \StatusConst::SUBMITED;
        $data_update['qty'] = $qty;
        $data_update['submited_at'] = \Carbon\Carbon::now();
        $update = $obj->update($data_update);
        $this_qty = $qty;
        if ($update) {
            $qty_check_update = (int) @$data_handle['handle_qty'];
            $next_data = getStageActiveStartHandle($table_supply, $data_command->supply, $type);
            if ($next_data['type'] != \StatusConst::SUBMITED) {
                //Nếu không phải là bước hoàn tất của sản lệnh
                $need_multiply = isQtyFormulaBySupply($type) && !isQtyFormulaBySupply($next_data['type']);
                if ($need_multiply) {
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
                        $next_qty = (int) $fill_next['next_qty'];
                        $qty_check_update = $qty_check_update * $fill_next['count_handle'];
                        $this_qty = $fill_next['min_command'];
                    }else{
                        $this_qty = 0;
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
                        $next_data['demo_qty'] = $demo_qty;
                        WSalary::commandStarted($data_command->command, $next_data, $table_supply, $supply);
                    }else{
                        // nếu lệnh tiếp theo có tồn tại mà chưa được ai nhận thì chỉ update thêm số lượng
                        $exist_command->qty = (int) $exist_command->qty + $next_qty;
                        $exist_command->save();
                    }
                }
            }
            
            //kiểm tra xem đã hoàn thành tất cả các công đoạn chưa thì update trạng thái của lệnh
            $data_handled = !empty($data_handle['handled']) ? $data_handle['handled'] : 0;
            $handled = $data_handled + $this_qty;
            $data_handle['handled'] = $handled;
            $update_supply[$type] = $data_handle;
            $supply_id = $supply->id;
            $supply_obj = getModelByTable($table_supply)->find($supply_id);
            if ($handled >= $qty_check_update) {
                $data_handle['act'] = 2;
                $supply_obj->status = @$next_data['type'];
            }
            $submited_stt = \StatusConst::SUBMITED;
            if (@$next_data['type'] == $submited_stt) {
                $n_qty = !empty($supply_obj->nqty) ? (int) $supply_obj->nqty : 1;
                $handled_pro = !isQtyFormulaBySupply($type) ? $handled : $handled * $n_qty;
                if ($table_supply == 'papers' && !empty($supply_obj->double)) {
                    $handled_pro = $handled_pro/2;
                }
                $supply_obj->handled = $handled_pro;
                $supply_obj->save();
                if (!empty($supply_obj->product) && empty($supply_obj->is_join)) {
                    Product::createCProduct($supply_obj->product);
                }
            }
            $supply_obj->{$type} = json_encode($data_handle);
            $supply_obj->save();
            WSalary::checkStatusUpdate($table_supply, $supply_id, $submited_stt);
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
                    $after_prints->where('id', $insert_id)->update(['code' => 'QC-'.formatCodeInsert($insert_id)]);
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
