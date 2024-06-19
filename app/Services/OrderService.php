<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Product;
use \App\Models\CDesign;
use \App\Models\CSupply;
use App\Models\OtherWarehouse;
use App\Models\PrintWarehouse;
use App\Models\Supply;
use App\Models\SupplyWarehouse;
use App\Models\WSalary;

class OrderService extends BaseService
{
    function __construct()
    {
        parent::__construct();
        $this->quote_services = new \App\Services\QuoteService;
    }

    public function getBaseDataAction()
    {
        $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách đơn hàng'];
        return $data;
    }

    public function processDataOrder($request, $base_obj = null)
    {
        $data = $request->except('_token');
        $arr_order = !empty($data['order']) ? $data['order'] : [];
        if ((int) @$arr_order['advance'] > 0 && empty($arr_order['rest_bill'])) {
            return ['code' => 100, 'message' => 'Bạn cần upload bill tạm ứng cho đơn này !'];
        }
        $type_refresh = !empty($data['type_refresh']) ? $data['type_refresh'] : 2;
        $product_process = $this->quote_services->processDataProduct($data, $base_obj, $type_refresh);
        if (!empty($product_process['code']) && $product_process['code'] == 100) {
            return returnMessageAjax(100, $product_process['message']);  
        }else{
            $arr_total = getTotalProductByArr($data['product']);
            $amount = $arr_total['total_amount'];
            $arr_order['total_cost'] = $arr_total['total_cost'];
            $arr_order['base_total'] = $arr_total['base_total'];
            $arr_order['total_amount'] = @$arr_order['vat'] == 1 ? 
            calValuePercentPlus($amount, $amount, (float) getDataConfig('QuoteConfig', 'VAT_PERC', 0)) : $amount;
            $arr_order['rest'] = $arr_order['total_amount'] - (float) $arr_order['advance'];
            $this->configBaseDataAction($arr_order);
            if (!empty($arr_order['id'])) {
                $dataItem = Order::find($arr_order['id']);
                Order::where('id', $arr_order['id'])->update($arr_order);
                logActionUserData('update', 'orders', $arr_order['id'], $dataItem);
                $arr_order['code'] = 'DH-'.sprintf("%08s", $arr_order['id']);
            }else{
                if (!empty($base_obj) && $base_obj->getTable() == 'quotes') {
                    $quote_obj = Quote::find($base_obj->id);
                    $quote_obj->status = Quote::ORDER_CREATED;
                    $quote_obj->save();
                    $arr_order['name'] = $quote_obj->name;
                    $arr_order['quote'] = $quote_obj->id;
                    $arr_order['profit'] = $quote_obj->profit;
                    $arr_order['ship_price'] = $quote_obj->ship_price;
                }
                $arr_order['status'] = \StatusConst::NOT_ACCEPTED;
                $arr_order['id'] = Order::insertGetId($arr_order);
                logActionUserData('insert', 'orders', $arr_order['id']);
                $arr_order['code'] = 'DH-'.sprintf("%08s", $arr_order['id']);
                Order::where('id', $arr_order['id'])->update($arr_order);
            }
            $this->handleProductAfter($data['product'], $arr_order);
            return returnMessageAjax(200, 'Cập nhật dữ liệu thành công!', getBackUrl());     
        }
    }

    public function handleProductAfter($data, $order)
    {
        foreach ($data as $key => $product) {
            $data_update['code'] =  $order['code'].getCharaterByNum($key);
            if (!empty($order['status'])) {
                $data_update['status'] = $order['status'];
            }
            $data_update['order'] = $order['id'];
            $data_update['order_created'] = 1;
            Product::where('id', $product['id'])->update($data_update);
            $this->handleCommandCode($product, $data_update['code']); 
        }  
    }

    public function handleCommandCode($product, $code)
    {
        $elements = getProductElementData($product['category'], $product['id'], false);
        $count = -1;
        foreach ($elements as $element) {
            if (!empty($element['data'])) {
                $el_data = $element['data'];
                foreach ($el_data as $supply) {
                    $table_supply = $element['table'];
                    $data_update['status'] = \StatusConst::NOT_ACCEPTED;
                    $count++;
                    $_code =  $code.getCharaterByNum($count);
                    $data_update['code'] = $_code;
                    getModelByTable($table_supply)->where('id', $supply->id)->update($data_update);
                }
            }
        }
    }

