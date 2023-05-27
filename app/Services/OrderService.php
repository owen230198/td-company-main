<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
use App\Models\Product;
use App\Models\CDesign;
use App\Constants\OrderConstant;
use App\Constants\StatusConstant;

class OrderService extends BaseService
{
    function __construct()
    {
        parent::__construct();
        $this->quote_services = new \App\Services\QuoteService;
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
        $product_process = $this->quote_services->processDataProduct($data, $arr_quote, \GroupUser::GetCurrent());
        if (@$product_process['code'] == 100) {
            return returnMessageAjax(100, $product_process['message']);  
        }else{
            $arr_order['status'] = StatusConstant::NOT_ACCEPTED;
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
    
    public function insertOrderDetail($data, $orderId)
    {
        $listDataProduct = @$data['product']??[];
        $arrTable = OrderConstant::COMMAND_KEY_TABLE;
        if (count($listDataProduct) > 0) {
            foreach ($listDataProduct as $key => $product) {
                $dataInsertProduct = $this->processDataBefore($product);
                $dataInsertProduct['order_id'] = $orderId;
                $dataInsertProduct['name'] = 'TD-'.Time();
                $dataInsertProduct['status'] = OrderConstant::ORDER_NOT_ACCEPTED;
                $product_id = Product::insertGetId($dataInsertProduct);
                foreach ($arrTable as $keyTable => $table) {
                    $dataInsertTable = @$data[$keyTable][$key]??[];
                    if (count($dataInsertTable)>0) {
                        $dataInsertTable = $this->processDataBefore($dataInsertTable);
                        $dataInsertTable['product_id'] = $product_id;
                        $dataInsertTable['order_id'] = $orderId;
                        $dataInsertTable['status'] = OrderConstant::ORDER_NOT_ACCEPTED;
                        $this->db::table($table)->insert($dataInsertTable);
                    }
                }
            }
        }else{
            return false;
        }
        return true;
    }
    
    public function updateOrder($data, $id)
    {
        unset($data['status']);
        $dataUpdate = $this->processDataBefore($data);
        $ret = Order::where('id', $id)->update($dataUpdate);
        if ($ret && !empty($data['customer_id']) && $ret) {
            CDesign::where('order_id', $id)->update($dataUpdateCD);
        }
        return $ret;
    }
    
    public function afterRemove($orderId)
    {
        $arrChildOrderTable = OrderConstant::CHILD_TABLE_ORDER;
        foreach ($arrChildOrderTable as $table) {
            $this->db::table($table)->where('order_id', $orderId)->delete();
        }    
    }
}

?>