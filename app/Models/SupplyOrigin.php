<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SupplyOrigin extends Model
{
    protected $table = 'supply_origins';
    protected $protectFields = false;
    
    static function getTableSupplyParentByType($data)
    {
        if (empty($data->type)) {
            return 'materals';
        }
        $arr = searchSupplyCate($data->type, 'type');
        $supply_cate = reset($arr);
        return @$supply_cate['table_parent'] ?? 'materals';
    }
}
