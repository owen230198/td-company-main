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
    const SUPPLY_FIELDS = [
        [
            'name' => 'name',
            'note' => 'Tên',
            'type' => 'text' 
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

    public function getDataHandle($paper, $dataItem)
    {
        return $this->getDataActionPaper($paper, $dataItem);
    }
    public function processData($product_id, $product, $type)
    {
        $data = $product[$type];
        foreach ($data as $paper) {
            if (@$paper['handle_type'] == \TDConst::MADE_BY_PARTNER) {
                $process_product['id'] = !empty($paper['id']) ? $paper['id'] : 0;
                $process_product['name'] = $paper['name'];
                $process_product['qty'] = $paper['qty'];
                $process_product['delivery'] = $paper['qty'];
                $process_product['made_by'] = @$paper['made_by'];
                $process_product['total_cost'] = @$paper['total_cost'];
                $process_product['total_amount'] = @$paper['total_amount'];
                $process_product['detail'] = @$paper['detail'];
                $process_product['parent'] = $product_id;
                (new BaseService)->configBaseDataAction($process_product);
                if (!empty($paper['id'])) {
                    $dataItem = Product::find($paper['id']);
                    $process = Product::where('id', $paper['id'])->update($process_product); 
                    logActionUserData('update', 'products', $paper['id'], $dataItem);  
                }else{
                    $process = Product::insertGetId($process_product);
                    logActionUserData('insert', 'products', $process);
                }
            }else{
                $dataItem = !empty($paper['id']) ? Paper::find($paper['id']) : '';
                $data_process = $this->getDataHandle($paper, $dataItem);
                $data_process['id'] = !empty($paper['id']) ? $paper['id'] : 0;
                $data_process['name'] = $paper['name'];
                $data_process['product_qty'] = $paper['qty'];
                $data_process['product'] = $product_id;
                $data_process['main'] = !empty($paper['main']) ? $paper['main'] : 0;
                $data_process['ext_cate'] = @$paper['ext_cate'];
                $data_process['note'] = @$paper['note'];
                if (@$paper['handle_type'] == \TDConst::MADE_BY_OWN) {
                    $data_process['supp_qty'] = $paper['supp_qty'];
                    $data_process['base_supp_qty'] = $paper['base_supp_qty'];
                }
                (new BaseService)->configBaseDataAction($data_process);
                if (@$paper['supp_qty'] > 0 || @$paper['handle_type'] == \TDConst::JOIN_HANDLE) {
                    if (!empty($paper['id'])) {
                        $process = $this->where('id', $paper['id'])->update($data_process);
                        logActionUserData('update', 'papers', $paper['id'], $dataItem);  
                    }else{
                        $process = $this->insertGetId($data_process);
                        logActionUserData('insert', 'papers', $process);
                    }
                }
            }
        }
        return !empty($process) ? $process : false;
    }

    static function getNilonMetalaiFormula($paper_qty, $work_price, $face_num, $shape_price, $factor = 1)
    {
        return $paper_qty * $work_price * $face_num * $factor + $shape_price;
    }

    static function getPrintFormula($type, $supp_qty, $color_num, $work_price, $shape_price, $model_price = 0, $is_worker = false, $factor = 1)
    {
        $work_color = $is_worker ? 1 : $color_num;
        $num_color = $color_num == \TDConst::APLA_PRINT_COLOR ? 1 : (int) $color_num;
        if ($type == \TDConst::ONE_PRINT_TYPE) {
            // Công thức tính chi phí in một mặt: (SL tờ in + tờ cộng thêm khi in) x số màu x DG lượt + (ĐG chỉnh máy x số màu) + (ĐG khuôn mẫu x số màu)
            return ($supp_qty * $work_color * $work_price + ($shape_price * $num_color) + ($model_price * $num_color)) * $factor;
        }else{
            // Công thức tính chi phí các kiểu in còn lại: (SL tờ in + tờ cộng thêm khi in) x số màu x 2 x DG lượt + ĐG chỉnh máy + ĐG khuôn mẫu
            return ($supp_qty * $work_color * 2 * $work_price + ($shape_price * $num_color) + ($model_price * $num_color)) * $factor;
        }
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