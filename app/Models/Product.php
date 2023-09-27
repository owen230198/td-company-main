<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\Order;
    class Product extends Model
    {
        protected $table = 'products';
        protected $protectFields = false;
        static $childTable = ['papers', 'supplies', 'fill_finishes'];
        const SUPPLY_FIELDS = [
            // [
            //     'name' => 'name',
            //     'note' => 'Tên',
            //     'type' => 'text' 
            // ],
            [
                'name' => 'product_qty',
                'note' => 'Số lượng sp',
                'type' => 'text', 
                
            ],
            [
                'name' => 'supp_qty',
                'note' => 'Số lượng vật tư',
                'type' => 'text', 
                
            ],
            [
                'name' => 'created_by',
                'note' => 'Tạo bởi',
                'type' => 'linking', 
                'other_data' => '{
                    "config":{
                        "search":1
                    },
                    "data":{
                        "table":"n_users"
                    }
                }'
                
            ], 
            [
                'name' => 'created_at',
                'note' => 'Tạo lúc',
                'type' => 'datetime', 
                
            ],
        ];

        const CLONE_FIELD = ['name', 'category', 'qty', 'design', 'length', 'width', 'height', 'total_amount'];

        const SALE_SHAPE_FILE_FIELD = [
            'note' => 'Khuôn kinh doanh tính giá',
            'type' => 'file',
            'other_data' => ['role_update' => [\GroupUser::SALE], 'field_name' => 'sale_shape_file'],
            'table_map' => 'products',
        ];

        const FEILD_FILE = [
            'custom_design_file' =>
            [
                'note' => 'File thiết kế khách gửi',
                'type' => 'file',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::SALE], 'field_name' => 'custom_design_file'] 
            ],
            'tech_shape_file' =>
            [
                'note' => 'Khuôn sản xuất (Kỹ thuật)',
                'type' => 'file',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::TECH_APPLY], 'field_name' => 'tech_shape_file']
            ],
            'design_file' =>
            [
                'note' => 'File gốc (P. Thiết kế)',
                'type' => 'file',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::DESIGN], 'field_name' => 'design_file']
            ],
            'design_shape_file' =>
            [
                'note' => 'File bình theo khuôn (P. Thiết kế)',
                'type' => 'file',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::DESIGN], 'field_name' => 'design_shape_file']
            ],
            'handle_shape_file' =>
            [
                'note' => 'Khuôn ép nhũ, thúc nổi, in UV',
                'type' => 'file',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::TECH_HANDLE], 'field_name' => 'handle_shape_file']
            ]
        ];
        
        static function getFeildFileByStage($stage, $data)
        {
            $ext_pro_feild_file = self::FEILD_FILE;
            if ((\GroupUser::isSale() && @$stage == Order::NOT_ACCEPTED) || empty($stage)) {
                return @$data['design'] == 5 ? [
                    'custom_design_file' => $ext_pro_feild_file['custom_design_file']
                ] : [];   
            }elseif (@$stage == Order::NOT_ACCEPTED) {
                return [
                    'tech_shape_file' => $ext_pro_feild_file['tech_shape_file'],
                ];   
            }elseif ((@$stage == Order::TO_DESIGN 
            || @$stage == Order::DESIGNING 
            || @$stage == Order::DESIGN_SUBMITED)
            && \GroupUser::isDesign()) {
                $ret = [];
                if (@$data['design'] == 5) {
                    $ret['custom_design_file'] = $ext_pro_feild_file['custom_design_file'];
                } 
                $ret['tech_shape_file'] = $ext_pro_feild_file['tech_shape_file'];
                $ret['design_file'] = $ext_pro_feild_file['design_file'];
                $ret['design_shape_file'] = $ext_pro_feild_file['design_shape_file'];
                return $ret;   
            }elseif(@$stage == Order::DESIGN_SUBMITED){
                return [
                    'tech_shape_file' => $ext_pro_feild_file['tech_shape_file'],
                    'design_shape_file' => $ext_pro_feild_file['design_shape_file'],
                    'handle_shape_file' => $ext_pro_feild_file['handle_shape_file']
                ]; 
            };
            return $ext_pro_feild_file;
        }

        static function removeData($where)
        {
            $products = Product::where($where)->get();
            if (!$products->isEmpty()) {
                $admin = new \App\Services\AdminService;
                foreach ($products as $product) {
                    Quote::where('id', $product->quote_id)->delete();
                    Order::where('id', $product->order)->delete();
                    $admin->removeDataTable('products', $product['id']);       
                }
            }
        }

        public function afterRemove($id)
        {
            $childs = self::$childTable;
            foreach ($childs as $table) {
                $list = \DB::table($table)->where('product', $id)->get();
                $admin = (new \App\Services\AdminService);
                foreach ($list as $obj) {
                    $admin->removeDataTable($table, $obj->id);
                }
            }
        }
        
        static function getRole()
        {
            $role = [
                \GroupUser::SALE => [
                    'insert' => 1,
                    'view' => 
                        [
                            'with' => ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                        ],
                    'clone' => 1
                ],
                \GroupUser::TECH_APPLY => [
                    'view' => 
                        [
                            'with' => ['key' => 'status', 'value' => Order::NOT_ACCEPTED],
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