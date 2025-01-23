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
    static function getRole()
    {
        $role = [
            \GroupUser::PLAN_HANDLE => [
                'view' => 
                    [
                        'with' => [
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                            ]
                        ]
                    ],
                'update' => 
                    [
                        'with' => [
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                            ]
                        ]
                    ]
            ],
            \GroupUser::APPLY_BUYING => [
                'view' => ['with' => ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]],
                'update' => ['with' => [['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]]]
            ],
            \GroupUser::DO_BUYING => [
                'view' => ['with' => ['key' => 'status', 'value' => \StatusConst::PROCESSING]]
            ],
            \GroupUser::WAREHOUSE => [
                'view' => ['with' => ['key' => 'status', 'value' => SupplyBuying::BOUGHT]]
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 

    static function processData($data, $parent)
    {
        $data['parent'] = $parent;
        $data['status'] = \StatusConst::PROCESSING;
        (new \BaseService())->configBaseDataAction($data);
        if (!empty($data['id'])) {
            logActionDataById('supply_buyings', $data['id'], $data, 'update');  
        }else{
            $log_id = BuyingItem::insertGetId($data);
            logActionUserData('insert', 'supply_buyings', $log_id, $data);
        }
    }
}
