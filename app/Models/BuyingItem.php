<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BuyingItem extends Model
{
    protected $table = 'buying_items';
    protected $protectFields = false;
    protected $guarded = [];

    public function beforeRemove($id, $obj)
    {
        if (!empty($obj->parent)) {
            SupplyBuying::refreshCost($obj->parent);
        }
    } 
}
