<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BuyingItem extends Model
{
    protected $table = 'buying_items';
    protected $protectFields = false;
    protected $guarded = [];

    static function validate($data)
    {
        foreach ($data as $key => $supply) {
            $num = $key + 1;
            if (empty($supply['type'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn nhóm vật tư thứ '.$num.'!');
                break;
            }
            if (empty($supply['target'])) {
                return returnMessageAjax(100, 'Bạn chưa chọn loại vật tư thứ '.$num.'!');
                break;
            }
            if (SupplyBuying::hasSizeSupply($supply['type'])) {
                if (empty($supply['length'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập KT chiều dài cho vật tư thứ '.$num.'!');
                    break;
                }
                if (empty($supply['width'])) {
                    return returnMessageAjax(100, 'Bạn chưa nhập KT chiều rộng cho vật tư thứ '.$num.'!');
                    break;
                }
            }
            if (empty($supply['qty'])) {
                return returnMessageAjax(100, 'Bạn chưa nhập số lượng mua thêm cho vật tư thứ '.$num.'!');
                break;
            }
        }
    }

}
