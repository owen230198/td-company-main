<?php
namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function insert($request, $data = array())
    {
        if (!$request->isMethod('POST')) {
            return view('orders.insert', $data);    
        }   
    }
}
?>