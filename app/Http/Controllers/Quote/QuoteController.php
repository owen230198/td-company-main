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
        $data = $this->adminService->getDataBaseView('q_papers', 'Chi tiết');
        $quote = $this->quotes::find($quote_id);
        $data['data_quotes'] = $quote;
        $data['data_tables'] = getDataTable($table, '*', array(), $data['page_item']);
        return view('quotes/managements', $data);
    }

    public function insertDetailQuote($table)
    {
        $tableItem = $this->adminService->getTableItem($table);
        $data['tableItem'] = $tableItem;
        $data['title'] = 'Thêm mới '.$tableItem['note'];
        $data['nosidebar'] = true;
        return view('quotes.'.$table.'.view', $data);
    }
}

