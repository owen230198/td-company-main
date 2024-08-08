<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\Order;
use App\Models\Product;
use App\Models\WSalary;
use App\Models\WUser;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function notifyProcess(Request $request, $id)
    {
        $is_ajax = !$request->isMethod('GET');
        $notify = Notify::find($id);
        if (empty($notify)) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Thông báo không tồn tại hoặc đã bị xóa !']);
        }
        if ($notify->act != 1 && !empty($notify->handle_by)) {
            return customReturnMessage(false, $is_ajax, ['message' => 'Thông báo này đã được xử lý bởi '.getFieldDataById('name', 'n_users', $notify->handle_by).'!']);
        }
        if (\GroupUser::isAdmin() || @$notify->group_user == \GroupUser::getCurrent() || @$notify->user == \User::getCurrent('id')) {
            if (empty($notify->handle_method) || !method_exists($this, @$notify->handle_method)) {
                return customReturnMessage(false, $is_ajax, ['message' => 'Thông báo này không có phương thức xử lý!']);
            }
            $param = !empty($notify->param) ? json_decode($notify->param, true) : [];
            $process = $this->{$notify->handle_method}($request, $notify, $param);
            if (@$process['code'] == 200) {
                $data_update['act'] = 0;
                $data_update['handle_by'] = \User::getCurrent('id');
                if (!empty($request->input('notify'))) {
                    $data_notf = $request->input('notify');
                    $data_update['note'] = @$data_notf['note'];
                }
                Notify::where('id', $id)->update($data_update);
            }
            return $process;
        }else{
            return customReturnMessage(false, $is_ajax, ['message' => 'Thông báo này không phải của bạn !']);
        }
    }

    private function handlePaperFeedback($model, $type, $supply, $param, &$handle)
    {
        if ($type == \TDConst::PRINT) {
            $handle['color'] = $param['color'];
        }elseif (in_array($type, [\TDConst::NILON, \TDConst::UV])) {
            $handle['face'] = $param['face'];
        }elseif($type == \TDConst::METALAI){
            $handle['face'] = $param['face'];
            $handle['cover_face'] = $param['cover_face'];
        }elseif ($type == \TDConst::ELEVATE) {
            if ($param['float'] == 0) {
                $handle['float']['act'] = 0;
            }
        }
        $arr_stage = getArrHandleField('papers');
        $arr_stage[] = 'size';
        $arr_stage[] = 'ext_price';
        foreach ($supply->toArray() as $key => $value) {
            $paper[$key] = in_array($key, $arr_stage) || $key == 'size' ? (!empty($value) ? json_decode($value, true) : []) : $value;
        }
        $paper[$type] = $handle;
        $paper['id'] = $supply->id;
        $paper['qty'] = $supply->product_qty;
        $data_update = $model->getDataHandle($paper, $supply);
        $update = $model->where('id', $paper['id'])->update($data_update);
        if ($update) {
            $product = Product::find($supply->product);
            if (!empty($product->order)) {
                $obj_refesh = Order::find($product->order);
                if (!empty($obj_refesh)) {
                    refreshProfit($obj_refesh);
                    RefreshQuotePrice($obj_refesh);
                }
            }
            logActionUserData('update', 'papers', $paper['id'], $supply);
        }
    }

    public function workerfeedBack($request, $notify, $param)
    {
        $is_ajax = $request->isMethod('POST');
        if (\GroupUser::isAdmin() || \GroupUser::isProManager()) {
            $data_command = WSalary::find(@$param['id']);
            if (empty($data_command)) {
                return customReturnMessage(false, $is_ajax, ['message' => 'Dữ liệu lệnh sản xuất không tồn tại hoặc đã bị xóa !']);
            }
            if (!$is_ajax) {
                $data['notify'] = $notify;
                $data['dataItem'] = $param;
                $data['data_command'] = $data_command;
                $data['title'] = 'Xử lí phản hồi công nhân';
                return view('managers.worker_feedbacks.view', $data);
            }else{
                $table_supply = $data_command->table_supply;
                $model = getModelByTable($table_supply);
                $supply = $model->find($data_command->supply);
                $type = $data_command->type;
                $handle = !empty($supply->{$type}) ? json_decode($supply->{$type}, true) : [];
                if ($table_supply == 'papers') {
                    $this->handlePaperFeedback($model, $type, $supply, $param, $handle);
                }
                if (!empty($param['factor'])) {
                    $handle['factor'] = $param['factor'];
                    if ($data_command->status == \StatusConst::SUBMITED) {
                        $handle_config = $type == \TDConst::FILL ? json_decode($data_command->fill_handle, true) : $handle;
                        $worker = WUser::find($notify->created_by);
                        $obj_salary = new WSalary($supply, $handle_config, $worker);
                        $data_update = $obj_salary->totalhandle($data_command->qty, $type);
                    }
                    $data_update['factor'] = $param['factor'];
                    $model->where('id', $supply->id)->update([$type => json_encode($handle)]);
                    WSalary::where('id', $data_command->id)->update($data_update);
                    logActionUserData('handle_feedback', 'w_salaries', $data_command->id, $data_command);
                    return returnMessageAjax(200, 'Đã xử lí phản hồi thành công !', url(''));
                }
            }
        }else{
            return customReturnMessage(false, $is_ajax, ['message' => 'Bạn không có quyền xử lí phản hồi công nhân !']);
        }
    }
}
