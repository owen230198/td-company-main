<?php
namespace App\Services;
use App\Constants\StatusConstant;
use App\Models\NUser;
use App\Services\BaseService;
class AuthService extends BaseService
{
    function __construct()
    {
    	parent::__construct();
    }

    public function hasLogin($request)
    {
    	$this->validatelogin($request);
        $request = $request->all();
        $user = NUser::where('act', 1)->where('username', $request['username'])->first();
        if (!$user) {
            return $this->returnMessage(100, ['messages'=>'Không tìm thấy tài khoản trên hệ thống!']);
        }
        $password = md5($request['password']);
        if ($password != $user['password']) {
            return $this->returnMessage(100, ['messages'=>'Thông tin mật khẩu không chính xác!']);
        }
        unset($user['password']);
        $arr = $this->group_user::getMenuModule($user['group_user']);
        $arr['user'] = $user;
        session()->put('user_login', $arr);
        return $this->returnMessage(200, ['messages'=>'Đăng nhập thành công!']);
    }

    private function validatelogin($request)
    {
        $rule = [
            'username'=>'required|min:3',
            'password'=>'required|min:6',
        ];
        $messages = [
            'username.required'=> 'Username không được để trống !',
            'username.min'=> 'Username yêu cầu ít nhất 3 ký tự !',
            'password.required'=> 'Password không được để trống !',
            'password.min'=> 'Password yêu cầu ít nhất 6 ký tự !'
        ];
        $request->validate($rule, $messages);
    }

    private function returnMessage($code, $mess)
    {
        if ($code == 200) {
            return [
                'status'=>StatusConstant::SUCCESS_CODE,
                'messageCode'=>StatusConstant::SUCCESS_MSG,
                'errorMessage'=>['sucess'=>$mess]
            ];
        }else{
            return [
                'status'=>StatusConstant::ERR_CODE,
                'messageCode'=>StatusConstant::ERR_MSG,
                'errorMessage'=> $mess
            ];
        }

    }

    public function baseLogin($request, $data)
    {
        if (!$request->isMethod('post')) {
            $data['nosidebar'] = true;
            return view('auth.login', $data);
        }
        $result = $this->hasLogin($request);
        if ($result['status'] === StatusConstant::SUCCESS_CODE) {
            $rede = session('afterLoginRoute') ?? '/';
            return redirect($rede)->with('message','Đăng nhập thành công!');
        }
        return redirect(asset('login'))->withInput()->with($result['messageCode'], $result['errorMessage']);
    }

}
