<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyWarehouse extends Model
{
    protected $table = 'supply_warehouses';
    protected $protectFields = false;
    //status
    const WAITING = 'waiting';
    const IMPORTED = 'imported';

    //source
    const BUY = 1;
    const OVER = 2;
    
    public static function insertOverSupply($data, $supply, $size){
        $data_whouse = $data;
        $data_whouse['type'] = $supply->type;
        $data_whouse['supp_type'] = @$size['supply_type'];
        $data_whouse['supp_price'] = @$size['supply_price'];
        $data_whouse['status'] = self::WAITING;
        $data_whouse['source'] = self::OVER;
        (new \BaseService)->configBaseDataAction($data_whouse);
        SupplyWarehouse::insert($data_whouse);
    }
}
