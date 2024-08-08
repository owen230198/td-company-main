<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (!$request->isMethod('GET')) {
            return 'Yêu cầu không hợp lệ !';
        }
        $data['title'] = 'phần mềm doanh nghiệp '. getDataConfig('QuoteConfig', 'COMPANY_NAME');
        $notify_obj = Notify::where(['act' => 1]);
        if (!\GroupUser::isAdmin()) {
            $notify_obj->where('group_user', \GroupUser::getCurrent())->orWhere('user', \User::getCurrent('id'));
        }
        $data['noftify_count'] = $notify_obj->count();
        $data['notify_list'] = $notify_obj->get()->take(10);
        $data['not_accepted_table'] = \App\Constants\OrderConstant::ACCEPT_REQURIRED_TABLE;
        return view('main', $data); 
    }
}

