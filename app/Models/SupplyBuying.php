<?php

namespace App\Models;
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

    static function hasSizeSupply($type)
    {
        return !in_array($type, [\TDConst::UV, \TDConst::MAGNET, \TDConst::OTHER_SUPPLY]);
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
}
