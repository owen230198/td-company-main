<?php

namespace App\Models;

use App\Services\WarehouseService;
use Illuminate\Database\Eloquent\Model;

class SupplyBuying extends Model
{
    protected $table = 'supply_buyings';
    protected $protectFields = false;
    const BOUGHT = 'bought';

    static function checkReadOnlyInputPrice($status)
    {
        return \GroupUser::isAdmin() ? 0 : (\GroupUser::isDoBuying() && ($status == \StatusConst::PROCESSING || $status == \StatusConst::NOT_ACCEPTED) ? 0 : 1);
    }
    static function getFeildSupplyJson($value = [], $status)
    {
        $field_supp_type = [
            'name' => 'type',
            'note' => 'Loại vật tư',
            'attr' => [
                "required" => 1, 
                "inject_class" => "__select_supp_type_buying", 
                "readonly" => \GroupUser::isAdmin() || \GroupUser::isPlanHandle() ? 0 : 1],
            'type' => 'select',
            'value' => !empty($value['supp_type']) ? $value['supp_type'] : '',
            'other_data' => [
                "config" => [ "searchbox"=> 1],
                "data" => [
                    "options" => [
                        "0" => "Chọn loại vật tư",
                        "paper" => "Giấy in", 
                        "nilon" => "Màng nilon", 
                        "metalai" => "Màng metalai",
                        "cover" => "Màng phủ trên",
                        "carton" => "Carton",
                        "rubber" => "Cao su",
                        "styrofoam" => "Mút phẳng",
                        "decal" => "Nhung",
                        "silk" => "Vải lụa",
                        "mica" => "Mi ca",
                        "magnet" => "Nam châm",
                        "emulsion" => "Nhũ",
                        "skrink" => "Màng co",
                        "other" => "Vật tư khác"
                    ]
                ]
            ]
        ];
        $field_price = [
            'name' => 'price',
            'type' => 'text',
            'note' => 'Đơn giá vật tư',
            'attr' => [
                'type_input' => 'price', 
                'inject_class' => '__buying_price_input __buying_change_input', 
                'readonly' => self::checkReadOnlyInputPrice($status)
            ],
        ];
        $field_total = [
            'name' => 'total',
            'type' => 'text',
            'note' => 'Thành tiền',
            'attr' => ['type_input' => 'price', 'readonly' => 1, 'inject_class' => '__buying_total_input']
        ];
        if (self::canHandle()) {
            return [
                $field_supp_type,
                $field_price,
                $field_total
            ];
        }
        if (\GroupUser::isPlanHandle()) {
            return [
                $field_supp_type,
            ];
        }elseif(\GroupUser::isApplyBuying()){
            return [
                $field_supp_type,
            ];    
        }elseif(\GroupUser::isDoBuying()){
            return [
                $field_supp_type,
                $field_price,
                $field_total
            ];     
        }elseif (\GroupUser::isWarehouse()) {
            return [
                $field_supp_type,
            ]; 
        }    
    }

    static function canHandle()
    {
        return \GroupUser::isAdmin() || \GroupUser::isAccounting();
    }

    static function getFieldQtyArr($type, $status = '')
    {
        $admin_dobuying = self::checkReadOnlyInputPrice($status) == 0  ? 0 : 1;
        return WarehouseService::getQtyFieldByType($type, !$admin_dobuying || \GroupUser::isPlanHandle() ? 0 : 1);
    }

    static function getRole()
    {
        $current_user = \User::getCurrent('id');
        $role = [
            \GroupUser::PLAN_HANDLE => [
                'insert' => 1,
                'view' => 
                    [
                        'with' => [
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => $current_user]
                            ]
                        ]
                    ],
                'update' => 
                    [
                        'with' => [[
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => $current_user],
                                ['key' => 'status', 'value' => \StatusConst::PROCESSING]
                            ]
                        ]]
                    ],
            ],
            \GroupUser::APPLY_BUYING => [
                'view' => 
                    [
                        'with' => [
                            'type' => 'group',
                            'query' => [
                                ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                            ]
                        ]
                    ],
                'update' => ['with' => [['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]]]
            ],
            \GroupUser::DO_BUYING => [
                'view' => [
                    'with' => [
                                'type' => 'group',
                                'query' => [
                                    ['con' => 'or', 'key' => 'status', 'value' => \StatusConst::PROCESSING],
                                    ['con' => 'or', 'key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED],
                                    ['con' => 'or', 'key' => 'status', 'value' => \StatusConst::ACCEPTED],
                                    ['con' => 'or', 'key' => 'contact_by', 'value' => $current_user],
                                    ['con' => 'or', 'key' => 'bought_by', 'value' => $current_user]
                                ]
                            ],
                ],
                'update' => 
                [
                    'with' => [[
                        'type' => 'group',
                        'query' => [
                            ['key' => 'contact_by', 'value' => $current_user],
                            ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                        ]
                    ]]
                ]
            ],
            \GroupUser::WAREHOUSE => [
                'view' => ['with' => 
                    [
                        'type' => 'group',
                        'query' => [
                            ['key' => 'type', 'compare' => 'in', 'value' => \User::getSupplyRole()],
                            ['key' => 'status', 'value' => self::BOUGHT]
                        ]
                    ],
                ]
                ],
                \GroupUser::ACCOUNTING => [
                    'view' => ['with' => 
                        [
                            'type' => 'group',
                            'query' => [
                                ['key' => 'status', 'value' => \StatusConst::SUBMITED]
                            ]
                        ],
                    ]
                ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 
}
