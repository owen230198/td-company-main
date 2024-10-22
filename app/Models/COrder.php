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
    const BOUGHT = 'bought';
    const PAYMENT = 'payment';
    const OTHER = 'other';
    const TYPE_PAYMENT = [self::ORDER, self::SELL];
    const WH_FACTORY = 31;
    const WH_OFFICE = 32;

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
                'type_input' => 'price', 
                'inject_class' => '__selling_input_count_item __selling_qty_input_item', 
                'readonly' => $check_readonly
            ],
        ];
        $field_price = [
            'name' => 'price',
            'type' => 'text',
            'note' => 'Đơn giá',
            'attr' => [
                'type_input' => 'price', 
                'inject_class' => '__selling_input_count_item __selling_price_input_item', 
                'readonly' => $check_readonly
            ],
        ];
        $field_total = [
            'name' => 'total',
            'type' => 'text',
            'note' => 'Thành tiền',
            'attr' => ['type_input' => 'price', 'readonly' => 1, 'inject_class' => '__selling_total_item_input']
        ];
        return [
            $field_obj,
            $field_qty,
            $field_price,
            $field_total
        ];   
    }

    static function getTextTypeCOrder($key_type)
    {
        switch ($key_type) {
            case self::ORDER:
                return 'Phiếu trả hàng đặt';
                break;
            case self::SELL:
                return 'Phiếu bán hàng bán sẵn';
                break;
            case self::ADVANCE:
                return 'Phiếu tạm ứng';
                break;
            case self::BOUGHT:
                return 'Phiếu mua hàng';
                break;
            case self::PAYMENT:
                return 'Phiếu thanh toán';
                break;
            default:
                return 'Phiếu khác';
                break;
        }
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
            'attr' => json_encode(['inject_class' => '__select_order_for_selling']),
            'type' => 'linking',
            'other_data' => json_encode([
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'orders',
                    'where' => $where,
                    'field_title' => 'code'
                ]
            ]),
        ];
    }

    static function getFieldAjaxByType($type, $where)
    {
        $order_field = self::getFieldOrdered($where);
        $list =  NDetailTable::where(['act' => 1, 'table_map'=> 'c_orders', 'get_other' => 1])->orderBy('ord', 'asc')->get();
        $fields = $list->pluck(null, 'name')->toArray();
        switch ($type) {
            case self::ORDER:
                return $list->prepend($order_field)->toArray();
                break;
            case self::SELL:
                return $fields;
                break;
            case self::ADVANCE:
                return [
                    $order_field,
                    $fields['advance'],
                    $fields['payment_type'],
                    $fields['rest'],
                    $fields['note'],
                ];
                break;
            case self::OTHER:
                return [
                    $order_field,
                    $fields['other_price'],
                    $fields['total'],
                    $fields['rest'],
                    $fields['note'],
                ];
                break;
            case self::PAYMENT:
                return [
                    $fields['advance'],
                    $fields['payment_type'],
                    $fields['note'],
                ];
                break;
            default:
                return [];
                break;
        }
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
                            ['key' => 'warehouse_type', 'value' => self::WH_FACTORY]
                        ],
                    ],
                ],
            ],
            \GroupUser::ACCOUNTING => [
                'view' => 1,
                'insert' => 1,
                'update' => 
                [
                    'with' => [[
                        'type' => 'group',
                        'query' => [
                            ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED]
                        ]
                    ]]
                ],
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    static function getInsertCode($id)
    {
        COrder::where(['id' => $id])->update(['code' => 'PH-'.sprintf("%08s", $id)]);
    }

    static function canHandle()
    {
        return \GroupUser::isAdmin() || \GroupUser::isSale() || \GroupUser::isAccounting();
    }
}
