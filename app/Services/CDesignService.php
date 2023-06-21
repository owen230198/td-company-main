<?php
    namespace App\Services;
    use App\Services\BaseService;
    use App\Models\Order;
    use App\Models\Quote;
    use App\Models\Product;
    use \App\Models\CDesign;

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
                CDesign::where('id', $command['id'])->update(['status' => Order::DESIGN_SUBMITED]);
                $command_list = CDesign::where('order', $command['order']);
                if ($command_list->count() == $command_list->where('status', Order::DESIGN_SUBMITED)->count()) {
                    Order::where('id', $command['order'])->update(['status' => Order::DESIGN_SUBMITED]);
                }
                return returnMessageAjax(200, 'Cập nhật thành công lệnh thiết kế!', url(''));  
            }
        }
    }

?>