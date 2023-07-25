<?php
namespace App\Services;
use App\Constants\StatusConstant;
use App\Services\BaseService;
class AuthService extends BaseService
{
    function __construct($auth_key = 'user_login', $table_user = 'n_users')
    {
    	parent::__construct();
        $this->auth_key = $auth_key;
        $this->table_user = getModelByTable($table_user);
    }

    public function hasLogin($request)
    {
    	$this->validatelogin($request);
        $request = $request->all();
        $user = $this->table_user->where('act', 1)->where('username', $request['username'])->first();
        if (!$user) {
            return $this->returnMessage(100, ['messages'=>'Không tìm thấy tài khoản trên hệ thống!']);
        }
        $password = md5($request['password']);
        if ($password != $user['password']) {
            return $this->returnMessage(100, ['messages'=>'Thông tin mật khẩu không chính xác!']);
        }
        unset($user['password']);
        $table_group = !empty($this->table_user::$table_group) ? $this->table_user::$table_group : '';
        if ($table_group != '') {
            $group_obj = getModelByTable($table_group);
            if (method_exists($group_obj, 'getMenuModule')) {
                $arr = $group_obj::getMenuModule($user['group_user']);
            }
        }
        $arr['user'] = $user;
        session()->put($this->auth_key, $arr);
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
    public function baseLogout($prefix = '')
    {
        $ret = !empty($prefix) ? $prefix.'/login' : 'login';
        if (session()->has($this->auth_key)) {
            session()->forget($this->auth_key);
            return redirect(asset($ret));
        }
        return redirect(asset($ret));
    }
}
