<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\Order;
    class CDesign extends Model
    {
        protected $table = 'c_designs';
        protected $protectFields = false;
        protected $guarded = [];
        const PROCESSING = Order::DESIGNING;
        const GR_USER = \GroupUser::DESIGN;
        static function getRole()
        {
            $role = [
                \GroupUser::DESIGN => [
                    'view' => 
                    [
                        'with' => [
                            'type' => 'group',
                            'query' => 
                            [
                                [
                                    'type' => 'group',
                                    'query' =>[
                                        ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                                    ]
                                ],
                                [
                                    'type' => 'group',
                                    'con' => 'or',
                                    'query' => [
                                        ['key' => 'status', 'value' => Order::DESIGN_SUBMITED],
                                        ['key' => 'assign_by', 'value' => \User::getCurrent('id')]
                                    ]
                                ],
                                [
                                    'type' => 'group',
                                    'con' => 'or',
                                    'query' => [
                                        ['key' => 'status', 'value' => Order::DESIGNING],
                                        ['key' => 'assign_by', 'value' => \User::getCurrent('id')]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'update' => [
                        'with' => 
                            [
                                ['key' => 'status', 'value' => Order::DESIGNING],
                                ['key' => 'assign_by', 'value' => \User::getCurrent('id')]
                            ]
                    ]
                ],
                \GroupUser::TECH_APPLY => [
                    'view' => 1
                ]
            ];
            return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
        }      
    }
    
?>