<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
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
                    'with' => ['key' => 'created_by', 'value' => \User::getCurrent('id')],
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
