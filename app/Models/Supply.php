<?php
 
namespace App\Models;

use App\Constants\TDConstant;
use Illuminate\Database\Eloquent\Model;
use App\Services\QTraits\QuoteTrait;
use App\Services\QTraits\QSupplyTrait;
use App\Services\BaseService; 
class Supply extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supplies';
    protected $protectFields = false;
    use QuoteTrait, QSupplyTrait;
    public function processData($product_id, $product, $type)
    {
        $data = $product[$type];
        foreach ($data as $supply) {
            if ($type == TDConstant::DECAL) {
                if (in_array($supply['nqty'], [TDConstant::CARTON, TDConstant::RUBBER])) {
                    $supply['size']['length'] = !empty($product[$supply['nqty']][0]['size']['length']) ? $product[$supply['nqty']][0]['size']['length'] : 0;
                    $supply['size']['width'] = !empty($product[$supply['nqty']][0]['size']['width']) ? $product[$supply['nqty']][0]['size']['width'] : 0;
                }
                if (in_array($supply['supp_qty_linking'], [TDConstant::CARTON, TDConstant::RUBBER])) {
                    $supply['supp_qty'] = !empty($product[$supply['nqty']][0]['supp_qty']) ? $product[$supply['nqty']][0]['supp_qty'] : 0;
                }
            }
            $data_process = $this->getDataActionSupply($supply);
            $data_process['product_qty'] = $supply['qty'];
            $data_process['nqty'] = $supply['nqty'];
            $data_process['supp_qty_linking'] = @$supply['supp_qty_linking'];
            $data_process['supp_qty'] = @$supply['supp_qty'];
            $data_process['type'] = $type;
            $data_process['product'] = $product_id;
            (new BaseService)->configBaseDataAction($data_process);
            if (!empty($supply['id'])) {
                $process = $this->where('id', $supply['id'])->update($data_process);   
            }else{
                $process = $this->insert($data_process);
            }
        }
        return !empty($process);
    }
}