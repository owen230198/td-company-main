<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class SupplyType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supply_types';
    protected $protectFields = false;
    public function afterRemove($id)
    {
        SupplyPrice::where('supply_id', $id)->delete();    
    }
}