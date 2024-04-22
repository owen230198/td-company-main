<?php

namespace App\Http\Controllers;

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
        $data['title'] = 'Báo cáo & Thống kê';
        $data['not_accepted_table'] = \App\Constants\OrderConstant::ACCEPT_REQURIRED_TABLE;
        if (\GroupUser::isDesign()) {
            unset($data['not_accepted_table']['orders']);
        }
        return view('main', $data); 
    }
}

