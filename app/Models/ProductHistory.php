<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    protected $table = 'product_histories';
    protected $protectFields = false;
    static function doLogWarehouse($id, $qty_import, $qty_export, $ex_inventory, $product_id = 0, $arr = []){
        $product_warehouse = getDetailDataObject('product_warehouses', $id);
        $data_log['name'] = $product_warehouse->name;
        $data_log['target'] = $id;
        $data_log['source'] = $product_warehouse->made_by;
        $data_log['imported'] = $qty_import;
        $data_log['exported'] = $qty_export;
        $data_log['ex_inventory'] = $ex_inventory;
        $data_log['inventory'] = $product_warehouse->qty;
        $data_log['unit'] = $product_warehouse->unit;
        $data_log['product'] = $product_id;
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                $data_log[$key] = $value;
            }
        }
        (new \BaseService)->configBaseDataAction($data_log);
        \DB::table('product_histories')->insert($data_log);
    }

    static function removeData($id)
    {
        $data_logs = ProductHistory::where(['target' => $id]);
        foreach ($data_logs->get() as $data_log) {
            if (!empty($data_log['receipt'])) {
                removeFileData($data_log['receipt']);
            }
        }
        $data_logs->delete();
    }
}
