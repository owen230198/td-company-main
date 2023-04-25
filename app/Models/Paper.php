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
            $data_process = $this->getDataActionPaper($paper);
            $data_process['name'] = $paper['name'];
            $data_process['product_qty'] = $paper['qty'];
            $data_process['nqty'] = $paper['nqty'];
            $data_process['supp_qty'] = $paper['supp_qty'];
            $data_process['product'] = $product_id;
            $data_process['main'] = !empty($paper['main']) ? $paper['main'] : 0;
            (new BaseService)->configBaseDataAction($data_process);
            if (!empty($paper['id'])) {
                $this->where('id', $paper['id'])->update($data_process);   
            }else{
                $this->insert($data_process);
            }
            $cost += $data_process['total_cost'];
        }
        return $cost;
    }
}