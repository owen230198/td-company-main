<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\Order;
    class CDesign extends Model
    {
        protected $table = 'c_designs';
        protected $protectFields = false;
        const PROCESSING = Order::DESIGNING;
        const GR_USER = \GroupUser::DESIGN;
        public function getRole()
        {
            $role = [
                \GroupUser::DESIGN => [
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
    
?>