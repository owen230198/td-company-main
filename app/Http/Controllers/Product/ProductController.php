<?php
namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    function __construct()
    {
        parent::__construct();        
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $data = $this->getDataActionView('products', 'update', 'Chi tiết');
            $proCateOption = getProductCategoryOption();
            $data['listTypeProcate'] = $proCateOption['listTypeProcate'];
            $data['listProcate'] = $proCateOption['listProCate'];
        }
    }
}
?>