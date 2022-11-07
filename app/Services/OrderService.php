<?php
namespace App\Services;
use App\Services\BaseService;
use App\Models\Order;
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
        $arrTable = OrderConstant::DETAIL_ORDER_KEY_TABLE;
        $ret = true;
        foreach ($arrTable as $key => $table) {
            $listData = @$data[$key]??[];
            if (count($listData)>0) {
                foreach ($listData as $data) {
                    $dataInsert = $this->processDataBefore($data);
                    $dataInsert['order_id'] = $orderId;
                    $insert = $this->db::table($table)->insert($dataInsert);
                    if (!$insert) {
                        $ret = false;
                    }
                }
            }
        }
        return $ret;
    }
}

?>