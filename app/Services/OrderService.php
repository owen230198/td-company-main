<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Product;
use \App\Models\CDesign;
use \App\Models\CSupply;
use App\Models\Supply;
use App\Models\SupplyWarehouse;

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
        if (empty($arr_quote)) {
            return returnMessageAjax(100, 'Báo giá không tồn tại!');
        }
        if ($arr_quote == \StatusConst::NOT_ACCEPTED) {
            return returnMessageAjax(100, 'Báo giá chưa được khách hàng duyệt !');
        }
        $arr_order = !empty($data['order']) ? $data['order'] : [];
        if ((int) @$arr_order['advance'] > 0 && empty($arr_order['rest_bill'])) {
            return ['code' => 100, 'message' => 'Bạn cần upload bill tạm ứng cho đơn này !'];
        }
        $product_process = $this->quote_services->processDataProduct($data, $arr_quote, \TDConst::ORDER_ACTION_FLOW);
        if (!empty($product_process['code']) && $product_process['code'] == 100) {
            return returnMessageAjax(100, $product_process['message']);  
        }else{
            $new_arr_quote = Quote::find($arr_quote['id']);
            if (!empty($arr_order['advance'])) {
                $quote_amount = (float) $new_arr_quote['total_amount'];
                $arr_order['total_amount'] = @$arr_order['vat'] == 1 ? 
                calValuePercentPlus($quote_amount, $quote_amount, (float) getDataConfig('QuoteConfig', 'VAT_PERC', 0)) : $quote_amount;
                $arr_order['rest'] = $arr_order['total_amount'] - (float) $arr_order['advance'];
            }
            $this->configBaseDataAction($arr_order);
            if (!empty($arr_order['id'])) {
                Order::where('id', $arr_order['id'])->update($arr_order);
            }else{
                $arr_order['code'] = 'DH-'.getCodeInsertTable('orders');
                $arr_order['status'] = \StatusConst::NOT_ACCEPTED;
                Order::insertGetId($arr_order);
            }
            return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', getBackUrl());     
        }
    }

    public function insertDesignCommand($arr_order)
    {
        $products = Product::where(['act' => 1, 'quote_id' => $arr_order['quote']])->get();
        $data_insert['order'] = $arr_order['id'];
        $data_insert['status'] = \StatusConst::NOT_ACCEPTED;
        $this->configBaseDataAction($data_insert);
        foreach ($products as $key => $product) {
            $h = $key > 0 ? $key.'.' : '';
            $data_insert['code'] = 'TK-'.$h.$arr_order['code'];
            $data_insert['product'] = $product['id'];
            CDesign::insert($data_insert);
        }
        return Order::where('id', $arr_order['id'])->update(['status' => Order::TO_DESIGN, 'apply_design_by' => \User::getCurrent('id')]);
    }

    public function supplyHandleProcess($supply, $size, $command, $elevate, $over_supply)
    {
        if (empty($command['size_type'])) {
            return returnMessageAjax(100, 'Vui lòng chọn khổ vật tư !');
        }

        if (empty($command['nqty'])) {
            return returnMessageAjax(100, 'Vui lòng nhập số lượng sản phẩm/tờ to !');
        }

        if (empty($elevate['num'])) {
            return returnMessageAjax(100, 'Vui lòng nhập số lượt bế !');
        }
        $data_command = $command;
        $data_command['code'] = 'XVT-'.getCodeInsertTable('c_supplies'); 
        $data_command['order'] = $supply->order;
        $data_command['product'] = $supply->product;
        $data_command['supply'] = $supply->id;
        $data_command['supp_type'] = $supply->type;
        $data_command['status'] = CSupply::HANDLING;
        $this->configBaseDataAction($data_command);
        $insert_command = CSupply::insert($data_command);
        if (!$insert_command) {
            return returnMessageAjax(110, 'Không thể tạo yêu cầu xuất vật tư, vui lòng thử lại!');
        }else{
            Supply::where('id', $supply->product)->update(['handle_elevate' => json_encode($elevate)]);
            if (!empty($over_supply['qty'])) {
                $data_whouse = $over_supply;
                $data_whouse['type'] = $supply->type;
                $data_whouse['supp_type'] = @$size['supply_type'];
                $data_whouse['supp_price'] = @$size['supp_price'];
                $data_whouse['status'] = SupplyWarehouse::WAITING;
                $data_whouse['source'] = SupplyWarehouse::OVER;
                $this->configBaseDataAction($data_whouse);
                SupplyWarehouse::insert($data_whouse);       
            }
            return returnMessageAjax(200, 'Đã gửi yêu cầu xử lí vật tư thành công!', url('update/orders/'.$supply->order));
        }
    }
    
    public function afterRemove($id)
    {
           
    }
}

?>