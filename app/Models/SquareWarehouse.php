<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SquareWarehouse extends Model
{
    protected $table = 'square_warehouses';
    protected $protectFields = false;

    static function getDataJsonLinking($warehouse, $q)
    {
        if (!empty($q)) {
            $warehouse->where(function ($warehouse) use ($q) {
                $warehouse->orWhere('name', 'like', '%'.trim($q).'%')
                            ->orWhere('width', '>=', (float)$q);
            });
        }
        $data = $warehouse->paginate(50)->all();
        $arr = array_map(function($item){
            return [
                'id' => @$item->id, 
                'label' => $item->name. ' / KT Khổ : '.$item->width.' / Còn lại : '.$item->square.'m'];
        }, $data);
        return json_encode($arr);
    }
}