    public function insertDesignCommand($products, $order_id, $code)
    {
        $data_insert['order'] = $order_id;
        $data_insert['status'] = \StatusConst::NOT_ACCEPTED;
        $dg_status = Order::TO_DESIGN;
        $this->configBaseDataAction($data_insert);
        foreach ($products as $key => $product) {
            $h = $key > 0 ? $key.'.' : '';
            $data_insert['code'] = 'TK-'.$h.''.$code;
            $data_insert['name'] = $product['name'];
            $data_insert['product'] = $product['id'];
            $design_id = CDesign::insertGetId($data_insert);
            logActionUserData('insert', 'c_designs', $design_id);
            if ($design_id) {
                logActionDataById('products', $product['id'], ['status' => $dg_status], $dg_status);
            }
        }
        $arr_count = ['act' => 1, 'order' => $order_id];
        if (getCountDataTable('products', $arr_count) == getCountDataTable('c_designs', $arr_count)) {
            logActionDataById('orders', $order_id, ['status' => $dg_status], $dg_status);
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

    private function checkLackSupplyHandle($arr_supply)
    {
        foreach ($arr_supply as $supply) {
            if ((int) @$supply['lack'] == 0) {
                return true;
                break;
            }
        }
    }

    public function supply_handle_paper($supply, $size, $c_supply, $over_supply)
    {
        $squares = @$c_supply['square'] ?? [];
        foreach ($squares as $key => $supp_qsuare) {
            if (!$this->checkLackSupplyHandle($supp_qsuare)) {
                return returnMessageAjax(100, 'Vật tư '.getSupplyNameByKey($key).' trong kho không đủ để sản xuất, Vui lòng gửi yêu cầu đến phòng mua !');
            }
            foreach ($supp_qsuare as $square) {
                if (@$square['qty'] == 0) {
                    return returnMessageAjax(100, 'Số lượng vật tư '.getSupplyNameByKey($key).' Không hợp lệ !');
                }
            }
        }
        $papers = @$c_supply['paper'] ?? [];
        if (!$this->checkLackSupplyHandle($papers)) {
            return returnMessageAjax(100, 'Vật tư giấy in trong kho không đủ để sản xuất, Vui lòng gửi yêu cầu đến phòng mua !');
        }
        foreach ($papers as $key => $paper) {
            if (empty($paper['size_type'])) {
                return returnMessageAjax(100, 'bạn chưa chọn vật tư giấy in trong  kho !');
            }
            if ($paper['qty'] == 0) {
                return returnMessageAjax(100, 'Số lượng vật tư cần xuất không hợp lệ !');
            }
        }
        foreach ($papers as $key => $paper) {
            unset($paper['lack']);
            $insert_command = CSupply::insertCommand($paper, $supply);
        }
        foreach ($squares as $key => $supp_qsuare) {
            foreach ($supp_qsuare as $square) {
                $supply->type = $key;
                unset($square['lack']);
                CSupply::insertCommand($square, $supply);
            }
        }
        if (empty($insert_command)) {
            return returnMessageAjax(110, 'Không thể tạo yêu cầu xuất vật tư, vui lòng thử lại!');
        }else{
            if (!empty($over_supp)) {
                foreach ($over_supply as $over_supp) {
                    if ($over_supp['qty'] > 0) {
                        $supply->type = \TDConst::PAPER;
                        PrintWarehouse::insertOverSupply($over_supp, $supply, $size);       
                    }
                }
            }
            return returnMessageAjax(200, 'Đã gửi yêu cầu xử lí vật tư thành công!', getBackUrl());
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
        $supply_obj = SupplyWarehouse::find($command['size_type']);
        if (@$supply_obj->qty < $command['qty']) {
            return returnMessageAjax(100, 'Vật tư trong kho không đủ để sản xuất đơn này, Vui lòng gửi yêu cầu đến phòng mua !');
        }
        unset($command['nqty']);
        $insert_command = CSupply::insertCommand($command, $supply);
        if (!$insert_command) {
            return returnMessageAjax(110, 'Không thể tạo yêu cầu xuất vật tư, vui lòng thử lại!');
        }else{
            Supply::where('id', $supply->id)->update(['handle_elevate' => json_encode($elevate)]);
            if (!empty($over_supply['qty'])) {
                $over_supply['qty'] = $command['qty'];
                SupplyWarehouse::insertOverSupply($over_supply, $supply, $size);       
            }
            return returnMessageAjax(200, 'Đã gửi yêu cầu xử lí vật tư thành công!', getBackUrl());
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

    private function baseHandleSquareSupply($supply, $c_supply, $supp_key)
    {
        $squares = @$c_supply['square'] ?? [];
        $supply->type = $supp_key;
        if (!empty($squares[$supply->type])) {
            $decal = !empty($squares[$supply->type][0]) ? $squares[$supply->type][0] : [];
            if (empty($decal['size_type']) || empty($decal['qty'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn vật tư trong kho !');
            }
            if (!$this->checkLackSupplyHandle($squares[$supply->type])) {
                return returnMessageAjax(100, 'Vật tư '.getSupplyNameByKey($supply->type).' trong kho không đủ để sản xuất, Vui lòng gửi yêu cầu đến phòng mua !');
            }
            unset($decal['lack']);
            $insert = CSupply::insertCommand($decal, $supply);
            if ($insert) {
                return returnMessageAjax(200, 'Đã gửi yêu cầu xử lí vật tư thành công!', getBackUrl());
            }else{
                return returnMessageAjax(100, 'Lỗi không xác định !');
            }
        }else{
            return returnMessageAjax(100, 'Bạn chưa chọn vật tư trong kho !');
        } 
    }

    public function supply_handle_decal($supply, $size, $c_supply, $over_supply)
    {
        return $this->baseHandleSquareSupply($supply, $c_supply, \TDConst::DECAL);
    }

    public function supply_handle_silk($supply, $size, $c_supply, $over_supply)
    {
        return $this->baseHandleSquareSupply($supply, $c_supply, \TDConst::SILK);
    }

    public function supply_handle_fill_finish($supply, $size, $c_supply, $over_supply)
    {
        if (empty($c_supply['supp_price'])) {
            return returnMessageAjax(100, 'Bạn chưa chọn vật tư trong kho !');
        }  
        
        $data_magnet = !empty($supply->magnet) ? json_decode($supply->magnet, true) : [];
        $temp_qty = (int) @$data_magnet['qty'] * @$supply->product_qty;
        $take_qty = calValuePercentPlus($temp_qty, $temp_qty, getDataConfig('QuoteConfig', 'MAGNET_COMPEN_PERCENT'));
        if ($take_qty == 0) {
            return returnMessageAjax(100, 'Số lượng vật tư không hợp lệ !');
        }
        $warehouse = OtherWarehouse::find($c_supply['supp_price']);
        if (@$warehouse->qty < $take_qty) {
            return returnMessageAjax(100, 'Số lượng vật tư nam châm trong kho không đủ để sản xuất, vui lòng gửi yêu cầu đến phòng mua !');
        }
        $command['size_type'] = $c_supply['supp_price'];
        $command['qty'] = $take_qty;
        $supply->type = \TDConst::MAGNET;
        $insert_command = CSupply::insertCommand($command, $supply);
        if (!$insert_command) {
            return returnMessageAjax(110, 'Không thể tạo yêu cầu xuất vật tư, vui lòng thử lại!');
        }else{
            return returnMessageAjax(200, 'Đã gửi yêu cầu xử lí vật tư thành công!', getBackUrl());
        }   
    }

    public function createWorkerCommand($obj_order)
    {
        $elements = getProductElementData($obj_order->category, $obj_order->id, true, false); 
        foreach ($elements as $element) {
            if (!empty($element['data'])) {
                $el_data = $element['data'];
                foreach ($el_data as $supply) {
                    $table_supply = $element['table'];
                    $data_command = getStageActiveStartHandle($table_supply, $supply->id);
                    $type = $data_command['type'];
                    $data_update['status'] = $type;
                    $update = getModelByTable($table_supply)->where('id', $supply->id)->update($data_update);
                    $data_handle = !empty($data_command['handle']) ? $data_command['handle'] : [];
                    if ($type != \StatusConst::SUBMITED && $update && (int) @$data_handle['handle_qty'] > 0) {
                        $data_command['qty'] = $data_handle['handle_qty'];
                        $code = $supply->code;
                        if ($type == \TDConst::FILL && !empty($data_handle['stage'])) {
                            foreach ($data_handle['stage'] as $fillkey => $stage) {
                                $data_command['name'] = $obj_order->name.'('.getFieldDataById('name', 'materals', @$stage['materal']).')';
                                $data_command['fill_handle'] = json_encode($stage);
                                $data_command['handle'] = $stage;
                                $data_command['machine_type'] = getFieldDataById('type', 'devices', $stage['machine']);
                                $data_command['fill_materal'] = $stage['materal'];
                                $fill_code = $code.''.getCharaterByNum($fillkey);
                                WSalary::commandStarted($fill_code, $data_command, $table_supply, $supply);
                            }
                        }else{
                            if (!empty($data_handle['machine'])) {
                                $data_command['name'] = getNameCommandWorker($supply, $obj_order->name);
                                WSalary::CommandStarted($code, $data_command, $table_supply, $supply); 
                            }   
                        }
                    }
                }
            }
        }
        return 1;
    }
}

?>