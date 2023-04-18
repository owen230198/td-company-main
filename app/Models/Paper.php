<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use App\Services\QTraits\QPaperTrait;
use App\Services\QTraits\QuoteTrait;
use App\Services\BaseService;
class Paper extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'papers';
    protected $protectFields = false;
    use QPaperTrait, QuoteTrait;
    public function processData($product_id, $product, $type)
    {
        $cost = 0;
        $data = $product[$type];
        foreach ($data as $paper) {
            $data_insert = $this->getDataActionPaper($paper);
            $data['name'] = $paper['name'];
            $data_insert['product_qty'] = $paper['qty'];
            $data_insert['nqty'] = $paper['nqty'];
            $data_insert['paper_qty'] = $paper['paper_qty'];
            $data_insert['product'] = $product_id;
            $data_insert['main'] = !empty($paper['main']) ? $paper['main'] : 0;
            (new BaseService)->configBaseDataAction($data_insert);
            $this->insert($data_insert);
            $cost += $data_insert['total_cost'];
        }
        return $cost;
    }
}