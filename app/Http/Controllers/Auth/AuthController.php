<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\StatusConstant;
class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->services = new \App\Services\AuthService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request)
    {
        $data['title'] = 'Đăng nhập - Nhân viên văn phòng';
    	return $this->services->baseLogin($request, $data);
    }

    public function logout ()
    {
        return $this->services->baseLogout();
    }
}

