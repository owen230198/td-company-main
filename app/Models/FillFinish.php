<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use App\Services\QTraits\QuoteTrait;
use App\Services\QTraits\QSupplyTrait;
use App\Services\BaseService; 
 
class FillFinish extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fill_finishes';
    protected $protectFields = false;
    use QuoteTrait, QSupplyTrait;
    const SUPPLY_FIELDS = [
        [
            'name' => 'product_qty',
            'note' => 'SL vật tư dự tính  xuất',
            'type' => 'text', 
            
        ],
        [
            'name' => 'created_by',
            'note' => 'Tạo bởi',
            'type' => 'linking', 
            'other_data' => '{
                "config":{
                    "search":1
                },
                "data":{
                    "table":"n_users"
                }
            }'
            
        ], 
        [
            'name' => 'created_at',
            'note' => 'Tạo lúc',
            'type' => 'datetime', 
            
        ],
    ];
    public function processData($product_id, $product, $type)
    {
        $data = $product[$type];
        $data_process = $this->getDataActionFillFinish($data);
        $data_process['product_qty'] = $product['qty'];
        $data_process['product'] = $product_id;
        (new BaseService)->configBaseDataAction($data_process);
        if ($data_process['product_qty'] > 0) {
            if (!empty($data['id'])) {
                $process = $this->where('id', $data['id'])->update($data_process);   
            }else{
                $process = $this->insert($data_process);
            }
        }
        return !empty($process);
    }
}