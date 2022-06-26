<?php
namespace App\Http\Controllers\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class QuoteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminService = new \App\Services\AdminService;
        // $this->service = new \App\Services\QuoteService;
        $this->quotes = new \App\Models\Quote;
    }

    public function index()
    {
        return redirect('/');
    }

    public function quoteManagement($table, $quote_id)
    {
        $data['tableItem'] = $this->adminService->getTableItem('quotes');
        $quote = $this->quotes::find($quote_id);
        $data['data_quotes'] = $quote;
        $data['title'] = 'Chi tiết vật liệu - '.$quote['name'].'';
        return view('quotes/managements', $data);
    }
}

