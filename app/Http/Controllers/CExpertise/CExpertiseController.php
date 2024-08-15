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
            if (\GroupUser::isAdmin() || \GroupUser::isProductWarehouse()) {
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
                $info_fields = [
                    [
                        'name' => 'name',
                        'attr' => ['inject_class' => 'length_input', 'required' => 1],
                        'note' => 'Tên sản phẩm',
                        'value' => $product_obj->name
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
                        'type' => 'linking',
                        'other_data' => ['data' => ['table' => 'product_categories']],
                        'value' => $product_obj->category
                    ],
                    [
                        'name' => 'style',
                        'type' => 'linking',
                        'note' => 'Kiểu dáng',
                        'other_data' => ['data' => ['table' => 'product_styles']],
                        'value' => $product_obj->product_style
                    ],
                    [
                        'name' => '',
                        'attr' => ['disable_field' => 1],
                        'note' => 'Kích thước',
                        'other_data' => ['data' => ['table' => 'product_styles']],
                        'value' => $size,
                    ],
                    [
                        'name' => 'price',
                        'note' => 'Đơn giá',
                        'value' => $product_obj->total_amount/$product_obj->qty,
                        'attr' => ['required' => 1]
                    ],
                    [
                        'name' => 'made_by',
                        'note' => 'Đơn vị sản xuất',
                        'type' => 'linking',
                        'value' => 1,
                        'other_data' => ['data' => ['table' => 'partners']],
                        'attr' => ['required' => 1]
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
                    if (empty($log['receipt'])) {
                        return returnMessageAjax(100, 'Bạn cần upload phiếu nhập kho !');
                    }
                    $qty = (int) $data_expertise->qty;
                    if ($log['action'] == 'insert') {
                        if (empty($warehouse['unit'])) {
                            return returnMessageAjax(100, 'Bạn cần chọn đơn vị cho sản phẩm '.$warehouse['name'].' !');
                        }
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
                        $obj->qty = $obj_qty + $qty;
                        $process = $obj->save();
                    }

                    if (!empty($process)) {
                        $status = \StatusConst::IMPORTED;
                        $product_obj->status = $status;
                        $product_obj->save();
                        if (checkUpdateOrderStatus($product_obj->order, $status)) {
                            Order::where('id', $product_obj->order)->update(['status' => $status]);
                        }
                        //update expertise
                        $data_expertise->status = \StatusConst::ACCEPTED;
                        $data_expertise->save();

                        //log 
                        $arr_log = ['receipt' => $log['receipt'], 'note' => $log['note']];
                        ProductHistory::doLogWarehouse($warehouse_id, $qty, 0, 0, $product_id, $arr_log);
                        return returnMessageAjax(200, 'Đã nhập kho '.$qty.' sản phẩm'.$product_obj->name, \StatusConst::CLOSE_POPUP);
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
                        'other_data' => ['role_update' => [\GroupUser::PRODUCT_WAREHOUSE]] 
                    ];
                    $data['field_chose_type'] = [
                        'name' => 'log[action]',
                        'note' => 'Phương thức thập kho',
                        'type' => 'select',
                        'attr' => ['inject_class' => '__select_import_product_warehouse_method'],
                        'other_data' => ['data' => 
                            ['options' => ['' => 'Chọn phương thức', 'insert' => 'Thêm mới sản phẩm', 'update' => 'Cập nhật thêm số lượng']]
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