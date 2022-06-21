<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\StattusConstant;
class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new \App\Services\AuthService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request)
    {
    	if (!$request->isMethod('post')) {
            $data['title'] = 'Login';
            $data['nosidebar'] = true;
            return view('auth.login', $data);
        }
        $result = $this->service->hasLogin($request);
        if ($result['status'] === StattusConstant::SUCCESS_CODE) {
            return redirect('/')->with('message','Đăng nhập thành công!');
        }
        return redirect('login')->withInput()->with($result['messageCode'], $result['errorMessage']);	
    }

    public function logout ()
    {
        if (session()->has('user_login')) {
            session()->forget('user_login');
            return redirect('login'); 
        }
        return redirect('login');
    }
}

