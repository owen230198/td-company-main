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

        const FEILD_FILE = [
            'custom_design_file' =>
            [
                'note' => 'File thiết kế khách gửi',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::SALE]] 
            ],
            'sale_shape_file' =>
            [
                'note' => 'Khuôn kinh doanh tính giá',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::SALE]] 
            ],
            'tech_shape_file' =>
            [
                'note' => 'Khuôn sản xuất (Kỹ thuật)',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::TECH_APPLY]]
            ],
            'design_file' =>
            [
                'note' => 'File gốc (P. Thiết kế)',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::DESIGN]]
            ],
            'design_shape_file' =>
            [
                'note' => 'File bình theo khuôn (P. Thiết kế)',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::DESIGN]]
            ],
            'handle_shape_file' =>
            [
                'note' => 'Khuôn ép nhũ, thúc nổi, in UV',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::TECH_HANDLE]]
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
                    'sale_shape_file' => $ext_pro_feild_file['sale_shape_file'],
                    'tech_shape_file' => $ext_pro_feild_file['tech_shape_file'],
                ];   
            }elseif (@$stage == Order::TO_DESIGN || @$stage == Order::DESIGNING || @$stage == Order::DESIGN_SUBMITED) {
                unset(
                    $ext_pro_feild_file['sale_shape_file'], 
                    $ext_pro_feild_file['handle_shape_file']
                );
                if (@$data['design'] != 5) {
                    unset($ext_pro_feild_file['custom_design_file']);
                }    
            }elseif(@$stage == Order::DESIGN_SUBMITED){
                return [
                    'design_shape_file' => $ext_pro_feild_file['design_shape_file'],
                    'handle_shape_file' => $ext_pro_feild_file['handle_shape_file']
                ]; 
            };
            return $ext_pro_feild_file;
        }

        public function afterRemove($id)
        {
            $childs = self::$childTable;
            foreach ($childs as $table) {
                \DB::table($table)->where('product', $id)->delete();
            }
        }
        
        static function getRole()
        {
            $role = [
                \GroupUser::SALE => [
                    'insert' => 1,
                    'view' => 
                        [
                            'with' => [
                                'type' => 'group',
                                'query' => [
                                    ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                    ['key' => 'status', 'value' => Order::NOT_ACCEPTED]
                                ]
                            ],
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
        
    }

?>