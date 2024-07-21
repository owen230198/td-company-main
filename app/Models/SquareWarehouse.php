<?php

namespace App\Models;

use App\Services\WarehouseService;
use Illuminate\Database\Eloquent\Model;

class SquareWarehouse extends Model
{
    protected $table = 'square_warehouses';
    protected $protectFields = false;
    protected $guarded = [];

    static function getRole()
    {
        $role = WarehouseService::ROLE;
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    
    static function isWeightSupply($type)
    {
        return in_array(@$type, [\TDConst::EMULSION, \TDConst::SKRINK]);
    }

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
            $qty = self::isWeightSupply($item->type) ? $item->weight.' kg' : $item->qty. ' cm';
            return [
                'id' => @$item->id, 
                'label' => $item->name. ' / KT Khổ : '.$item->width.' / Còn lại : '.$qty];
        }, $data);
        return json_encode($arr);
    }

    static function getStructForPlan($param)
    {
        $supply = $param['supply'];
        $need = $param['need'];
        $inhouse = (float) $supply->qty;
        if ($need > $inhouse) {
            $takeout = $inhouse;
            $rest = 0;
            $lack = $need - $inhouse;
        }else{
            $takeout = $need;
            $rest = $inhouse - $need;
            $lack = 0;
        }
        return ['code' => 200, 'data' => ['inhouse' => $inhouse, 'takeout' => $takeout, 'rest' => $rest, 'lack' => $lack]];
    }

    public function afterRemove($id)
    {
        return WarehouseHistory::removeData('square_warehouses', $id);
    }

    static function getName($data)
    {
        return getFieldDataById('name', 'materals', $data['supp_price']).' - '.$data['width'];
    }

    static function getLabelLinking($data)
    {   
        return self::isWeightSupply($data->type) ? $data->name : getFieldDataById('name', 'materals', $data->supp_price).' - Khổ : '.$data->width;
    }
}
