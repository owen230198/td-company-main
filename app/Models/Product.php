<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\Order;
    class Product extends Model
    {
        protected $table = 'products';
        protected $protectFields = false;
        static $childTable = ['papers', 'supplies', 'fill_finishes'];
        const NO_REWORK = 'no_rework';
        const NEED_REWORK = 'need_rework';
        const REWORKED = 'reworked';
        const WAITING_WAREHOUSE = 'waiting_warehouse';
        const CLONE_FIELD = ['name', 'category', 'qty', 'design', 'length', 'width', 'height', 'total_amount', 'act'];
        const FIELD_WAREHOUSE = ['name', 'category', 'product_style', 'length', 'width', 'height'];

        const SALE_SHAPE_FILE_FIELD = [
            'note' => 'Khuôn kinh doanh tính giá',
            'type' => 'filev2',
            'other_data' => ['role_update' => [\GroupUser::SALE], 'field_name' => 'sale_shape_file'],
            'table_map' => 'products',
        ];

        const FEILD_FILE = [
            'custom_design_file' =>
            [
                'note' => 'File thiết kế khách gửi',
                'type' => 'filev2',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::SALE], 'field_name' => 'custom_design_file'] 
            ],
            'tech_shape_file' =>
            [
                'note' => 'Khuôn sản xuất (Kỹ thuật)',
                'type' => 'filev2',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::TECH_APPLY], 'field_name' => 'tech_shape_file']
            ],
            'design_file' =>
            [
                'note' => 'File gốc (P. Thiết kế)',
                'type' => 'filev2',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::DESIGN], 'field_name' => 'design_file']
            ],
            'design_shape_file' =>
            [
                'note' => 'File bình theo khuôn (P. Thiết kế)',
                'type' => 'filev2',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::DESIGN], 'field_name' => 'design_shape_file']
            ],
            'handle_shape_file' =>
            [
                'note' => 'Khuôn ép nhũ, thúc nổi, in UV',
                'type' => 'filev2',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::TECH_HANDLE], 'field_name' => 'handle_shape_file']
            ]
        ];
        
        static function getFeildFileByStage($stage, $data)
        {
            $arr_fields = self::FEILD_FILE;
            if ((\GroupUser::isSale() && @$stage == Order::NOT_ACCEPTED) || empty($stage)) {
                return @$data['design'] == 5 ? [
                    'custom_design_file' => $arr_fields['custom_design_file']
                ] : [];   
            }elseif (@$stage == Order::NOT_ACCEPTED) {
                return [
                    'tech_shape_file' => $arr_fields['tech_shape_file'],
                ];   
            }elseif (in_array(@$stage, [Order::TO_DESIGN, Order::DESIGNING, Order::DESIGN_SUBMITED]) && \GroupUser::isDesign()) {
                $ret = [];
                if (@$data['design'] == 5) {
                    $ret['custom_design_file'] = $arr_fields['custom_design_file'];
                } 
                $ret['tech_shape_file'] = $arr_fields['tech_shape_file'];
                $ret['design_file'] = $arr_fields['design_file'];
                $ret['design_shape_file'] = $arr_fields['design_shape_file'];
                return $ret;   
            }elseif(@$stage == Order::DESIGN_SUBMITED){
                return [
                    'tech_shape_file' => $arr_fields['tech_shape_file'],
                    'design_shape_file' => $arr_fields['design_shape_file'],
                    'handle_shape_file' => $arr_fields['handle_shape_file']
                ]; 
            };
            return $arr_fields;
        }

        static function removeData($where)
        {
            $products = Product::where($where)->get();
            if (!$products->isEmpty()) {
                $admin = new \App\Services\AdminService;
                foreach ($products as $product) {
                    $admin->removeDataTable('products', $product['id']);       
                }
            }
        }

        static function removeCommand($product_id)
        {
            WSalary::where('status', '!=', \StatusConst::SUBMITED)->where('product', $product_id)->delete();
            CDesign::where('status', '!=', \StatusConst::SUBMITED)->where('product', $product_id)->delete();
            CSupply::where('status', '!=', \StatusConst::SUBMITED)->where('product', $product_id)->delete();
        }

        public function afterRemove($id)
        {
            $childs = self::$childTable;
            $admin = new \App\Services\AdminService;
            foreach ($childs as $table) {
                $list = \DB::table($table)->where('product', $id)->get();
                foreach ($list as $obj) {
                    $admin->removeDataTable($table, $obj->id);
                }
            }
            self::removeCommand($id);
        }
        
        static function getRole()
        {
            $role = [
                \GroupUser::SALE => [
                    'insert' => 1,
                    'view' => 1,
                    'clone' => 1
                ],
                \GroupUser::TECH_APPLY => [
                    'view' => 
                        [
                            'with' => [
                                'type' => 'group',
                                'query' => [
                                    ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED],
                                    ['con' => 'or', 'key' => 'order_created', 'value' => 1]
                                ]
                            ],
                        ],
                    'update' => 
                        [
                            'with' => [['key' => 'status', 'value' => Order::NOT_ACCEPTED]]
                        ]
                ],
                \GroupUser::TECH_HANDLE => [
                    'view' => 
                        [
                            'with' => ['key' => 'status', 'value' => Order::DESIGN_SUBMITED],
                        ],
                    'update' => 
                        [
                            'with' => [['key' => 'status', 'value' => Order::DESIGN_SUBMITED]]
                        ]
                ],
                \GroupUser::PLAN_HANDLE => [
                    'view' => 
                        [
                            'with' => ['key' => 'status', 'value' => Order::TECH_SUBMITED],
                        ]
                ],
                \GroupUser::KCS => [
                    'view' => 
                        [
                            'with' => [
                                'type' => 'group',
                                'query' => [
                                    ['key' => 'status', 'value' => \StatusConst::SUBMITED],
                                    ['con' => 'or', 'key' => 'status', 'value' => self::NEED_REWORK]
                                ]
                            ],
                        ]
                ],
                \GroupUser::PRODUCT_WAREHOUSE => [
                    'view' => 
                        [
                            'with' => [
                                'type' => 'group',
                                'query' => [
                                    ['key' => 'status', 'value' => \StatusConst::LAST_SUBMITED],
                                ]
                            ],
                        ]
                ],
            ];
            return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
        }
        
        static function handleDataSupply($process, $product)
        {
            $elements = \TDConst::HARD_ELEMENT;
            foreach ($elements as $el) {
                if (!empty($product[$el['pro_field']])) {
                    $model = getModelByTable($el['table']);
                    $process = $model->processData($process, $product, $el['pro_field']);
                }
            }
            return !empty($process);
        }
        
        static function checkStatusUpdate($id, $status)
        {
            $bool = true;
            foreach (self::$childTable as $table) {
                $data_command = \DB::table($table)->where('product', $id)->get('status');
                foreach ($data_command as $command) {
                    if (@$command->status != $status) {
                        $bool = false;
                        break;
                    }
                }
            }
            if ($bool) {
                $update = Product::where('id', $id)->update(['status' => $status]);
                if ($update) {
                    $data_product = Product::find($id);
                    if (checkUpdateOrderStatus($data_product->order, $status)) {
                        Order::where('id', $data_product->order)->update(['status' => $status]);
                    }
                }
            }
            return true;    
        }
    }

?>