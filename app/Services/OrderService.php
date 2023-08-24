<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Product;
use \App\Models\CDesign;
use \App\Models\CSupply;
use App\Models\Paper;
use App\Models\PrintWarehouse;
use App\Models\Supply;
use App\Models\SupplyWarehouse;

class OrderService extends BaseService
{
    function __construct()
    {
        parent::__construct();
        $this->quote_services = new \App\Services\QuoteService;
    }

    public function getBaseDataAction()
    {
        $data['parent_url'] = ['link' => @session()->get('back_url'), 'note' => 'Danh sách đơn hàng'];
        return $data;
    }

    public function processDataOrder($request, $arr_quote = [])
    {
        $data = $request->except('_token');
        $arr_order = !empty($data['order']) ? $data['order'] : [];
        if ((int) @$arr_order['advance'] > 0 && empty($arr_order['rest_bill'])) {
            return ['code' => 100, 'message' => 'Bạn cần upload bill tạm ứng cho đơn này !'];
        }
        $product_process = $this->quote_services->processDataProduct($data, $arr_quote, \TDConst::ORDER_ACTION_FLOW);
        if (!empty($product_process['code']) && $product_process['code'] == 100) {
            return returnMessageAjax(100, $product_process['message']);  
        }else{
            if (!empty($arr_order['advance'])) {
                $amount = getTotalProductByArr($data['product'], $arr_quote, 'total_amount');
                $arr_order['total_amount'] = @$arr_order['vat'] == 1 ? 
                calValuePercentPlus($amount, $amount, (float) getDataConfig('QuoteConfig', 'VAT_PERC', 0)) : $amount;
                $arr_order['rest'] = $arr_order['total_amount'] - (float) $arr_order['advance'];
            }
            $this->configBaseDataAction($arr_order);
            if (!empty($arr_order['id'])) {
                if (!empty($arr_quote['id'])) {
                    $arr_order['quote'] = $arr_quote['id'];
                }
                Order::where('id', $arr_order['id'])->update($arr_order);
            }else{
                $arr_order['code'] = 'DH-'.getCodeInsertTable('orders');
                $arr_order['status'] = \StatusConst::NOT_ACCEPTED;
                $arr_order['id'] = Order::insertGetId($arr_order);
                $this->handleProductAfter($data['product'], $arr_order);
                if (!empty($arr_quote['id'])) {
                    Quote::where('id', $arr_quote['id'])->update(['status' => Quote::ORDER_CREATED]);
                }
            }
            return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', getBackUrl());     
        }
    }

    public function handleProductAfter($data, $order)
    {
        foreach ($data as $key => $product) {
            $data_update['code'] =  $order['code'].getCharaterByNum($key);
            $data_update['status'] = $order['status'];
            $data_update['order'] = $order['id'];
            Product::where('id', $product['id'])->update($data_update);   
        }  
    }

    public function insertDesignCommand($products, $order_id, $code)
    {
        $data_insert['order'] = $order_id;
        $data_insert['status'] = \StatusConst::NOT_ACCEPTED;
        $arr_order_action = ['status' => Order::TO_DESIGN, 'apply_design_by' => \User::getCurrent('id')];
        $this->configBaseDataAction($data_insert);
        foreach ($products as $key => $product) {
            $h = $key > 0 ? $key.'.' : '';
            $data_insert['code'] = 'TK-'.$h.''.$code;
            $data_insert['product'] = $product['id'];
            $insert = CDesign::insert($data_insert);
            if ($insert) {
                Product::where('id', $product['id'])->update($arr_order_action);
            }
        }
        $arr_count = ['act' => 1, 'order' => $order_id];
        if (getCountDataTable('products', $arr_count) == getCountDataTable('c_designs', $arr_count)) {
            Order::where('id', $order_id)->update($arr_order_action);
        }
        return 1;
    }
    public function validateElevatehandle($command, $elevate){
        if (empty($command['size_type'])) {
            return returnMessageAjax(100, 'Bạn chưa chọn khổ vật tư trong kho !');
        }

        if (empty($command['nqty'])) {
            return returnMessageAjax(100, 'Bạn chưa nhập số lượng sản phẩm/tờ to !');
        }

        if (empty($elevate['num'])) {
            return returnMessageAjax(100, 'Bạn chưa nhập số lượt bế !');
        }
    }

