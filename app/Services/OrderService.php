<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Product;
use App\Constants\StatusConstant;
use App\Constants\TDConstant;

class OrderService extends BaseService
{
    function __construct()
    {
        parent::__construct();
        $this->quote_services = new \App\Services\QuoteService;
    }

    public function getBaseDataAction($arr_quote, $quote_id)
    {
        $data['data_quote'] = $arr_quote;
        $data['products'] = Product::where(['act' => 1, 'quote_id' => $quote_id])->get();
        $data['product_qty'] = count($data['products']);
        return $data;
    }

    public function processDataOrder($request, $arr_quote)
    {
        $data = $request->except('_token');
        $arr_order = !empty($data['order']) ? $data['order'] : [];
        if (empty($arr_quote)) {
            return returnMessageAjax(100, 'Báo giá không tồn tại!');
        }
        if ($arr_quote == StatusConstant::NOT_ACCEPTED) {
            return returnMessageAjax(100, 'Báo giá chưa được khách hàng duyệt !');
        }
        $arr_order = !empty($data['order']) ? $data['order'] : [];
        if (@$arr_order['status'] == StatusConstant::ACCEPTED) {
            return returnMessageAjax(100, 'Dữ liệu không hợp lệ');
        }
        if ((int) @$arr_order['advance'] > 0 && empty($arr_order['rest_bill'])) {
            return ['code' => 100, 'message' => 'Bạn cần upload bill tạm ứng cho đơn này !'];
        }
        $product_process = $this->quote_services->processDataProduct($data, $arr_quote, TDConstant::ORDER_ACTION_FLOW);
        if (@$product_process['code'] == 100) {
            return returnMessageAjax(100, $product_process['message']);  
        }else{
            $arr_order['status'] = StatusConstant::NOT_ACCEPTED;
            $new_arr_quote = Quote::find($arr_quote['id']);
            if (!empty($arr_order['advance'])) {
                $arr_order['rest'] = (float) $new_arr_quote['total_amount'] - (float) $arr_order['advance'];
            }
            $this->configBaseDataAction($arr_order);
            if (!empty($arr_order['id'])) {
                Order::where('id', $arr_order['id'])->update($arr_order);
            }else{
                $arr_order['code'] = 'DH-'.getCodeInsertTable('orders');
                Order::insertGetId($arr_order);
            }
            return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', @session()->get('back_url'));     
        }
    }
    
    public function afterRemove($id)
    {
           
    }
}

?>