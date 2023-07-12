<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyWarehouse extends Model
{
    protected $table = 'supply_warehouses';
    protected $protectFields = false;
    //status
    const WAITING = 'waiting';

    //source
    const BUY = 1;
    const OVER = 2;
    
    public static function importOverSupply($data){

    }
}
