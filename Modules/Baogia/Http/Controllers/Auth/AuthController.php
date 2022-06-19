<?php
namespace Modules\Baogia\Http\Controllers\Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    function __construct()
    {
        
    }

    public function login()
    {
    	var_dump(DB::delete(1)); die();
        return view('baogia::auths.login');
    }
}
