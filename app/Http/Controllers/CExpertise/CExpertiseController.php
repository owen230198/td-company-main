<?php
    namespace App\Http\Controllers\CExpertise;
    use App\Http\Controllers\Controller;
    use App\Models\CExpertise;
    use App\Models\Order;
    use App\Models\Product;
    use App\Models\ProductHistory;
    use App\Models\ProductWarehouse;
    use Illuminate\Http\Request;
    class CExpertiseController extends Controller
    {
        function __construct()
        {
            parent::__construct();      
        }

        public function update($request, $id)
        {
            $table = 'c_expertises';
            $param = $request->all();
            $dataItem = getModelByTable($table)->find($id);
            if (!$request->isMethod('POST')) {
                $data = $this->admins->getDataActionView($table, 'update', 'Nhập kho thành phẩm', $param);
                $data['title'] = 'Nhập kho thành phẩm: '.@$dataItem['name'];
                $data['action_url'] = url('update/'.$table.'/'.$id);
                $data['field_logs'] = [];
                $data['dataItem'] = $dataItem;
                return view('warehouses.actions.view', $data);   
            }else{
                
                
            }
        }
        public function confirmProductWarehouse(Request $request, $id)
        {
            $is_post = $request->isMethod('POST');
            if (\GroupUser::isAdmin() || \GroupUser::isProductWarehouse() || \GroupUser::isAccounting()) {
                $data_expertise = CExpertise::find($id);
                if (@$data_expertise->status != \StatusConst::NOT_ACCEPTED) {
                    return customReturnMessage(false, $is_post, ['message' => 'Dữ liệu không hợp lệ !']);
                }
                $product_id = @$data_expertise->product;
                $product_obj = Product::find($product_id);
                if (empty($product_obj)) {
                    return customReturnMessage(false, $is_post, ['message' => 'Sản phẩm không tồn tại hoặc đã bị xóa !']);
                }
                $size = '';
                if (!empty($product_obj->length) && !empty($product_obj->height)) {
                    $size = $product_obj->length. ' x ' .$product_obj->height;
                }
                if (!empty($product_obj->length) && !empty($product_obj->width) && !empty($product_obj->height)) {
                    $size = $product_obj->length.' x '.$product_obj->width.' x ' . $product_obj->height;
                }
                $price = (int) $product_obj->total_amount/$product_obj->qty;
                $info_fields = [
                    [
                        'name' => 'name',
                        'attr' => ['inject_class' => 'length_input', 'required' => 1, 'readonly' => 1],
                        'note' => 'Tên sản phẩm',
                        'value' => $product_obj->name
                    ],
                    [
                        'name' => 'type',
                        'note' => 'Loại hàng',
                        'type' => 'select',
                        'attr' => ['readonly' => 1],
                        'other_data' => [
                            'data' => ['options' => \TDConst::TYPE_PRODUCT_OPTIONS]
                        ],
                        'value' => $product_obj->type
                    ],
                    [
                        'name' => 'qty',
                        'note' => 'Số lượng nhập kho',
                        'value' => $data_expertise->qty,
                        'attr' => ['required' => 1]
                    ],
                    [
                        'name' => 'category',
                        'note' => 'Nhóm sản phẩm',
                        'attr' => ['readonly' => 1],
                        'type' => 'linking',
                        'other_data' => ['data' => ['table' => 'product_categories']],
                        'value' => $product_obj->category
                    ],
                    [
                        'name' => 'style',
                        'type' => 'linking',
                        'attr' => ['readonly' => 1],
                        'note' => 'Kiểu dáng',
                        'other_data' => ['data' => ['table' => 'product_styles']],
                        'value' => $product_obj->product_style
                    ],
                    [
                        'name' => '',
                        'attr' => ['disable_field' => 1, 'readonly' => 1],
                        'note' => 'Kích thước',
                        'other_data' => ['data' => ['table' => 'product_styles']],
                        'value' => $size,
                    ],
                    [
                        'name' => 'price',
                        'note' => 'Đơn giá',
                        'value' => $price,
                        'attr' => ['required' => 1, 'readonly' => 1]
                    ],
                    [
                        'name' => 'made_by',
                        'note' => 'Đơn vị sản xuất',
                        'type' => 'linking',
                        'value' => 1,
                        'other_data' => ['data' => ['table' => 'partners']],
                        'attr' => ['required' => 1, 'readonly' => 1]
                    ],
                    [
                        'name' => 'warehouse_type',
                        'attr' => ['required' => 1, 'inject_class' => '__expertise_select_warehouse_type'],
                        'note' => 'Chọn kho',
                        'type' => 'linking',
                        'other_data' => [
                            'config' => ['search' => 1],
                            'data' => [
                                'table' => 'supply_extends', 
                                'where' => ['type' => 'warehouse_type']
                                ]
                            ],
                    ]
                ];
                if ($is_post) {
                    $data = $request->except('_token');
                    $warehouse = !empty($data['warehouse']) ? $data['warehouse'] : [];
                    $log = !empty($data['log']) ? $data['log'] : [];
                    foreach ($info_fields as $field) {
                        $name = $field['name'];
                        if (!empty($field['attr']['required']) && empty($warehouse[$name])) {
                            return returnMessageAjax(100, 'Dữ liệu '.strtolower($field['note']).' không được để trống !');
                        }
                    }
                    if (empty($log['action'])) {
                        return returnMessageAjax(100, 'Bạn cần chọn phương thức nhập kho !');
                    }
                    $qty = (int) $data_expertise->qty;
                    $ex_qty = (int) $warehouse['qty'];
                    if ($ex_qty > $qty) {
                        return returnMessageAjax(100, 'Lệnh chỉ yêu cầu nhập kho '.$qty.' thành phẩm !');  
                    }
                    $produce_price = (int) $product_obj->total_cost/$product_obj->qty;
                    if ($log['action'] == 'insert') {
                        if (empty($warehouse['unit'])) {
                            return returnMessageAjax(100, 'Bạn cần chọn đơn vị cho sản phẩm '.$warehouse['name'].' !');
                        }
                        $warehouse['produce_price'] = $produce_price;
                        $warehouse['length'] = $product_obj->length;
                        $warehouse['width'] = $product_obj->width;
                        $warehouse['height'] = $product_obj->height;
                        $data_insert = $warehouse;
                        (new \BaseService)->configBaseDataAction($data_insert);
                        $warehouse_id = ProductWarehouse::insertGetId($data_insert);
                        if ($warehouse_id) {
                            $process = ProductWarehouse::where('id', $warehouse_id)->update(['code' => 'SP-'.formatCodeInsert($warehouse_id)]);
                        }
                    }else{
                        if (empty($data['data']['target'])) {
                            return returnMessageAjax(100, 'Bạn cần chọn sản phẩm nhập thêm số lượng !');
                        }
                        $warehouse_id = $data['data']['target'];
                        $obj = ProductWarehouse::find($warehouse_id);
                        if (empty($obj)) {
                            return returnMessageAjax(100, 'Sản phẩm nhập thêm không tồn tại hoặc đã bị xóa !');
                        }
                        $obj_qty = (int) $obj->qty;
                        $obj->price = $price;
                        $obj->produce_price = $produce_price;
                        $obj->qty = $obj_qty + $ex_qty;
                        $process = $obj->save();
                    }

                    if (!empty($process)) {
                        $status = \StatusConst::IMPORTED;
                        $product_obj->status = $status;
                        $product_obj->product_warehouse = $warehouse_id;
                        $product_obj->save();
                        if (checkUpdateOrderStatus($product_obj->order, $status)) {
                            Order::where('id', $product_obj->order)->update(['status' => $status]);
                        }
                        //update expertise
                        $data_expertise->status = \StatusConst::ACCEPTED;
                        $data_expertise->save();

                        //log 
                        $arr_log = ['receipt' => $log['receipt'], 'note' => $log['note']];
                        ProductHistory::doLogWarehouse($warehouse_id, $ex_qty, 0, 0, $product_id, $arr_log);
                        if ($ex_qty < $qty) {
                            $re_insert = $data_expertise->toArray();
                            $re_insert['name'] = $data_expertise->name;
                            $re_insert['qty'] = $qty - $ex_qty;
                            $re_insert['status'] = \StatusConst::NOT_ACCEPTED;
                            unset($re_insert['id']);
                            (new \BaseService)->configBaseDataAction($re_insert);
                            $reInsertId = CExpertise::insertGetId($re_insert);
                            CExpertise::where('id', $reInsertId)->update(['code' => 'NK-'.formatCodeInsert($reInsertId)]);
                            logActionUserData('insert', 'c_expertises', $reInsertId);
                        }
                        return returnMessageAjax(200, 'Đã nhập kho '.$ex_qty.' sản phẩm'.$product_obj->name, \StatusConst::CLOSE_POPUP);
                    }else{
                        return returnMessageAjax(100, 'Đã có lỗi xảy ra, vui lòng thử lại !');
                    }
                }else{
                    $data['title'] = 'Nhập kho thành phẩm '.$product_obj->name;
                    $data['data_product'] = $product_obj;
                    $data['data_expertise'] = $data_expertise;
                    $data['info_fields'] = $info_fields;
                    $data['receipt_field'] = [
                        'name' => 'log[receipt]',
                        'note' => 'Phiếu nhập kho',
                        'type' => 'filev2',
                        'table_map' => 'warehouse_histories',
                        'other_data' => ['role_update' => [\GroupUser::PRODUCT_WAREHOUSE, \GroupUser::ACCOUNTING]] 
                    ];
                    $data['field_chose_type'] = [
                        'name' => 'log[action]',
                        'note' => 'Phương thức thập kho',
                        'type' => 'select',
                        'attr' => ['inject_class' => '__select_import_product_warehouse_method'],
                        'other_data' => ['data' => 
                            ['options' => ['' => 'Chọn phương thức', 'insert' => 'Sản phẩm mới', 'update' => 'Sản phẩm cùng thông số - bán sẵn']]
                        ]
                    ];
                    $data['field_note'] = [
                        'name' => 'log[note]',
                        'note' => 'Ghi chú',
                        'type' => 'textarea'
                    ];
                    $data['nosidebar'] = true;
                    return view('product_warehouses.view', $data);
                }
            }else{
                return customReturnMessage(false, $is_post, ['message' => 'Bạn không có quyền thực hiện thao tác này !']);
            }    
        }

        public function productWarehouseHistory($product_id)
        {
            $pro_warehouse = ProductWarehouse::find($product_id);
            if (empty($pro_warehouse)) {
                return false;
            }
            $data['title'] = 'Lịch sử xuất nhập sản phẩm '.$pro_warehouse->name;
            $data['nosidebar'] = true;
            $data['list_data'] = \DB::table('product_histories')->where('product', $product_id)->get();
            return view('products.history', $data); 
        }
    }
?>