<?php
 
namespace App\Models;
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
            'name' => 'name',
            'note' => 'Tên vật tư',
            'type' => 'text', 
            
        ],
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
            $dataItem = !empty($supply['id']) ? Supply::find($supply['id']) : '';
            $data_process = $this->getDataActionSupply($supply, $type, $dataItem);
            $data_process['id'] = !empty($supply['id']) ? $supply['id'] : '';
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
                    logActionUserData('update', 'supplies', $supply['id'], $dataItem);    
                }else{
                    $process = $this->insertGetId($data_process);
                    logActionUserData('insert', 'supplies', $process);
                }
            }
        }
        return !empty($process);
    }

    static function getRole()
    {
        $role = [
            \GroupUser::TECH_APPLY => [
                'remove' => 1
            ],
            \GroupUser::SALE => [
                'remove' => 1
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }

}