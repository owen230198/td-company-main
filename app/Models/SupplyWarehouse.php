<?php

namespace App\Models;

use App\Services\WarehouseService;
use Illuminate\Database\Eloquent\Model;

class SupplyWarehouse extends Model
{
    protected $table = 'supply_warehouses';
    protected $protectFields = false;
    protected $guarded = [];
    
    static function getRole()
    {
        $role = WarehouseService::getRole();
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 

    public static function insertOverSupply($data, $supply, $size){
        $data_whouse = $data;
        $data_whouse['type'] = $supply->type;
        $data_whouse['supp_type'] = @$size['supply_type'];
        $data_whouse['supp_price'] = @$size['supply_price'];
        $data_whouse['status'] = \StatusConst::WAITING;
        $data_whouse['source'] = WarehouseService::OVER;
        (new \BaseService)->configBaseDataAction($data_whouse);
        SupplyWarehouse::insert($data_whouse);
    }

    public function afterRemove($id)
    {
        return WarehouseHistory::removeData('supply_warehouses', $id);
    }

    static function getname($data)
    {
        return getFieldDataById('name', 'supply_types', $data['supp_type']).' - '.getFieldDataById('name', 'supply_prices', $data['supp_price']).' - '.$data['length'].'x'.$data['width'];
    }

    static function getLabelLinking($data)
    {
        $ret = '';
        if (!empty($data->supp_type)) {
            $ret.= getFieldDataById('name', 'supply_types', $data->supp_type);
        }
        if (!empty($data->length) && !empty($data->width)) {
            $ret .= ' - '.$data->length.'x'.$data->width;
        }
        if (!empty($data->supp_price)) {
            $ret .= ' - ĐL : '.getFieldDataById('name', 'supply_prices', $data->supp_price);
        }
        if (!empty($data->qty)) {
            $ret .= ' / Còn lại : '.$data->qty.' tấm';
        }else{
            $ret .= ' (đã hết)';
        }
        
        return $ret;
    }

    static function getStructForPlan($param)
    {
        return ['code' => 200, 'data' => ['inhouse' => $param['supply']->qty]];
    }
}
