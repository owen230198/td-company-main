<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{
    protected $table = 'product_warehouses';
    protected $protectFields = false;
    protected $guarded = [];
    static function getRole()
    {
        $role = [
            \GroupUser::SALE => [
                'view' => 1
            ],
            \GroupUser::PRODUCT_WAREHOUSE => [
                'view' => 1
            ],
            \GroupUser::ACCOUNTING => [
                'view' => 1
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }

    static function getDataJsonLinking($products, $q)
    {
        if (!empty($q)) {
            $q = '%'.trim($q).'%';
            $products->where(function ($products) use ($q) {
                $products->orWhere('code', 'like', $q)
                            ->orWhere('name', 'like', $q);
            });
        }
        $data = $products->paginate(50)->all();
        $arr = array_map(function($item){
            return ['id' => @$item->id, 'label' => getFieldDataById('name', 'supply_extends', $item->warehouse_type).' - '.$item->code.' - '.$item->name];
        }, $data);
        return json_encode($arr);
    }

    static function takeOut($obj, $warehouse, $c_order_id = null, $receipt = '')
    {
        $inventory = (int) $obj->qty;
        $ex_qty = (int) $warehouse['qty'];
        $product_id = $warehouse['id'];
        $obj->qty -= $ex_qty;
        $obj->save();
        $arr_log = ['price' => $warehouse['price']];
        if (!empty($c_order_id)) {
            $arr_log['c_order'] = $c_order_id;
        }
        if (!empty($receipt)) {
            $arr_log['receipt'] = $receipt;
        }
        ProductHistory::doLogWarehouse($product_id, 0, $ex_qty, $inventory, 0, $arr_log);
    }

    public function afterRemove($id)
    {
        return ProductHistory::removeData($id);
    }

    static function getFieldMove($product = new \stdClass())
    {
        $fields['fields'] = [
            [
                'name' => 'warehouse_take',
                'note' => 'Xuất tại kho',
                'type' => 'linking',
                'other_data' => [
                    'config' => ['search' => 1], 
                    'data'=> [
                        'table' => 'supply_extends',
                        'where' => ['type' => 'warehouse_type']
                    ]
                ],
                'attr' => ['readonly' => @$product->warehouse_type ? 1 : 0, 'inject_class' => empty($product->id) ? 'tiny_input __move_warehouse_select_take' : ''],
                'value' => @$product->warehouse_type
            ],
            [
                'name' => 'id',
                'note' => 'Thành phẩm',
                'type' => 'linking',
                'other_data' => ['config' => ['search' => 1], 'data'=> ['table' => 'product_warehouses']],
                'attr' => ['readonly' => @$product->id ? 1 : 0, 'inject_class' => '__move_warehouse_select_product'],
                'value' => @$product->id
            ],
            [
                'name' => 'qty',
                'note' => 'Số lượng',
                'type' => 'text',
                'attr' => ['type_input' => 'number', 'inject_class' => 'tiny_input __move_warehouse_qty'],
                'value' => @$product->qty
            ],
            [
                'name' => 'warehouse_to',
                'note' => 'Nhập tại kho',
                'type' => 'linking',
                'other_data' => [
                    'config' => ['search' => 1], 
                    'data'=> [
                        'table' => 'supply_extends',
                        'where' => ['type' => 'warehouse_type']
                    ]
                ],
                'attr' => ['inject_class' => empty($product->id) ? 'tiny_input __move_warehouse_to' : ''],
                'value' => @$product->warehouse_type
            ],
            [
                'name' => 'note',
                'note' => 'Ghi chú',
                'type' => 'textarea',
                'attr' => ['inject_class' => empty($product->id) ? 'short_field __move_warehouse_note' : ''],
                'value' => 'Chuyển thành phẩm '.@$product->name
            ]
        ];
        $fields['receipt'] = [
            'name' => 'receipt',
            'note' => 'Phiếu chuyển kho',
            'type' => 'filev2',
            'other_data' => ['role_update' => [\GroupUser::ACCOUNTING]] 
        ];
        return $fields;
    }

    static function getInsertCode($id)
    {
        ProductWarehouse::where(['id' => $id])->update(['code' => 'SP-'.formatCodeInsert($id)]);
    }
}
