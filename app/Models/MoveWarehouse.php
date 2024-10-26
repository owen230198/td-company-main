<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MoveWarehouse extends Model
{
    protected $table ='move_warehouses';
    protected $protectFields = false;

    static function doLogAction($product, $qty, $warehouse_to, $receipt_code, $receipt, $note){
        $data = [
            'name' => $product->name,
            'product_warehouse' => $product->id,
            'warehouse_from' => $product->warehouse_type,
            'warehouse_to' => $warehouse_to,
            'qty' => $qty,
            'unit' => $product->unit,
            'price' => $product->price,
            'receipt' => $receipt,
            'note' => $note,
            'receipt_code' => $receipt_code
        ];
        (new \BaseService)->configBaseDataAction($data);
        $id = MoveWarehouse::insertGetId($data);
        self::getInsertCode($id);
    }

    static function getInsertCode($id)
    {
        MoveWarehouse::where(['id' => $id])->update(['code' => 'CK-'.formatCodeInsert($id)]);
    }
}
