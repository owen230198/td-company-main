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
        $quote = $this->quotes::find($quote_id);
        $data = $this->adminService->getDataBaseView('q_papers', 'Chi tiết '.$quote['name']);
        $data['data_quotes'] = $quote;
        $data['data_tables'] = getDataTable($table, '*', array(), $data['page_item']);
        return view('quotes/managements', $data);
    }

    public function insertDetailQuote($action, $table, $quote_id)
    {
        $quote = $this->quotes::find($quote_id);
        $tableItem = $this->adminService->getTableItem($table);
        $data['data_item'] = $quote;
        $data['tableItem'] = $tableItem;
        $data['title'] = getActionByKey($action).' '.$tableItem['note'].' ('.$quote['name'].')';
        $data['nosidebar'] = true;
        return view('quotes.'.$table.'.view', $data);
    }

    public function doInsertDetail()
    {
        
    }
}

