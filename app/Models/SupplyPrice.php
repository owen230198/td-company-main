<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class SupplyPrice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supply_prices';
    protected $protectFields = false;
}