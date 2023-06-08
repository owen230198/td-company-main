<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    class Order extends Model
    {
        protected $table = 'orders';
        protected $protectFields = false;
        const ARR_ROLE =  [
            \GroupUser::SALE => [
                'view' => [
                    'view_own' => 1
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