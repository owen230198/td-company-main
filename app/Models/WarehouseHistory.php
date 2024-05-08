<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WarehouseHistory extends Model
{
    protected $table = 'warehouse_histories';
    protected $protectField = false;
    //warehouse type
    const SUPPLY = 1;
    const PRODUCT = 2;

    const FIELD_QTY = [
        'name' => 'qty',
        'type' => 'text',
        'note' => 'Thêm số lượng',
        'attr' => ['type_input' => 'number']
    ];
    const FIELD_PROVIDER = [
        'name' => 'provider',
        'note' => 'Nhà cung cấp',
        'type' => 'linking',
        'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'warehouse_providers']]
    ];
    const FIELD_PRICE = [
        'name' => 'price',
        'type' => 'text',
        'note' => 'Giá vật tư',
        'attr' => ['type_input' => 'number']
    ];
    const FIELD_BILL = [
        'name' => 'bill',
        'note' => 'Hóa đơn thanh toán',
        'type' => 'filev2',
    ];

    const FIELD_NOTE = [
        'name' => 'note',
        'note' => 'Diễn giải',
        'type' => 'textarea',
    ];

    const FIELD_INSERT = [
        self::FIELD_QTY,
        self::FIELD_PROVIDER,
        self::FIELD_PRICE,
        self::FIELD_BILL,
        self::FIELD_NOTE             
    ];

    const FIELD_UPDATE = [
        self::FIELD_QTY,
        self::FIELD_PROVIDER,
        self::FIELD_PRICE,
        self::FIELD_BILL,
        self::FIELD_NOTE             
    ];

    static function getRole()
    {
        $role = [
            \GroupUser::ACCOUNTING => [
                'view' => 1
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 

    static function removeData($table, $id)
    {
        $data_logs = WarehouseHistory::where(['table' => $table, 'target' => $id]);
        foreach ($data_logs->get() as $data_log) {
            if (!empty($data_log['bill'])) {
                removeFileData($data_log['bill']);
            }
        }
        $data_logs->delete();
    }

    static function getInventoryAllTable($where)
    {
        $print = \DB::table('print_warehouses')->select('id', 'name', 'type', \DB::raw("'print_warehouses' as table_name"))->where($where);
        $square = \DB::table('square_warehouses')->select('id', 'name', 'type', \DB::raw("'square_warehouses' as table_name"))->where($where);
        $supply = \DB::table('supply_warehouses')->select('id', 'name', 'type', \DB::raw("'supply_warehouses' as table_name"))->where($where);
        $other = \DB::table('other_warehouses')->select('id', 'name', 'type', \DB::raw("'other_warehouses' as table_name"))->where($where);
        return $print->union($square)->union($supply)->union($other);

    }
}
