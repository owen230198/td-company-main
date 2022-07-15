<?php
namespace App\Http\Controllers\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Constants\NameConstant;
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

    private function getBaseViewQuoteManagement($table, $quote_id)
    {
        $quote = $this->quotes::find($quote_id);
        $data = $this->adminService->getDataBaseView($table, 'Chi tiết '.$quote['name']);
        $data['data_quotes'] = $quote;
        $data['data_tables'] = getDataTable($table, '*', array(array('key'=>'quote_id', 'compare'=>'=', 'value'=>$quote_id)), $data['page_item']);
        return $data;
    }

    public function quoteManagement($table, $quote_id)
    {
        $data = $this->getBaseViewQuoteManagement($table, $quote_id);
        return view('quotes.managements', $data);
    }

    public function ajaxViewList($table, $quote_id)
    {
        $data = $this->getBaseViewQuoteManagement($table, $quote_id);
        return view('table.table_base_view', $data);    
    }

    private function getBaseActionQuote($action, $table, $quote_id, $id = 0)
    {
        $models = getModelByTable($table);
        $quote = $this->quotes::find($quote_id);
        unset($quote['id']);
        $tableItem = $this->adminService->getTableItem($table);
        $data['dataitem'] = $id==0?$quote:$models->find($id);
        $data['tableItem'] = $tableItem;
        $data['quote_id'] = $quote_id;
        $data['action'] = $action;
        $data['title'] = getActionByKey($action).' '.$tableItem['note'].' ('.$quote['name'].')';
        $data['nosidebar'] = true; 
        return $data;   
    }

    public function insertDetailQuote($table, $quote_id)
    {
        $data = $this->getBaseActionQuote('insert', $table, $quote_id);
        return view('quotes.tables.view', $data);
    }

    public function updateDetailQuote($table, $quote_id, $id)
    {
        $data = $this->getBaseActionQuote('update', $table, $quote_id, $id);
        return view('quotes.tables.view', $data);
    }

    public function doInsertDetail($table, $quote_id, Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $status = $this->service->doInsert($table, $data, $quote_id);
        if ($status) {
            if ($table == 'q_finishes') {
                return redirect('config-profits/'.$quote_id)->with('message','Thêm dữ liệu thành công !'); 
            }else{
                echoJson(200, 'Đã có lỗi xảy ra!');
                return;
            }
        }else{
            if ($table == 'q_finishes') {
                return back()->with('error','Đã có lỗi xảy ra! !'); 
            }else{
                echoJson(100, 'Đã có lỗi xảy ra!');
                return;
            }
        }
    }

    public function doupdateDetail($table, $quote_id, $id, Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $status = $this->service->doUpdate($table, $data, $quote_id, $id);
        if ($status) {
            if ($table == 'q_finishes') {
                return redirect('config-profits/'.$quote_id)->with('message','Cập nhật liệu thành công !'); 
            }else{
                echoJson(200, 'Cập nhật dữ liệu thành công!');
                return;
            }
        }else{
            if ($table == 'q_finishes') {
                return back()->with('error','Đã có lỗi xảy ra !'); 
            }else{
                echoJson(100, 'Đã có lỗi xảy ra!');
                return;
            }
        }
    }

    public function configProfit($quote_id, Request $request)
    {
        $quote = $this->quotes->find($quote_id);
        if (!$request->isMethod('post')) {
            if ($quote['group_product']==NameConstant::HARDBOX) {
                $data = $this->service->getListDataQuote($quote_id);     
            }else{
                $q_papers = new \App\Models\QPaper;
                $data['list_data'] = $q_papers->where('quote_id', $quote_id)->get();
            } 
            $data['data_quotes'] = $quote;
            $data['title'] = 'Lợi nhuận báo giá '.$quote['name'] ;
            return view('quotes.managements', $data);
        }
    }
}

