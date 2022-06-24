<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Quote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quotes';
    protected $protectFields = false;
}