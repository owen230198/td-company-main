<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MoveWarehouse extends Model
{
    protected $table ='move_warehouses';
    protected $protectFields = false;

    static function doLogAction($product, $qty, $warehouse_to, $parent, $note){
        $data = [
            'name' => $product->name,
            'product_warehouse' => $product->id,
            'warehouse_from' => $product->warehouse_type,
            'warehouse_to' => $warehouse_to,
            'qty' => $qty,
            'unit' => $product->unit,
            'price' => $product->price,
            'parent' => $parent,
            'note' => $note,
        ];
        (new \BaseService)->configBaseDataAction($data);
        $id = MoveWarehouse::insertGetId($data);
        self::getInsertCode($id);
    }

    static function getRole()
    {
        $role = [
            \GroupUser::ACCOUNTING => [
                'view' => 1,
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }

    static function getInsertCode($id)
    {
        MoveWarehouse::where(['id' => $id])->update(['code' => 'CK-'.formatCodeInsert($id)]);
    }
}
