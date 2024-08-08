<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\WSalary;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function notifyProcess(Request $request, $id)
    {
        $notify = Notify::find($id);
        $is_ajax = !$request->isMethod('GET');
        if (\GroupUser::isAdmin() || @$notify->group_user == \GroupUser::getCurrent() || @$notify->user == \User::getCurrent('id')) {
            if (empty($notify->handle_method) || !method_exists($this, @$notify->handle_method)) {
                return customReturnMessage(false, $is_ajax, ['message' => 'Thông báo này không có phương thức xử lý!']);
            }
            $param = !empty($notify->param) ? json_decode($notify->param, true) : [];
            return $this->{$notify->handle_method}($is_ajax, $notify, $param);
        }else{
            return customReturnMessage(false, $is_ajax, ['message' => 'Thông báo này không phải của bạn !']);
        }
    }

    public function workerfeedBack($is_ajax, $notify_id, $param)
    {
        
    }
}
