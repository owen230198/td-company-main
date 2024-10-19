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
    protected $guarded = [];
    const ORDER_CREATED = 'order_created';
    static $tableChild = ['q_papers', 'q_cartons', 'q_foams', 'q_silks', 'q_finishes'];
    const HIDDEN_CLONE_FIELD = \StatusConst::HIDDEN_CLONE_FIELD;
    static function getRole()
    {
        $role = [
            \GroupUser::SALE => [
                'insert' => 1,
                'view' => 
                    [
                        'with' => ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                    ],
                'update' => 
                    [
                        'with' => [
                            [
                                'type' => 'group',
                                'con' => 'or',
                                'query' => [
                                    ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                    ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                                ]
                            ],
                            [
                                'type' => 'group',
                                'con' => 'or',
                                'query' => [
                                    ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                    ['key' => 'status', 'value' => \StatusConst::ACCEPTED]
                                ]
                            ],
                        ]
                    ],
                'clone' => 1
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    public function beforeRemove($id, $obj)
    {
        if (in_array(@$obj->status, [\StatusConst::NOT_ACCEPTED, \StatusConst::ACCEPTED])) {
            Product::removeData(['quote_id' => $id]);
        }
    } 
}
