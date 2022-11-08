<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
use App\Models\Product;
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
        $data['paper'] = !empty($data['paper'])?json_encode($data['paper']):'';
        return Order::insertGetId($data);
    }
    
    public function insertOrderDetail($data, $orderId)
    {
        $ret = true;
        $listDataProduct = @$data['product']??[];
        $arrTable = OrderConstant::COMMAND_KEY_TABLE;
        if (count($listDataProduct) > 0) {
            foreach ($listDataProduct as $key => $order) {
                $dataInsertProduct = $this->processDataBefore($order);
                $dataInsertProduct['order_id'] = $orderId;
                $product_id = Product::insertGetId($dataInsertProduct);
                foreach ($arrTable as $keyTable => $table) {
                    $dataInsertTable = @$data[$keyTable][$key]??[];
                    if (count($dataInsertTable)>0) {
                        $dataInsertTable = $this->processDataBefore($dataInsertTable);
                        $dataInsertTable['product_id'] = $product_id;
                        $this->db->insert($dataInsertTable);
                    }
                    
                }
            }
        }else{
            return false;
        }
        return $ret;
    }
}

?>