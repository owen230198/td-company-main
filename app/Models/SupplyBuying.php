<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SupplyBuying extends Model
{
    protected $table = 'supply_buyings';
    protected $protectFields = false;
    const BOUGHT = 'bought';
    static function getFeildSupplyJson($index, $value = [])
    {
        $base_name = 'supply['.$index.']';
        $field_supp_type = [
            'name' => 'group_supply', 
            'note' => 'Dạng vật tư',
            'type' => 'group',
            'other_data' => ['group_class' => '__module_select_type_warehouse'],
            'child' => [
                [
                    'name' => $base_name.'[supp_type]',
                    'attr' => '{"required":1,"inject_class":"__wh_select_type","readonly":'.!\GroupUser::isPlanHandle().'}',
                    'type' => 'select',
                    'value' => !empty($value['supp_type']) ? $value['supp_type'] : '',
                    'other_data' => '{
                        "config":{
                            "searchbox":1
                        },
                        "data":{
                            "options":{
                                "0":"Chọn loại vật tư",
                                "paper":"Giấy in", 
                                "nilon":"Màng nilon", 
                                "metalai":"Màng metalai",
                                "cover":"Màng phủ trên",
                                "carton":"Carton",
                                "rubber":"Cao su",
                                "styrofoam":"Mút phẳng",
                                "decal":"Nhung",
                                "silk":"Vải lụa",
                                "mica":"Mi ca",
                                "magnet":"Nam châm"
                            }
                        }
                    }'
                ],
                [
                    'name' => $base_name.'[size_type]',
                    'attr' => '{"required":1,"readonly":1,"inject_class":"__wh_select_size"}',
                    'type' => 'linking',
                    'value' => !empty($value['size_type']) ? $value['size_type'] : '',
                    'other_data' => '{
                        "config":{
                            "search":1,
                            "except_linking":"1"
                        },
                        "data":{
                            "table":{
                                "getFunc":"getTableWarehouseByType"
                            }
                        }
                    }'
                ]
            ] 
        ];
        $field_qty = [
            'name' => 'qty',
            'type' => 'text',
            'note' => 'Số lượng',
            'attr' => ['type_input' => 'number', 'inject_class' => '__buying_qty_input __buying_change_input', 'readonly' => !\GroupUser::isPlanHandle()]
        ];
        $field_price = [
            'name' => 'price',
            'type' => 'text',
            'note' => 'Đơn giá vật tư',
            'attr' => ['type_input' => 'number', 'inject_class' => '__buying_price_input __buying_change_input', 'readonly' => !\GroupUser::isDoBuying()],
        ];
        $field_total = [
            'name' => 'total',
            'type' => 'text',
            'note' => 'Thành tiền',
            'attr' => ['type_input' => 'number', 'readonly' => 1, 'inject_class' => '__buying_total_input']
        ];
        if (\GroupUser::isPlanHandle()) {
            return [
                $field_supp_type,
                $field_qty
            ];
        }elseif(\GroupUser::isApplyBuying()){
            return [
                $field_supp_type,
                $field_qty
            ];    
        }elseif(\GroupUser::isDoBuying()){
            return [
                $field_supp_type,
                $field_qty,
                $field_price,
                $field_total
            ];     
        }elseif (\GroupUser::isWarehouse()) {
            return [
                $field_supp_type,
                $field_qty
            ]; 
        }elseif (\GroupUser::isAdmin()) {
            return [
                $field_supp_type,
                $field_qty,
                $field_price,
                $field_total
            ];
        }      
    }
    static function getRole()
    {
        $role = [
            \GroupUser::PLAN_HANDLE => [
                'insert' => 1,
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
                'update' => ['with' => ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]]
            ],
            \GroupUser::DO_BUYING => [
                'view' => ['with' => ['key' => 'status', 'value' => \StatusConst::ACCEPTED]]
            ],
            \GroupUser::WAREHOUSE => [
                'view' => ['with' => ['key' => 'status', 'value' => self::BOUGHT]]
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 
}
