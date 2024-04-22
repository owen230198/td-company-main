<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{
    protected $table = 'product_warehouses';
    protected $protectFields = false;
    static function getRole()
    {
        $role = [
            \GroupUser::PRODUCT_WAREHOUSE => [
                'view' => 1
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
}
