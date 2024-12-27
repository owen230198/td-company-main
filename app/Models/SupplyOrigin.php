<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class SupplyOrigin extends Model
{
    protected $table = 'supply_origins';
    protected $protectFields = false;
    
    static function getTableSupplyParentByType($data)
    {
        return self::getTableParentByType(@$data->type);
    }

    static function getTableParentByType($type){
        if (empty($type)) {
            return 'materals';
        }
        $arr = searchSupplyCate($type, 'type');
        $supply_cate = reset($arr);
        return @$supply_cate['table_parent'] ?? 'materals';
    }
}
