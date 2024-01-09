<?php
namespace App\Services;
use App\Services\BaseService;
class AuthService extends BaseService
{
    function __construct($prefix = '', $auth_key = 'user_login', $table_user = 'n_users')
    {
    	parent::__construct();
        $this->prefix = $prefix;
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
        $arr['user'] = $user->toArray();
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
                'status'=>\StatusConst::SUCCESS_CODE,
                'messageCode'=>\StatusConst::SUCCESS_MSG,
                'errorMessage'=>['sucess'=>$mess]
            ];
        }else{
            return [
                'status'=>\StatusConst::ERR_CODE,
                'messageCode'=>\StatusConst::ERR_MSG,
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
        if ($result['status'] === \StatusConst::SUCCESS_CODE) {
            return redirect($this->prefix)->with('message','Đăng nhập thành công!');
        }
        return back()->withInput()->with($result['messageCode'], $result['errorMessage']);
    }
    
    public function baseLogout()
    {
        $ret = !empty($this->prefix) ? $this->prefix.'/login' : 'login';
        if (session()->has($this->auth_key)) {
            session()->forget($this->auth_key);
            return redirect(asset($ret));
        }
        return redirect(asset($ret));
    }

    public function baseChangePassword($request){
        if (!$request->isMethod('POST')) {
            $view_path = '.change_password';
            $full_view_path = !empty($this->prefix) ? $this->prefix.'::'.$view_path : $view_path;
            if (view()->exists($full_view_path)) {
                $data['title'] = 'Thay đổi mật khẩu';
                return view($full_view_path, $data);
            }else{
                return back()->with('error', 'Chức năng đổi mật khẩu không hỗ trợ !');
            }
        }else{
            $id = $this->table_user::getCurrent('id') != '' ? $this->table_user::getCurrent('id') : 0;
            $user = $this->table_user::find($id);
            if (empty($user)) {
                return returnMessageAjax(100, 'Không tìm thấy dữ liệu người dùng !');
            }
            $old_pass = $request->input('old_pass');
            $new_pass = $request->input('new_pass');
            $confirm_pass = $request->input('confirm_pass');
            if (strlen($old_pass) < 6 || strlen($new_pass) < 6 || strlen($confirm_pass) < 6) {
                return returnMessageAjax(100, 'Thông tin mật khẩu cần nhiều hơn 6 ký tự !');
            }
            if ($user->password != md5($old_pass)) {
                return returnMessageAjax(100, 'Mật khẩu cũ bạn đã nhập là không chính xác !');
            }
            if ($new_pass != $confirm_pass) {
                return returnMessageAjax(100, 'Thông tin xác nhận mật khẩu bắt buộc giống với thông tin mật khẩu mới !');
            }
            $user->password = md5($new_pass);
            $change = $user->save();
            if ($change) {
                return returnMessageAjax(200, 'Thay đổi mật khẩu thành công !', url($this->prefix.'/logout'));
            }
        }
    }
}
