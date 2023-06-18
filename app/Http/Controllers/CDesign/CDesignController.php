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
                $arr_command = CDesign::find($id);
                $data['data_order'] = Order::find($arr_command['order']);
                $data['data_product'] = Product::find($arr_command['product']);
                $data['data_command'] = $arr_command;
                $data['id'] = $id;
                if ($arr_command == \StatusConst::NOT_ACCEPTED) {
                    $data['stage'] = Order::TO_DESIGN;
                }
                return view('c_designs.view', $data);
            }else{
                    
            }
        }

    }
?>