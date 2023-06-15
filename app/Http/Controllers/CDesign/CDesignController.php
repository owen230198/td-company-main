<?php
    namespace App\Http\Controllers\CDesign;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\CDesign;
    use App\Models\Order;
    use App\Models\Quote;
    use App\Models\Product;

    class CDesignController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->services = new \App\Services\CDesignService;
            $this->quote_services = new \App\Services\QuoteService;
        }

        public function update(Request $request, $id){
            if (!$request->isMethod('POST')) {
                
            }else{
                    
            }
        }

    }
?>