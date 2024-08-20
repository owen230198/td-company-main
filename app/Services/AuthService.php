<?php
namespace App\Services;
use App\Services\BaseService;
use Illuminate\Support\Facades\Cookie;

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
        $password = empty($request['remembered']) ? md5($request['password']) : $request['password'];
        if ($password != $user['password']) {
            return $this->returnMessage(100, ['messages'=>'Thông tin mật khẩu không chính xác!']);
        }
        unset($user['password']);
        $auth_key = $this->auth_key;
        $current_cookies = getCookieArr($auth_key);
        $user_name = $user->username;
        $lifetime = 525600;
        if (!empty($request['remember'])) {
            $current_cookies[$user_name] = $password;
            $cookie = Cookie::make($auth_key, serialize($current_cookies), $lifetime);
        }else{
            if (!empty($current_cookies[$user_name])) {
                unset($current_cookies[$user_name]);
            }
            if (empty($current_cookies)) {
                $cookie = Cookie::forget($auth_key);  
            }else{
                $cookie = Cookie::make($auth_key, serialize($current_cookies), $lifetime);
            }  
        }
        Cookie::queue($cookie);
        $table_group = !empty($this->table_user::$table_group) ? $this->table_user::$table_group : '';
        if ($table_group != '') {
            $group_obj = getModelByTable($table_group);
            if (method_exists($group_obj, 'getMenuModule')) {
                $arr = $group_obj::getMenuModule($user);
            }
        }
        $arr['user'] = $user->toArray();
        $arr['icon'] = rand(1, 6);
        session()->put($auth_key, $arr);
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
            $auth_key = $this->auth_key;
            $arr_remember = getCookieArr($auth_key);
            $data['data_remember'] = !empty($arr_remember) ? ['password' => end($arr_remember), 'username' => key($arr_remember) ] : [];
            $data['auth_key'] = $auth_key;
            return view('auth.login', $data);
        }
        $result = $this->hasLogin($request);
        if ($result['status'] === \StatusConst::SUCCESS_CODE) {
            $red_url = !empty(session()->get('before_login_url')) ? session()->get('before_login_url') : $this->prefix;
            session()->forget('before_login_url');
            return redirect($red_url)->with('message','Đăng nhập thành công!');
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
