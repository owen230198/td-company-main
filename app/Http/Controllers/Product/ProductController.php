<?php
namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use App\Models\CDesign;
use App\Models\Product;
use App\Models\CProcess;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    function __construct()
    {
        parent::__construct();        
    }

    private function getProductActionViewData($action, $actionName)
    {
        $data = $this->getDataActionView('products', $action, $actionName);
        $proCateOption = getProductCategoryOption();
        $data['listTypeProcate'] = $proCateOption['listTypeProcate'];
        $data['listProCate'] = $proCateOption['listProCate'];
        $data['listPaperSubs'] = $proCateOption['listPaperSubs'];
        return $data;
    }

    public function update(Request $request, $id)
    {
        if (!$request->isMethod('POST')) {
            $data = $this->getProductActionViewData('update', 'Chi tiết');
            $data['dataItemProduct'] = Product::find($id);
            if ($data['dataItemProduct']) {
                $data['dataItemCDesign'] = CDesign::where('product_id', $id)->first();
                $itemProcess = CProcess::where('product_id', $id)->first();
                $data['dataItemCProcess'] = $itemProcess;
                $processData = !empty($itemProcess['json_data_conf'])?json_decode($itemProcess['json_data_conf'], true):[];
                $data['listProcess'] = array_keys($processData);
                $data['dataConfProcess'] = $processData;
            }
            return view('orders.products.view', $data);
        }
    }

    public function getProcessByCategory(Request $request)
    {
        $cate_id = @$request->cate_id??0;
        $key = @$request->key??0;
        if ($cate_id) {
            $category = getDetailDataByID('ProductCategory', $cate_id);
            $listProcess = !empty($category['json_data_process'])?json_decode($category['json_data_process'],true):[];
            $processActive = array_filter($listProcess, function($item){
                return $item == 1;
            });
            $data['listProcess'] = array_keys($processActive);
            $data['key'] = $key;
            return view('orders.products.process_ajax.view', $data);       
        }
    }
}
?>