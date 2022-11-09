<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
use App\Models\Product;
use App\Constants\OrderConstant;
use GuzzleHttp\Psr7\Request;

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
        $data['status'] = OrderConstant::ORDER_NOT_ACCEPT;
        return Order::insertGetId($data);
    }
    
    public function insertOrderDetail($data, $orderId)
    {
        $listDataProduct = @$data['product']??[];
        $arrTable = OrderConstant::COMMAND_KEY_TABLE;
        if (count($listDataProduct) > 0) {
            foreach ($listDataProduct as $key => $order) {
                $dataInsertProduct = $this->processDataBefore($order);
                $dataInsertProduct['order_id'] = $orderId;
                $dataInsertProduct['status'] = OrderConstant::ORDER_NOT_ACCEPT;
                $product_id = Product::insertGetId($dataInsertProduct);
                foreach ($arrTable as $keyTable => $table) {
                    $dataInsertTable = @$data[$keyTable][$key]??[];
                    if (count($dataInsertTable)>0) {
                        $dataInsertTable = $this->processDataBefore($dataInsertTable);
                        $dataInsertTable['product_id'] = $product_id;
                        $dataInsertTable['status'] = OrderConstant::ORDER_NOT_ACCEPT;
                        $this->db::table($table)->insert($dataInsertTable);
                    }
                }
            }
        }else{
            return false;
        }
        return true;
    }

}

?>