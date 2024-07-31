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

    const FIELD_LENGTH = [
        'name' => 'length',
        'type' => 'text',
        'note' => 'Số cm mua thêm',
        'attr' => ['type_input' => 'number']
    ];

    const FIELD_HANK = [
        'name' => 'hank',
        'type' => 'text',
        'note' => 'Số cuộn mua thêm',
        'attr' => ['type_input' => 'number']
    ];
    const FIELD_WEIGHT = [
        'name' => 'weight',
        'type' => 'text',
        'note' => 'Số kg mua thêm',
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

    static function getFieldAction($type){
        $key_unit = getUnitSupplyLogWarehouse($type);
        $field_qty = self::FIELD_QTY;
        $field_qty['note'] = 'Số '.getUnitWarehouseItem($key_unit).' mua thêm';
        $ret = [];
        switch ($type) {
            case SquareWarehouse::countPriceByWeight($type):
                $ret = [$field_qty, self::FIELD_HANK];
                break;
            case SquareWarehouse::countPriceByHank($type):
                $ret = [$field_qty];
                if ($type == \TDConst::DECAL) {
                    $ret[] = self::FIELD_LENGTH;
                }else{
                    $ret[] = self::FIELD_WEIGHT;
                }
                break;
            default:
                $ret[] = $field_qty;
                break;
        }
        foreach (self::FIELDS as $field) {
            $ret[] = $field;
        }
        return $ret; 
    }

    const FIELDS = [
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
    
    static function getInventoryAggrenate($table, $where, $ext_where)
    {
        $ret = \DB::table($table)->select('id', 'name', 'type', 'updated_at', \DB::raw("'$table' as table_name"))->where($where);
        if (!empty($ext_where[$table])) {
            $ret = $ret->where($ext_where[$table]);
        }
        return $ret;
    }

    static function doLogWarehouse($type, $supply_id, $qty_import, $qty_export, $ex_inventory, $note, $product_id = 0){
        $table = tableWarehouseByType($type);
        $supply = getDetailDataObject($table, $supply_id);
        $type = $supply->type;
        $data_log['name'] = $supply->name;
        $data_log['table'] = $table;
        $data_log['type'] = $type;
        $data_log['target'] = $supply_id;
        $data_log['imported'] = $qty_import;
        $data_log['exported'] = $qty_export;
        $data_log['ex_inventory'] = $ex_inventory;
        $field_qty = SquareWarehouse::isWeightLogWarehouse($type) ? 'weight' : 'qty';
        $data_log['inventory'] = getFieldDataById($field_qty, $table, $supply_id);
        $unit = getUnitSupplyLogWarehouse($type, $supply);
        $data_log['unit'] = $unit;
        $data_log['product'] = $product_id;
        $data_log['note'] = $note;
        (new \BaseService)->configBaseDataAction($data_log);
        \DB::table('warehouse_histories')->insert($data_log);
    }

    static function getInventoryAllTable($where, $ext_where)
    {
        $print = self::getInventoryAggrenate('print_warehouses', $where, $ext_where);
        if (!empty($ext_where['print_warehouses'])) {
            return $print;
        }
        $square = self::getInventoryAggrenate('square_warehouses', $where, $ext_where);
        if (!empty($ext_where['square_warehouses'])) {
            return $square;
        }
        $supply = self::getInventoryAggrenate('supply_warehouses', $where, $ext_where);
        if (!empty($ext_where['supply_warehouses'])) {
            return $supply;
        }
        $other = self::getInventoryAggrenate('other_warehouses', $where, $ext_where);
        if (!empty($ext_where['other_warehouses'])) {
            return $other;
        }

        $other = self::getInventoryAggrenate('extend_warehouses', $where, $ext_where);
        if (!empty($ext_where['extend_warehouses'])) {
            return $other;
        }
        return $print->union($square)->union($supply)->union($other);
    }
}
