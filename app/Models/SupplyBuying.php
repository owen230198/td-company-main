<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SupplyBuying extends Model
{
    protected $table = 'supply_buyings';
    protected $protectFields = false;
    static function getFeildSupplyJson($index, $value = [])
    {
        $field_supp_type = [
            'name' => 'group_supply', 
            'note' => 'Dạng vật tư',
            'type' => 'group',
            'other_data' => ['group_class' => '__module_select_type_warehouse'],
            'child' => [
                [
                    'name' => 'supply['.$index.'][supp_type]',
                    'attr' => '{"required":1,"inject_class":"__wh_select_type"}',
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
                    'name' => 'supply['.$index.'][size_type]',
                    'attr' => '{"required":1,"disable_field":1,"inject_class":"__wh_select_size"}',
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
        if (\GroupUser::isPlanHandle()) {
            return [
                $field_supp_type,
                WarehouseHistory::FIELD_QTY
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
                        'with' => ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                        ['con'=> 'or', 'key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                    ],
                'update' => 
                    [
                        'with' => 
                            [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                ['con'=> 'or', 'key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                            ]
                    ],
                'clone' => 1
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 
}
