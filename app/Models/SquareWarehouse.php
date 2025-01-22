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
        $role = WarehouseService::getRole();
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    
    static function isWeightSupply($type)
    {
        return in_array(@$type, [\TDConst::EMULSION, \TDConst::SKRINK]);
    }

    static function isHasDeviceSupply($type)
    {
        return in_array(@$type, [\TDConst::NILON, \TDConst::METALAI]);
    }

    static function isWeightLogWarehouse($type)
    {
        return self::isWeightSupply($type) || self::isHasDeviceSupply($type);
    }

    static function countPriceByWeight($type)
    {
        return in_array($type, [\TDConst::METALAI, \TDConst::NILON]); 
    }

    static function countPriceByHank($type)
    {
        return in_array($type, [\TDConst::EMULSION, \TDConst::SKRINK, \TDConst::DECAL]);
    }

    static function countPriceBySquare($type)
    {
        return in_array($type, [\TDConst::SILK, \TDConst::COVER]);
    }

    static function getLengthByWeight($materal_id, $weight, $width)
    {
        $factor = (float) getFieldDataById('factor', 'materals', $materal_id);
        return $factor * $weight / $width;   
    }
    
    static function getWeightByLength($supply_id, $length)
    {
        $supply = getDetailDataByID('SquareWarehouse', $supply_id);
        $factor = (float) getFieldDataById('factor', 'materals', $supply->supp_price);
        return ($length * $supply->width) / $factor;   
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
            $base_unit = $item->hank.' cuộn - '.$item->weight.' kg';
            $qty = self::isWeightSupply($item->type) ? $base_unit : $item->qty. ' cm'. ' - '. $base_unit;
            return [
                'id' => @$item->id, 
                'label' => $item->name. ' / Khổ : '.$item->width.' / Còn lại : '.$qty];
        }, $data);
        return json_encode($arr);
    }

    public function afterRemove($id)
    {
        return WarehouseHistory::removeData('square_warehouses', $id);
    }

    static function getName($data)
    {
        $name = '';
        if (self::isWeightLogWarehouse($data['type'])) {
            $name .= getFieldDataById('name', 'supply_names', $data['device']).' - ';
        }
        if (!empty($data['supp_price'])) {
            $name .= getFieldDataById('name', 'materals', $data['supp_price']).' - ';
        }
        return $name .= $data['width'];
    }

    static function getLabelLinking($data)
    {
        if (empty($data)) {
            return '';
        }elseif (self::isWeightSupply($data->type)) {
            return $data->name; 
        }elseif (self::isHasDeviceSupply($data->type)) {
           return getFieldDataById('name', 'supply_names', $data->device).' - '.getFieldDataById('name', 'materals', $data->supp_price).' - Khổ : '.$data->width;
        }else{
            return  getFieldDataById('name', 'materals', $data->supp_price).' - Khổ : '.$data->width;
        }
    }
}
