<?php
    namespace App\Http\Controllers\CExpertise;
    use App\Http\Controllers\Controller;
    use App\Models\CExpertise;
    use App\Models\Product;
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
                if ($is_post) {
                    $qty = (int) $data_expertise->qty;
                    $data_insert['code'] = 'SP-'.getCodeInsertTable('product_warehouses');
                    $data_insert['name'] = $product_obj->name;
                    $data_insert['qty'] = $qty;
                    $data_insert['category'] = $product_obj->category;
                    $data_insert['product_style'] = $product_obj->product_style;
                    $data_insert['length'] = $product_obj->length;
                    $data_insert['width'] = $product_obj->width;
                    $data_insert['height'] = $product_obj->height;
                    $data_insert['price'] = (int) $product_obj->total_amount / (int) $product_obj->qty;
                    $data_insert['specification'] = $product_obj->id;
                    $data_insert['expertise_id'] = $id;
                    (new \BaseService)->configBaseDataAction($data_insert);
                    $pro_warehouse_id = ProductWarehouse::insertGetId($data_insert);

                    //update status product
                    $product_obj->status = \StatusConst::LAST_SUBMITED;
                    $product_obj->save();

                    //update expertise
                    $data_expertise->qty = 0;
                    $data_expertise->status = \StatusConst::ACCEPTED;
                    $data_expertise->save();

                    //log 
                    $data_log['action'] = 'import';
                    $data_log['qty'] = $qty;
                    $data_log['old_qty'] = 0;
                    $data_log['new_qty'] = $qty;
                    $data_log['product'] = $pro_warehouse_id;
                    (new \BaseService)->configBaseDataAction($data_log);
                    $log = \DB::table('product_histories')->insert($data_log);
                    if ($log) {
                        return returnMessageAjax(200, 'Đã nhập kho thành phẩm '.$qty.' sản phẩm'.$product_obj->name, \StatusConst::RELOAD);
                    }
                }else{
                    $data['title'] = 'Nhập kho thành phẩm '.$product_obj->name;
                    $data['data_product'] = $product_obj;
                    $data['data_expertise'] = $data_expertise;
                    $data['info_fields'] = [
                        [
                            'name' => 'name',
                            'attr' => ['inject_class' => 'length_input'],
                            'note' => 'Tên sản phẩm',
                            'value' => $product_obj->name
                        ],
                        [
                            'name' => 'qty',
                            'note' => 'Số lượng nhập kho',
                            'value' => $data_expertise->qty
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
                            'name' => 'made_by',
                            'note' => 'Đơn vị sản xuất',
                            'type' => 'linking',
                            'value' => 1,
                            'other_data' => ['data' => ['table' => 'partners']]
                        ]
                    ];
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