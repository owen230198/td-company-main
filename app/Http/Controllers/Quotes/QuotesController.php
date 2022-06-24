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
        $this->service = new \App\Services\QuoteService;
        $this->quotes = new \App\Models\Quote;
    }

    public function index()
    {
        return redirect('/');
    }

    public function actionQuoteView($action, $quote)
    {
        $data = $this->adminService->getTableItem($table);
        $data['data_quotes'] = $this->quotes::find($quote);
        var_dump($data_quotes); die();
        return view($table.'/'.$action, $data);
    }
}

