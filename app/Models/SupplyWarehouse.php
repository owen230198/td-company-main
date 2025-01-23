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

    public static function insertOverSupply($data, $supply_id){
        $supply = SupplyWarehouse::find($supply_id);
        $data_whouse = $data;
        $data_whouse['type'] = $supply->type;
        $data_whouse['target'] = $supply->target;
        $data_whouse['qtv'] = $supply->qtv;
        $data_whouse['status'] = \StatusConst::WAITING;
        $data_whouse['source'] = WarehouseService::OVER;
        $data_whouse['name'] = self::getname($data_whouse);
        SupplyBuying::handleTotalBuyingSupply($data_whouse, false);
        (new \BaseService)->configBaseDataAction($data_whouse);
        SupplyWarehouse::insert($data_whouse);
    }

    public function afterRemove($id)
    {
        return WarehouseHistory::removeData('supply_warehouses', $id);
    }

    static function getname($data)
    {
        $ret = getFieldDataById('name', 'supply_types', $data['target']).' - '.getFieldDataById('name', 'supply_prices', $data['qtv']);
        if (!empty($data['width'])) {
            $ret .=' - '.$data['width'];
        }
        if (!empty($data['length'])) {
            $ret .= 'x'.$data['length'];
        }
        return $ret;
    }

    static function getLabelLinking($data)
    {
        $ret = '';
        if (!empty($data->target)) {
            $ret.= getFieldDataById('name', 'supply_types', $data->target);
        }
        if (!empty($data->qtv)) {
            $ret .= ' - ĐL : '.getFieldDataById('name', 'supply_prices', $data->qtv);
        }
        if (!empty($data->length) && !empty($data->width)) {
            $ret .= ' - '.$data->length.'x'.$data->width;
        }
        if (!empty($data->qty)) {
            $ret .= ' / Còn lại : '.$data->qty;
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
