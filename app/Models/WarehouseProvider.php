<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WarehouseProvider extends Model
{
    protected $table = 'warehouse_providers';
    protected $protectFields = false;
    static function getRole()
    {
        $role = [
            \GroupUser::WAREHOUSE => [
                'insert' => 1,
                'view' => 1,
                'update' => 1
            ],
            \GroupUser::PLAN_HANDLE => [
                'insert' => 1,
                'view' => 1,
                'update' => 1
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    } 
}
