<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    class Order extends Model
    {
        protected $table = 'orders';
        protected $protectFields = false;
        // Insert sourc new or clone
        const NEW_SRC = 1;
        const CLONE_SRC = 2;

        // Role
        const ARR_ROLE =  [
            \GroupUser::SALE => [
                'view' => [
                    'view_own' => 1,
                    'view_with' => [
                        ['source' => self::NEW_SRC]
                    ]
                ],
                'insert' => 1,
                'update' => [
                    'update_with' => [
                        [
                            [
                                ['status' => \StatusConst::NOT_ACCEPTED]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
    
?>