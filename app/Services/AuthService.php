<?php
namespace App\Services;
use App\Constants\StattusConstant;
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
        $user = $this->users::where('act', 1)->where('username', $request['username'])->first();
        if (!$user) {
            return $this->returnMessages(100, ['messages'=>'Không tìm thấy tài khoản trên hệ thống!']);      
        }
        $password = md5($request['password']);
        if ($password != $user['password']) {
            return $this->returnMessages(100, ['messages'=>'Thông tin mật khẩu không chính xác!']);       
        }
        unset($user['password']);
        $arr['user'] = $user;
        $role_module = $this->getMenuForAdmin($user);
        $arr['parent_menu'] = $this->modules->orderBy('ord', 'asc')->whereNull('parent')->get();
        $arr['menu'] = @$role_module['menu']?$role_module['menu']:array();
        $arr['list_roles'] = @$role_module['list_roles']?$role_module['list_roles']:array();
        session()->put('user_login', $arr);
        return $this->returnMessages(200, ['messages'=>'Đăng nhập thành công!']);
    }

    private function getMenuForAdmin($group_user_id)
    {
        $child_menu = $this->roles->getModuleByGroupUser($group_user_id);
        $parent_menu = array();
        foreach ($child_group as $key => $item) {
            $parent_item = $this->modules->find($item['parent']);
            array_push($parent_menu, $parent_item);       
        }
        $menu = array_merge($parent_menu, $child_menu);
        
        return $menu->toArray();
    }

    private function validatelogin($request)
    {
        $rule = [
            'username'=>'required|min:3',
            'password'=>'required|min:6',
        ];
        $messages = [
            'username.required'=> 'Username không được để trống!',
            'username.min'=> 'Username yêu cầu ít nhất 3 ký tự!',
            'password.required'=> 'Password không được để trống!',
            'password.min'=> 'Password yêu cầu ít nhất 3 ký tự'
        ];
        $request->validate($rule, $messages);    
    }

    private function returnMessages($code, $mess)
    {
        if ($code == 200) {
            return [
                'status'=>StattusConstant::SUCCESS_CODE,
                'messageCode'=>StattusConstant::SUCCESS_MSG,
                'errorMessage'=>['sucess'=>$mess]
            ]; 
        }
        return [
            'status'=>StattusConstant::ERR_CODE,
            'messageCode'=>StattusConstant::ERR_MSG,
            'errorMessage'=> $mess
        ];
    }

}
