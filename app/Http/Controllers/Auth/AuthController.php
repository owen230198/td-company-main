<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $data['title'] = 'Đăng nhập - văn phòng';
    	return $this->services->baseLogin($request, $data);
    }

    public function logout ()
    {
        return $this->services->baseLogout();
    }

    public function changePassword(Request $request){
        return $this->services->baseChangePassword($request);
    }

    public function accountDetail(Request $request)
    {
        $current_user = \User::getCurrent();
        $data_user = \User::find($current_user['id']);
        if (!$request->isMethod('POST')) {
            $data['title'] = 'Thông tin tài khoản của bạn';
            $data['profile'] = $data_user;
            return view('acount_detail', $data);
        }else{
            $email = $request->input('email');
            if (empty($email)) {
                return returnMessageAjax(100, 'Bạn chưa nhập thông tin email!');
            }
            $data_user->email = $email;
            $update = $data_user->save();
            if ($update) {
                return returnMessageAjax(200, 'Cập nhật thông tin thành công !');
            }
        }
    }
}

