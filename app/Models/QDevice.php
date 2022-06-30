<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class QDevice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q_devices';
    protected $protectFields = false;
}