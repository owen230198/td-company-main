<?php
namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use App\Models\Product;
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
            return view('orders.products.view', $data);
        }
    }
}
?>