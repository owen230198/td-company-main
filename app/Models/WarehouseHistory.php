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

    const FIELD_INSERT = [
        self::FIELD_QTY,
        self::FIELD_PROVIDER,
        self::FIELD_PRICE,
        self::FIELD_BILL           
    ];

    const FIELD_UPDATE = [
        self::FIELD_QTY,
        self::FIELD_PROVIDER,
        self::FIELD_PRICE,
        self::FIELD_BILL           
    ];

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
}
