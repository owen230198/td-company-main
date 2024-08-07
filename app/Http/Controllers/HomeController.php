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
        if (!$request->isMethod('GET')) {
            return 'Yêu cầu không hợp lệ !';
        }
        $data['title'] = 'phần mềm doanh nghiệp '. getDataConfig('QuoteConfig', 'COMPANY_NAME');
        $data['noftify_count'] = 2;
        $data['not_accepted_table'] = \App\Constants\OrderConstant::ACCEPT_REQURIRED_TABLE;
        return view('main', $data); 
    }
}

