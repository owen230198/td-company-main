<?php

namespace App\Models;

use App\Services\WarehouseService;
use Illuminate\Database\Eloquent\Model;

class OtherWarehouse extends Model
{
    protected $table = 'other_warehouses';
    protected $protectFields = false;
    protected $guarded = [];
    
    static function getRole()
    {
        $role = WarehouseService::ROLE;
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
