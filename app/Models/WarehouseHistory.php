<?php

namespace App\Models;

use App\Services\WarehouseService;
use Illuminate\Database\Eloquent\Model;

class WarehouseHistory extends Model
{
    protected $table = 'warehouse_histories';
    protected $protectField = false;
    //warehouse type
    const SUPPLY = 1;
    const PRODUCT = 2;


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

    static function doLogWarehouse($supply_id, $qty_import, $qty_export, $ex_inventory, $product_id = 0, $arr = []){
        $supply = getDetailDataObject('supply_warehouses', $supply_id);
        $data_log['name'] = $supply->name;
        $data_log['target'] = $supply_id;
        $data_log['imported'] = $qty_import;
        $data_log['exported'] = $qty_export;
        $data_log['ex_inventory'] = $ex_inventory;
        $data_log['inventory'] = $supply->qtv;
        $data_log['product'] = $product_id;
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                $data_log[$key] = $value;
            }
        }
        (new \BaseService)->configBaseDataAction($data_log);
        return \DB::table('warehouse_histories')->insertGetId($data_log);
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
