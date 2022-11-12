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
            if (is_array($data['dataItemProduct']) && count($data['dataItemProduct'])>0) {
                $data['dataItemCDesign'] = CDesign::where('product_id', $id)->first();
                $data['dataItemCProcess'] = CProcess::where('product_id', $id)->first();
            }
            return view('orders.products.view', $data);
        }
    }
}
?>