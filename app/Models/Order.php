<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    class Order extends Model
    {
        protected $table = 'orders';
        protected $protectFields = false;

        //Status
        const NOT_ACCEPTED = \StatusConst::NOT_ACCEPTED;
        const TO_DESIGN = 'to_design';
        const DESIGNING = 'designing';
        const DESIGN_SUBMITED = 'design_submited';
        const TECH_SUBMITED = 'tech_submited';
        const MAKING_PROCESS = 'making_process';

        // Insert sourc new or clone
        const NEW_SRC = 1;
        const CLONE_SRC = 2;

        // Role
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
                                'type' => 'group',
                                'query' => [
                                    ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                    ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                                ]
                            ]
                        ]
                ],
                \GroupUser::TECH_APPLY => [
                    'view' => 
                        [
                            'with' => ['key' => 'status', 'value' => self::NOT_ACCEPTED],
                        ],
                    'update' => 
                        [
                            'with' => [['key' => 'status', 'value' => self::NOT_ACCEPTED]]
                        ]
                ],
                \GroupUser::TECH_HANDLE => [
                    'view' => 
                        [
                            'with' => ['key' => 'status', 'value' => self::DESIGN_SUBMITED],
                        ],
                    'update' => 
                        [
                            'with' => [['key' => 'status', 'value' => self::DESIGN_SUBMITED]]
                        ]
                ],
                \GroupUser::PLAN_HANDLE => [
                    'view' => 
                        [
                            'with' => ['key' => 'status', 'value' => self::TECH_SUBMITED],
                        ]
                ],
            ];
            return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
        }

        // public function beforeRemove($id, $obj)
        // {
        //     if (!empty($obj->quote)) {
        //         $quote_obj = Quote::find($obj->quote);
        //         if (!empty($quote_obj)) {
        //             $quote_obj->status = \StatusConst::ACCEPTED;
        //             $quote_obj->save();
        //             $products = Product::where(['order' => $id])->get();
        //             if (!$products->isEmpty()) {
        //                 foreach ($products as $product) {
        //                     Product::where('id', $product->id)->update(['code' => '', 'order' => '', 'status' => '', 'order_created' => 0]); 
        //                     Product::removeCommand($product->id);
        //                 }
        //             }    
        //         }
        //     }else{
        //         Product::removeData(['order' => $id]);
        //     }
        // }
    }
    
?>