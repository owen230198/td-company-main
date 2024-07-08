<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OtherWarehouse extends Model
{
    protected $table = 'other_warehouses';
    protected $protectFields = false;
    protected $guarded = [];
    
    static function getRole()
    {
        $role = [
            \GroupUser::WAREHOUSE => [
                'insert' => 1,
                'view' => 1,
                'update' => 1
            ],
            \GroupUser::PLAN_HANDLE => [
                'view' => 1
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    
    static function getName($data)
    {
        return getFieldDataById('name', 'materals', $data['supp_price']);
    }

    public function afterRemove($id)
    {
        return WarehouseHistory::removeData('other_warehouses', $id);
    }    
}
