<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class COrder extends Model
{
    protected $table = 'c_orders';
    protected $protectFields = false;
    protected $guarded = [];

    const ADVANCE = 'advance';
    const ORDER = 'order';
    const SELL = 'sell';
    const ORTHER = 'other';

    static function getFeildProductJson($value)
    {
        $check_readonly = \GroupUser::isAdmin() || \GroupUser::isSale() ? 0 : 1;
        $field_obj = [
            'name' => 'id',
            'note' => 'Chọn thành phẩm',
            'attr' => [
                "required" => 1, 
                "inject_class" => "__select_product_sell", 
                "readonly" => $check_readonly],
            'type' => 'linking',
            'value' => !empty($value['product']) ? $value['product'] : '',
            'other_data' => [
                "config" => [ "search"=> 1],
                "data" => [
                    "table" => 'product_warehouses'
                ]
            ]
        ];
        $field_qty = [
            'name' => 'qty',
            'type' => 'text',
            'note' => 'Số lượng',
            'attr' => [
                'type_input' => 'number', 
                'inject_class' => '__selling_input_count_item __selling_qty_input_item', 
                'readonly' => $check_readonly
            ],
        ];
        $field_price = [
            'name' => 'price',
            'type' => 'text',
            'note' => 'Đơn giá',
            'attr' => [
                'type_input' => 'number', 
                'inject_class' => '__selling_input_count_item __selling_price_input_item', 
                'readonly' => $check_readonly
            ],
        ];
        $field_total = [
            'name' => 'total',
            'type' => 'text',
            'note' => 'Thành tiền',
            'attr' => ['type_input' => 'number', 'readonly' => 1, 'inject_class' => '__selling_total_item_input']
        ];
        return [
            $field_obj,
            $field_qty,
            $field_price,
            $field_total
        ];   
    }

    static function validateArrObject($object, $temp_name){
        if (empty($object['id'])) {
            return returnMessageAjax(100, 'Bạn chưa chọn thành phẩm cho '.$temp_name.' !');
        }
        $product = ProductWarehouse::find($object['id']);
        if (empty($product)) {
            return returnMessageAjax(100, 'Dữ liệu '.$temp_name.' Không tồn tại hoặc đã bị xóa !');
        }
        $name = !empty($product->name) ? $product->name : $temp_name;
        if (empty($object['qty'])) {
            return returnMessageAjax(100, 'Bạn chưa nhập số lượng cho '.$name.' !');
        }
        if ((int) $object['qty'] > (int) $product->qty) {
            return returnMessageAjax(100, 'Tồn kho'.$name.' không đủ để xuất cho đơn này !');
        }
        return $product;
    }

    static function getFieldOrdered($data)
    {
        $where = ['status' => \StatusConst::IMPORTED];
        if (!empty($data['customer'])) {
            $where['customer'] = $data['customer'];
        }

        if (!empty($data['represent'])) {
            $where['represent'] = $data['represent'];
        }

        return [
            'name' => 'order',
            'note' => 'Chọn đơn khách đã đặt sản xuất',
            'attr' => ['inject_class' => '__select_order_for_selling'],
            'type' => 'linking',
            'other_data' => [
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'orders',
                    'where' => $where,
                    'field_title' => 'code'
                ]
            ],
        ];
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
                'clone' => 1
            ],
            \GroupUser::PRODUCT_WAREHOUSE => [
                'view' => [
                    'with' => [
                        'type' => 'group',
                        'query' =>[
                            ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED],
                            ['con' => 'or', 'key' => 'confirm_warehouse', 'value' => \StatusConst::NOT_ACCEPTED]
                        ],
                    ],
                ],
            ],
            \GroupUser::ACCOUNTING => [
                'view' => 1,
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    static function getInsertCode($id)
    {
        COrder::where(['id' => $id])->update(['code' => 'PH-'.sprintf("%08s", $id)]);
    }
}
