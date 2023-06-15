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
    }

?>