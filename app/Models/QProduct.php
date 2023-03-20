<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class QProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q_products';
    protected $protectFields = false;
}