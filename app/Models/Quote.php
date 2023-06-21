<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quotes';
    protected $protectFields = false;
    static $tableChild = array('q_papers', 'q_cartons', 'q_foams', 'q_silks', 'q_finishes');
    static function getRole()
    {
        $role = [
            \GroupUser::SALE => [
                'view' => 
                [
                    'with' => [
                        'type' => 'group',
                        'cond' => 'or',
                        'query' => 
                        [
                            [
                                ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                            ],
                            [
                                ['key' => 'status', 'value' => \StatusConst::SUBMITED],
                                ['key' => 'assign_by', 'value' => \User::getCurrent()]
                            ],
                            [
                                ['key' => 'status', 'value' => Order::DESIGNING],
                                ['key' => 'assign_by', 'value' => \User::getCurrent()]
                            ]
                        ]
                    ]
                ],
                'update' => [
                    'view_with' => 
                    [
                        ['key' => 'status', 'value' => Order::DESIGNING],
                        ['key' => 'assign_by', 'value' => \User::getCurrent()]
                    ]
                ]
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 
}
