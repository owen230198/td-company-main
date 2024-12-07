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

        static function getRoleForGroupDesign($action){
            switch ($action) {
                case 'view':
                    return [
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
                    ];
                    break;
                case 'update':
                    return [
                        'with' => 
                        [
                            ['key' => 'status', 'value' => Order::DESIGNING],
                            ['key' => 'assign_by', 'value' => \User::getCurrent('id')]
                        ]
                    ];
                    break;
                default:
                    return [];
                    break;
            }    
        }
        static function getRole()
        {
            $role = [
                \GroupUser::DESIGN => [
                    'view' =>  self::getRoleForGroupDesign('view'),
                    'update' => self::getRoleForGroupDesign('update'),
                ],
                \GroupUser::TECH_APPLY => [
                    'view' => \GroupUser::checkExtRoleAction(\User::ROLE_TECH_DESIGN) ? self::getRoleForGroupDesign('view') : 0,
                    'update' => \GroupUser::checkExtRoleAction(\User::ROLE_TECH_DESIGN) ? self::getRoleForGroupDesign('update') : 0,
                ]
            ];
            return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
        }      
    }
    
?>