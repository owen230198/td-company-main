<?php
namespace App\Http\Controllers\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class QuoteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminService = new \App\Services\AdminService;
        $this->service = new \App\Services\QuoteService;
        $this->quotes = new \App\Models\Quote;
    }

    public function index()
    {
        return redirect('/');
    }

    public function createQuote(Request $request)
    {
        if (!$request->isMethod('POST')) {
            $data['title'] = 'Tạo mới báo giá';
            $step = $request->input('step') ?? 'chose_customer';
            return view('quotes.'.$step, $data);
        }
    }
}

