<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SupplyBuying extends Model
{
    protected $table = 'supply_buyings';
    protected $protectFields = false;
    const BOUGHT = 'bought';
    const FOR_ORDER = 1;
    const FOR_INVENTORY = 2;
    const FOR_ALL = 3;

    static function checkReadOnlyInputPrice($status)
    {
        return \GroupUser::isAdmin() ? 0 : (\GroupUser::isDoBuying() && ($status == \StatusConst::PROCESSING || $status == \StatusConst::NOT_ACCEPTED) ? 0 : 1);
    }

    static function hasSizeSupply($type)
    {
        return !in_array($type, [\TDConst::UV, \TDConst::MAGNET, \TDConst::OTHER_SUPPLY]);
    }

    static function hasOverSupplyWarehouse($type){
        return in_array($type, [\TDConst::PAPER, \TDConst::CARTON]);
    }

    static function isHankSupply($type)
    {
        return in_array($type, [\TDConst::NILON, \TDConst::METALAI, \TDConst::COVER, \TDConst::DECAL, \TDConst::SILK]);
    }

    static function isPlateSupply($type){
        return in_array($type, [\TDConst::PAPER, \TDConst::CARTON, \TDConst::RUBBER, \TDConst::STYRO, \TDConst::MICA]);
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

    public function afterRemove($id)
    {
        BuyingItem::where('parent', $id)->delete();    
    }

    static function checkUpdateStatus($id, $status)
    {
        if (BuyingItem::where(['parent' => $id, 'status' => $status])->count() == BuyingItem::where('parent', $id)->count()) {
            SupplyBuying::where('id', $id)->update(['status' => $status]);
        }
    }

    static function getInsertCode($id) {
        SupplyBuying::where('id', $id)->update(['code' => 'MVT-'.formatCodeInsert($id)]);  
    }

    static function insertBuyExistData($supp_id, $qty, $name)
    {
        $supply = SupplyWarehouse::find($supp_id);
        if (!empty($supply)) {
            $type = $supply->type;
            $data['name'] = $name;
            $data['type'] = $type;
            $data['status'] = \StatusConst::PROCESSING;
            $buying_item['type'] = $type;
                if (self::isHankSupply($type)) {
                    $data_qty = ceil($qty / $supply->length);
                    $buying_item['qty'] = $data_qty;
                    $lenth_qty = $data_qty * $supply->length / 100;   
                    $buying_item['weight'] = $supply->weight / $supply->lenth_qty * $lenth_qty;
                    $buying_item['lenth_qty'] = $lenth_qty;
                }
            (new \BaseService())->configBaseDataAction($data);
            $insert_id = BuyingItem::insertGetId($data);
            if ($insert_id) {
                
            }
        }
    }
}
