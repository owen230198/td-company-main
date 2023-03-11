<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
use App\Models\Product;
use App\Models\CDesign;
use App\Constants\OrderConstant;

class OrderService extends BaseService
{
    function __construct()
    {
        parent::__construct();
    }

    public function insertOrder($data)
    {
        $data = $this->processDataBefore($data);
        $data['payment_status'] = getPaymentStatus((int)@$data['advance_cost'], (int)@$data['total_cost']);
        $data['status'] = OrderConstant::ORDER_NOT_ACCEPTED;
        return Order::insertGetId($data);
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