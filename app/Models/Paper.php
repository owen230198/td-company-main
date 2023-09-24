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
        $data = $product[$type];
        foreach ($data as $paper) {
            $data_process = $this->getDataActionPaper($paper);
            $data_process['name'] = $paper['name'];
            $data_process['product_qty'] = $paper['qty'];
            $data_process['nqty'] = $paper['nqty'];
            $data_process['base_supp_qty'] = $paper['base_supp_qty'];
            $data_process['compent_percent'] = $paper['compent_percent'];
            $data_process['compent_plus'] = $paper['compent_plus'];
            $data_process['supp_qty'] = $paper['supp_qty'];
            $data_process['product'] = $product_id;
            $data_process['main'] = !empty($paper['main']) ? $paper['main'] : 0;
            $data_process['ext_cate'] = $paper['ext_cate'];
            (new BaseService)->configBaseDataAction($data_process);
            if (@$data_process['supp_qty'] > 0) {
                if (!empty($paper['id'])) {
                    $process = $this->where('id', $paper['id'])->update($data_process);   
                }else{
                    $process = $this->insert($data_process);
                }
            }
        }
        return !empty($process);
    }

    static function getNilonMetalaiFormula($paper_qty, $work_price, $face_num, $shape_price)
    {
        return $paper_qty * $work_price * $face_num + $shape_price;
    }

    static function getPrintFormula($type, $supp_qty, $color_num, $work_price, $shape_price, $model_price = 0, $is_worker = false)
    {
        $work_color = $is_worker ? 1 : $color_num;
        if ($type == \TDConst::ONE_PRINT_TYPE) {
            // Công thức tính chi phí in một mặt: (SL tờ in + tờ cộng thêm khi in) x số màu x DG lượt + (ĐG chỉnh máy x số màu) + (ĐG khuôn mẫu x số màu)
            return $supp_qty * $work_color * $work_price + ($shape_price * $color_num) + ($model_price * $color_num);
        }else{
            // Công thức tính chi phí các kiểu in còn lại: (SL tờ in + tờ cộng thêm khi in) x số màu x 2 x DG lượt + ĐG chỉnh máy + ĐG khuôn mẫu
            return $supp_qty * $work_color * 2 * $work_price + ($shape_price * $color_num) + ($model_price * $color_num);
        }
    }
}