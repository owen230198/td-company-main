<?php
    namespace App\Services;
    use App\Services\BaseService;
    use App\Models\Order;
    use App\Models\CDesign;
    use App\Models\Product;

    class CDesignService extends BaseService
    {
        function __construct()
        {
            parent::__construct();
            $this->quote_services = new \App\Services\QuoteService;
        }

        public function processDataCommand($data, $command)
        {
            if (count($data) == 0) {
                return returnMessageAjax(100, 'Không có dữ liệu đc cập nhật!');
            }
            $process_product = $this->quote_services->processProduct($data[0], \TDConst::ORDER_ACTION_FLOW);
            if (!empty($process_product['code']) && $process_product['code'] == 100) {
                return $process_product;
            }else{
                $arr_where = ['status' => Order::DESIGN_SUBMITED];
                $update = CDesign::where('id', $command['id'])->update($arr_where);
                if ($update) {
                    Product::where('id', $command['product'])->update($arr_where);
                }
                $command_list = CDesign::where('order', $command['order']);
                if ($command_list->count() == $command_list->where($arr_where)->count()) {
                    Order::where('id', $command['order'])->update($arr_where);
                }
                return returnMessageAjax(200, 'Cập nhật thành công lệnh thiết kế!', session()->get('back_url'));  
            }
        }
    }

?>