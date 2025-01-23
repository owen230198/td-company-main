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

    static function getTheCheapestProvider($supply_price)
    {
        return ProviderPrice::where(['supp_price' => $supply_price])->orderBy('price', 'asc')->first();
    }

    static function handleTotalBuyingSupply(&$data, $is_buying = true)
    {
        $supp_price_id = $data['qtv'];
        $provider_price = self::getTheCheapestProvider($supp_price_id);
        if (!empty($provider_price)) {
            $price_purchase = getFieldDataById('price_purchase', 'supply_prices', $supp_price_id) ?? 1;
            $length = !empty($data['length']) ? $data['length'] : 1;
            $width = !empty($data['width']) ? $data['width'] : 1;
            $price = $provider_price->price;
            if ($is_buying) {
                $data['sugg_provider'] = $provider_price->id;
                $data['sugg_price'] = $price;
                $data['provider'] = $provider_price->id;
                $data['price'] = $price;
            }
            $data_qty = $data['qty'];
            $data['lenth_qty'] = $length * $data_qty;
            $total = $length * $width * $price * $price_purchase * $data_qty;
            if ($is_buying) {
                $data['total'] = $total;
            }
            $data['weight'] = $total / ($price * 10000000);
        }
    }

    static function insertBuyExistData($supp_id, $qty, $name)
    {
        $supply = SupplyWarehouse::find($supp_id);
        if (!empty($supply)) {
            $type = $supply->type;
            $data['name'] = $name;
            $data['type'] = $type;
            $data['status'] = \StatusConst::PROCESSING;
            (new \BaseService())->configBaseDataAction($data);
            $insert_id = SupplyBuying::insertGetId($data);
            $length = $supply->length;
            $width = $supply->width;
            if ($insert_id) {
                $buying_item = [
                    'type' => $type,
                    'target' => $supply->target,
                    'qtv' => $supply->qtv,
                    'length' => $length,
                    'width' => $width
                ];
                $buying_item['qty'] = self::isHankSupply($type) ? ceil($qty / $length) : $qty;
                self::handleTotalBuyingSupply($buying_item);
                BuyingItem::processData($buying_item, $insert_id);   
            }
        }
    }
}
