<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\Order;
    class Product extends Model
    {
        protected $table = 'products';
        protected $protectFields = false;
        protected $guarded = [];
        static $childTable = ['papers', 'supplies', 'fill_finishes'];
        const NO_REWORK = 'no_rework';
        const NEED_REWORK = 'need_rework';
        const REWORKING = 'reworking';
        const REWORKED = 'reworked';
        const WAITING_WAREHOUSE = 'waiting_warehouse';
        const CLONE_FIELD = ['name', 'category', 'qty', 'design', 'length', 'width', 'height', 'profit', 'ship_price', 'total_amount', 'act'];
        const FIELD_WAREHOUSE = ['name', 'category', 'product_style', 'length', 'width', 'height'];
        const HIDDEN_CLONE_FIELD = ['id', 'product', 'handle_elevate', 'status', 'parent'];

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
                'other_data' => ['role_update' => [\GroupUser::TECH_APPLY, \GroupUser::TECH_HANDLE], 'field_name' => 'tech_shape_file']
            ],
            'design_file' =>
            [
                'note' => 'File gốc (P. Thiết kế)',
                'type' => 'filev2',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::DESIGN, \GroupUser::TECH_APPLY], 'field_name' => 'design_file']
            ],
            'design_shape_file' =>
            [
                'note' => 'File bình theo khuôn (P. Thiết kế)',
                'type' => 'filev2',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::DESIGN, \GroupUser::TECH_APPLY, \GroupUser::TECH_HANDLE], 'field_name' => 'design_shape_file']
            ],
            'handle_shape_file' =>
            [
                'note' => 'Khuôn ép nhũ, thúc nổi, in UV',
                'type' => 'filev2',
                'table_map' => 'products',
                'other_data' => ['role_update' => [\GroupUser::TECH_HANDLE, \GroupUser::TECH_APPLY], 'field_name' => 'handle_shape_file']
            ]
        ];

        static function getAllSupplyWhere($where)
        {
            $ret = [];
            if (!empty($where)) {
                foreach (self::$childTable as $table) {
                    $data = getModelByTable($table)::where($where)->get()->toArray();
                    $ret = array_merge($ret, $data);
                }
            }    
            return $ret;
        }
        
        static function getFeildFileByStage($stage, $data)
        {
            $arr_fields = self::FEILD_FILE;
            if ((\GroupUser::isSale() && (@$stage == Order::NOT_ACCEPTED) || empty($stage))) {
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
                    'design_file' => $arr_fields['design_file'],
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
            $commands = ['w_salaries', 'c_designs', 'c_supplies'];
            self::removeDataChildTable($commands, [['product', '=', $product_id], ['status', '!=', \StatusConst::SUBMITED]]);
        }

        public function afterRemove($id)
        {
            $childs = self::$childTable;
            self::removeDataChildTable($childs, ['product' => $id]);
            self::removeCommand($id);
        }

        static function removeDataChildTable($arr_tables, $where)
        {
            $admin = new \App\Services\AdminService;
            foreach ($arr_tables as $table) {
                $list = \DB::table($table)->where($where)->get();
                foreach ($list as $obj) {
                    $admin->removeDataTable($table, $obj->id);
                }
            }
        }

        static function canViewTechFile()
        {
            return \GroupUser::isAdmin() || \GroupUser::isDesign(); \GroupUser::isTechApply() || \GroupUser::isTechHandle();
        }
        
        static function getRole()
        {
            $role = [
                \GroupUser::SALE => [
                    'insert' => 1,
                    'view' => ['with' => ['key' => 'created_by', 'value' => \User::getCurrent('id')]],
                    'update' => 
                    [
                        'with' => [[
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                            ]
                        ]]
                    ],
                    'clone' => 1,
                    'remove' => 
                    [
                        'with' => [[
                            'type' => 'group',
                            'query' => [
                                ['key' => 'created_by', 'value' => \User::getCurrent('id')],
                                ['key' => 'status', 'value' => null]
                            ]
                        ]]
                    ],
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
                    'update' => \GroupUser::checkExtRoleAction(\User::ROLE_TECH_APPLY) || \GroupUser::checkExtRoleAction(\User::ROLE_TECH_HANDLE) ? 1 : 0,
                ],
                \GroupUser::TECH_HANDLE => [
                    'view' => 
                        [
                            'with' => [
                                'type' => 'group',
                                'query' => [
                                    ['key' => 'status', 'value' => Order::DESIGN_SUBMITED],
                                    ['con' => 'or', 'key' => 'order_created', 'value' => 1]
                                ]
                            ],
                        ],
                    'update' => 
                        [
                            'with' => [['key' => 'status', 'value' => Order::DESIGN_SUBMITED]]
                        ]
                ],
                \GroupUser::PLAN_HANDLE => [
                    'view' => 
                        [
                            'with' => ['key' => 'order_created', 'value' => 1],
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
                    'view' => [
                        'with' => ['key' => 'order_created', 'value' => 1],
                    ]
                ],
                \GroupUser::ACCOUNTING => [
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
                ],
                \GroupUser::PRODUCTION_MANAGER => [
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
                            'with' => [[
                                'type' => 'group',
                                'query' => [
                                    ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED],
                                    ['con' => 'or', 'key' => 'order_created', 'value' => 1]
                                ]
                            ]]
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

        static function handleProductAfter($data, $order)
        {
            foreach ($data as $key => $product) {
                $data_update['code'] =  $order['code'].getCharaterByNum($key);
                if (!empty($order['status'])) {
                    $data_update['status'] = $order['status'];
                }
                $data_update['order'] = $order['id'];
                $data_update['order_created'] = 1;
                Product::where('id', $product['id'])->update($data_update);
                self::handleCommandCode($product, $data_update['code']); 
            }  
        }

        static function handleCommandCode($product, $code)
        {
            $elements = getProductElementData($product['category'], $product['id'], false);
            $count = -1;
            foreach ($elements as $element) {
                if (!empty($element['data'])) {
                    $el_data = $element['data'];
                    foreach ($el_data as $supply) {
                        $table_supply = $element['table'];
                        $data_update['status'] = \StatusConst::NOT_ACCEPTED;
                        $count++;
                        $_code =  $code.getCharaterByNum($count);
                        $data_update['code'] = $_code;
                        getModelByTable($table_supply)->where('id', $supply->id)->update($data_update);
                    }
                }
            }
        }

        static function resetHandledQty($table, $model, $supp_id)
        {
            $handle_arr = getArrHandleField($table);
            $dataItem = $model::find($supp_id);
            foreach ($handle_arr as $stage) {
                if (!empty($dataItem[$stage])) {
                    $item_stage = json_decode($dataItem[$stage], true);
                    $item_stage['handled_qty'] = 0;
                    $item_stage['handled'] = 0;
                    $dataItem->{$stage} = json_encode($item_stage);
                }
            }
            $dataItem->handled = 0;
            $dataItem->save();
        }

        static function handleCloneData($data, $obj_id, $obj_field, $handle_code)
        {
            $hidden_fields = \StatusConst::HIDDEN_CLONE_FIELD;
            $base_service = new \BaseService();
            $child_tables = self::$childTable;
            foreach ($data as $product) {
                $product[$obj_field] = $obj_id;
                $old_product_id = $product['id'];
                unset($product['id']);
                if ($handle_code) {
                    $product['quote_id'] = '';
                    $product['status'] = \StatusConst::NOT_ACCEPTED;
                    $product['order_created'] = 1;
                }else{
                    $product['order'] = '';
                    $product['status'] = ''; 
                    $product['order_created'] = 0;  
                }
                $base_service->configBaseDataAction($product);
                $product_id = Product::insertGetId($product);
                $childs = Product::where('parent', $old_product_id)->get()->makeHidden($hidden_fields)->toArray();
                foreach ($childs as $child) {
                    if ($handle_code) {
                        $child['status'] = \StatusConst::NOT_ACCEPTED;
                    }else{
                        $child['status'] = ''; 
                    }
                    $child['parent'] = $product_id;
                    unset($child['id']);
                    $base_service->configBaseDataAction($child);
                    Product::insertGetId($child);
                }
                //log insert product
                logActionUserData('insert', 'products', $product_id, $product);
                if ($product_id) {
                    foreach ($child_tables as $table_supply) {
                        $model = getModelByTable($table_supply);
                        $data_supplies = $model->where('product', $old_product_id)->get()->makeHidden($hidden_fields)->toArray();
                        foreach ($data_supplies as $supply) {
                            unset($supply['id']);
                            $base_service->configBaseDataAction($supply);
                            $supply['product'] = $product_id;
                            if ($handle_code) {
                                $supply['status'] = \StatusConst::NOT_ACCEPTED;
                            }else{
                                $supply['status'] = ''; 
                            }
                            $supp_id = $model::insertGetId($supply);
                            self::resetHandledQty($table_supply, $model, $supp_id);
                            logActionUserData('insert', $table_supply, $supp_id, $supply);
                        }
                    }
                }
            }
            if ($handle_code) {
                $products = Product::where('order', $obj_id)->get();
                $order = Order::find($obj_id);
                RefreshQuotePrice($order);
                self::handleProductAfter($products, $order);
            }
        }

        static function createCProduct($id)
        {
            $child_tables = self::$childTable;
            $arr_qty = [];
           
            foreach ($child_tables as $table) {
                $where = ['product' => $id];
                if ($table == 'papers') {
                    $where['parent'] = 0;
                }
                $obj = \DB::table($table)->where($where);
                if ($obj->count() > 0) {
                    $arr_qty[] = (int) $obj->min('handled');
                }
            }
            $min_qty = collect($arr_qty)->min();
            if ($min_qty > 0) {
                $qty_created = CProduct::where(['product' => $id])->sum('qty');
                $exist_data = CProduct::where(['product' => $id, 'status' => \StatusConst::PROCESSING])->first();
                $data_qty = $min_qty - $qty_created;
                if ($data_qty > 0) {
                    if (!empty($exist_data)) {
                        $exist_data->qty += $data_qty;
                        $exist_data->save();
                    }else{
                        $data_insert = [
                            'name' => 'KCS Thành phẩm - '.getFieldDataById('name', 'products', $id),
                            'product' => $id,
                            'qty' => $data_qty,
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now(),
                            'act' => 1,
                           'status' => \StatusConst::PROCESSING
                        ];
                        $c_id = CProduct::insertGetId($data_insert);
                        CProduct::getInsertCode($c_id);
                    }
                }
            }
        } 

        static function getAllSupply($id, $select, $check_handle_type = false)
        {
            $papers = Paper::select($select)->where('product', $id);
            if ($check_handle_type) {
                $papers->where('handle_type', \TDConst::MADE_BY_OWN);
            }
            $supplies = Supply::select($select)->where('product', $id);
            $fill_finishes = FillFinish::select($select)->where('product', $id);
            return $papers->union($supplies)->union($fill_finishes)->get();
        }

        static function canUpdateQty($obj)
        {
            if (empty($obj->status)) {
                return true;
            }
            return \GroupUser::isAdmin() || (\GroupUser::isSale() && @$obj->status == \StatusConst::NOT_ACCEPTED);
        }

        static function isJoinProduct($product)
        {
            $paper = Paper::where('product', $product->id)->first();
            return !empty($paper->is_join);
        }
    }

?>