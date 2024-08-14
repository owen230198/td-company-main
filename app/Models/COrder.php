<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class COrder extends Model
{
    protected $table = 'c_orders';
    protected $protectFields = false;
    protected $guarded = [];

    static function getRole()
    {
        $role = [
            \GroupUser::SALE => [
                'insert' => 1,
                'view' => ['with' => ['key' => 'created_by', 'value' => \User::getCurrent('id')]],
                'update' => 
                [
                    'with' => [[
                        'type' => 'group',
                        'query' => [
                            ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                            ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                        ]
                    ]]
                ],
                'clone' => 1
            ],
            \GroupUser::PRODUCT_WAREHOUSE => [
                'view' => [
                    'with' => [
                        'type' => 'group',
                        'query' =>[
                            ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED],
                            ['con' => 'or', 'key' => 'confirm_by', 'value' => \StatusConst::NOT_ACCEPTED]
                        ],
                    ],
                ],
            ],
            \GroupUser::ACCOUNTING => [
                'view' => 1,
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
}
