<?php
namespace App\Modules\Worker\Controllers\Auths;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->services = new \App\Services\AuthService('Worker', 'worker_login', 'w_users');
    }
    
    public function login(Request $request)
    {
        $data['title'] = 'Đăng nhập - nhà máy';
        $data['link_login'] = 'Worker/login';
        return $this->services->baseLogin($request, $data);
    } 

    public function logout()
    {
        return $this->services->baseLogout();
    }

    public function changePassword(Request $request){
        return $this->services->baseChangePassword($request);
    }
}
?>