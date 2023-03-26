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
    public function insertData($product_id, $data)
    {
        foreach ($data as $paper) {
            $data_insert = $this->getDataActionPaper($paper);
            $data['name'] = $paper['name'];
            $data_insert['product_qty'] = $paper['qty'];
            $data_insert['nqty'] = $paper['nqty'];
            $data_insert['paper_qty'] = $paper['paper_qty'];
            $data_insert['product'] = $product_id;
            $data_insert['main'] = !empty($paper['main']) ? $paper['main'] : 0;
            (new BaseService)->configBaseDataAction($data_insert);
            return $this->insert($data_insert);
         }
    }
}