    public function supply_handle_paper($supply, $size, $c_supply, $over_supply)
    {
        $command = @$c_supply['command'] ?? [];
        $elevate = @$c_supply['elevate'] ?? [];
        $command['qty'] = calValuePercentPlus($command['qty'], $command['qty'], getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
        $valid = $this->validateElevatehandle($command, $elevate);
        if (@$valid['code'] == 100) {
            return returnMessageAjax(100, $valid['message']);
        }
        $insert_command = CSupply::insertCommand($command, $supply);
        if (!empty($c_supply['materal'])) {
            foreach ($c_supply['materal'] as $key => $value) {
                $c_mataeral['size_type'] = $value;
                $c_mataeral['qty'] = (float) @$size['width'] * (float) @$size['length'] * $command['qty'];
                $supply->type = $key;
                CSupply::insertCommand($c_mataeral, $supply);
            }
        }
        if (!$insert_command) {
            return returnMessageAjax(110, 'Không thể tạo yêu cầu xuất vật tư, vui lòng thử lại!');
        }else{
            Paper::where('id', $supply->product)->update(['handle_elevate' => json_encode($elevate)]);
            if (!empty($over_supply['qty'])) {
                $over_supply['qty'] = $command['qty'];
                $supply->type = \TDConst::PAPER;
                PrintWarehouse::insertOverSupply($over_supply, $supply, $size);       
            }
            return returnMessageAjax(200, 'Đã gửi yêu cầu xử lí vật tư thành công!', url('update/orders/'.$supply->order));
        }
    }

    public function supply_handle_carton($supply, $size, $c_supply, $over_supply)
    {
        $command = @$c_supply['command'] ?? [];
        $elevate = @$c_supply['elevate'] ?? [];
        $command['qty'] = calValuePercentPlus($command['qty'], $command['qty'], getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT'), 0, true);
        $valid = $this->validateElevatehandle($command, $elevate);
        if (@$valid['code'] == 100) {
            return returnMessageAjax(100, $valid['message']);
        }
        $insert_command = CSupply::insertCommand($command, $supply);
        if (!$insert_command) {
            return returnMessageAjax(110, 'Không thể tạo yêu cầu xuất vật tư, vui lòng thử lại!');
        }else{
            Supply::where('id', $supply->product)->update(['handle_elevate' => json_encode($elevate)]);
            if (!empty($over_supply['qty'])) {
                $over_supply['qty'] = $command['qty'];
                SupplyWarehouse::insertOverSupply($over_supply, $supply, $size);       
            }
            return returnMessageAjax(200, 'Đã gửi yêu cầu xử lí vật tư thành công!', url('update/orders/'.$supply->order));
        }     
    }

    public function supply_handle_rubber($supply, $size, $c_supply, $over_supply)
    {
        return $this->supply_handle_carton($supply, $size, $c_supply, $over_supply);
    }

    public function supply_handle_styrofoam($supply, $size, $c_supply, $over_supply)
    {
        return $this->supply_handle_carton($supply, $size, $c_supply, $over_supply);
    }

    public function supply_handle_mica($supply, $size, $c_supply, $over_supply)
    {
        return $this->supply_handle_carton($supply, $size, $c_supply, $over_supply);
    }

    public function supply_handle_decal($supply, $size, $c_supply, $over_supply)
    {
        if (empty($c_supply['supp_price'])) {
            return returnMessageAjax(100, 'Bạn chưa chọn vật tư trong kho !');
        } 
    }
}

?>