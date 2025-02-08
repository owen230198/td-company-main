<?php

namespace App\Models;

use App\Services\WarehouseService;
use Illuminate\Database\Eloquent\Model;

class ExtendWarehouse extends Model
{
    protected $table = 'extend_warehouses';
    protected $protectFields = false;
    protected $guarded = [];
    
    static function getRole()
    {
        $role = [
            \GroupUser::WAREHOUSE => [
                'view' => in_array('other', \User::getSupplyRole())
            ],
            \GroupUser::PLAN_HANDLE => [
                'view' => 1
            ],
            \GroupUser::ACCOUNTING => [
                'view' => 1,
            ]
            ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    
    static function getName($data)
    {
        $name = !empty($data['name']) ? $data['name'] : getFieldDataById('name', 'supply_extends', $data['type']);
        if (!empty($data['ver'])) {
            $name .= ' Bản '.$data['ver'];
        }
        return $name;
    }

    static function getLabelLinking($data)
    {
        $label = '';
        if (empty($data)) {
            return '';
        }

        if (!empty($data->type)) {
            $label .= getFieldDataById('name', 'supply_extends', $data->type);
        }

        if (!empty($data->name)) {
            $label .= '-'. $data->name;
        }

        if (!empty($data->ver)) {
            $label .= ' - '.$data->ver;
        }

        if (!empty($data->qty)) {
            $label .= ' - còn lại: '.$data->qty.' '.getUnitWarehouseItem($data->unit);
        }
        return $label;
    }

    public function afterRemove($id)
    {
        return WarehouseHistory::removeData('extend_warehouses', $id);
    }    
}
