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
            \GroupUser::PRODUCT_WAREHOUSE => [
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
            return ['id' => @$item->id, 'label' => $item->code.' - '.$item->name];
        }, $data);
        return json_encode($arr);
    }
}
