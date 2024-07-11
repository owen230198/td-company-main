<?php

namespace App\Models;
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
                'view' => 1
            ],
            \GroupUser::PLAN_HANDLE => [
                'view' => 1
            ]
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
    
    static function getName($data)
    {
        return $data['name'];
    }

    public function afterRemove($id)
    {
        return WarehouseHistory::removeData('extend_warehouses', $id);
    }    
}
