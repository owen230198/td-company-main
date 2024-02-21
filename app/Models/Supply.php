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
    const SUPPLY_FIELDS = [
        [
            'name' => 'supp_qty',
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
        foreach ($data as $supply) {
            $data_process = $this->getDataActionSupply($supply, $type);
            $data_process['name'] = @$supply['name'];
            $data_process['product_qty'] = $supply['qty'];
            $data_process['nqty'] = $supply['nqty'];
            $data_process['double'] = $supply['double'];
            $data_process['base_supp_qty'] = $supply['base_supp_qty'];
            $data_process['compent_percent'] = $supply['compent_percent'];
            $data_process['compent_plus'] = $supply['compent_plus'];
            $data_process['supp_qty'] = $supply['supp_qty'];
            $data_process['type'] = $type;
            $data_process['product'] = $product_id;
            $data_process['note'] = @$supply['note'];
            if ($data_process['supp_qty'] > 0) {
                (new BaseService)->configBaseDataAction($data_process);
                if (!empty($supply['id'])) {
                    $process = $this->where('id', $supply['id'])->update($data_process);   
                }else{
                    $process = $this->insert($data_process);
                }
            }
        }
        return !empty($process);
    }

    public static function getDataWithOrder($id)
    {
        
    }
}