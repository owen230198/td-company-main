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

    public function quoteManagement($table, $quote_id)
    {
        $quote = $this->quotes::find($quote_id);
        $data = $this->adminService->getDataBaseView('q_papers', 'Chi tiết '.$quote['name']);
        $data['data_quotes'] = $quote;
        $data['data_tables'] = getDataTable($table, '*', array(array('key'=>'quote_id', 'compare'=>'=', 'value'=>$quote_id)), $data['page_item']);
        session()->put('back_url', url()->full());
        return view('quotes/managements', $data);
    }

    public function insertDetailQuote($table, $quote_id)
    {
        $quote = $this->quotes::find($quote_id);
        $tableItem = $this->adminService->getTableItem($table);
        $data['dataitem'] = $quote;
        $data['tableItem'] = $tableItem;
        $data['quote_id'] = $quote_id;
        $data['action'] = 'insert';
        $data['title'] = 'Thêm mới '.$tableItem['note'].' ('.$quote['name'].')';
        $data['nosidebar'] = true;
        return view('quotes.'.$table.'.view', $data);
    }

    public function updateDetailQuote($table, $quote_id, $id)
    {
        $quote = $this->quotes::find($quote_id);
        $tableItem = $this->adminService->getTableItem($table);
        $models = getModelByTable($table);
        $data['dataitem'] = $models->find($id);
        $data['tableItem'] = $tableItem;
        $data['quote_id'] = $quote_id;
        $data['action'] = 'insert';
        $data['title'] = 'Cập nhật '.$tableItem['note'].' ('.$quote['name'].')';
        $data['nosidebar'] = true;
        return view('quotes.'.$table.'.view', $data);
    }

    public function doInsertDetail($table, $quote_id, Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $status = $this->service->doInsert($table, $data, $quote_id);
        if ($status) {
            echoJson(200, 'Thêm dữ liệu thành công!');
            return;
        }else{
            echoJson(100, 'Đã có lỗi xảy ra!');
            return;
        }
    }
}

