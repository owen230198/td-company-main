<?php
    namespace App\Http\Controllers\CDesign;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\CDesign;
    use App\Models\Order;
use App\Models\Paper;
use App\Models\Product;

    class CDesignController extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->services = new \App\Services\CDesignService;
            $this->quote_services = new \App\Services\QuoteService;
            $this->order_services = new \App\Services\OrderService;
        }

        public function update(Request $request, $id){
            $arr_command = CDesign::find($id);
            if (!$request->isMethod('POST')) {
                $data['parent_url'] = ['link' => getBackUrl(), 'note' => 'Danh sách lệnh thiết kế'];
                $data['data_order'] = Order::find($arr_command['order']);
                $product = Product::where('id', $arr_command['product'])->first();
                $data['products'][0] = $product;
                $data['data_paper'] = Paper::where(['product' => $product['id']])->get();
                $data['data_command'] = $arr_command;
                $data['id'] = $id;
                $data['title'] = 'Cập nhật & Xác nhận lệnh - '.$arr_command['code'];
                $data['link_action'] = url('update/c_designs/'.$id);
                $data['stage'] = @$arr_command['status'];
                return view('c_designs.view', $data);
            }else{
                if ($arr_command['status'] != CDesign::PROCESSING || $arr_command['assign_by'] != \User::getCurrent('id')) {
                    return returnMessageAjax(100, 'Bạn cần tiếp nhận lệnh trước !');
                }
                $data = $request->input('product');
                return $this->services->processDataCommand($data, $arr_command);       
            }
        }

    }
?>