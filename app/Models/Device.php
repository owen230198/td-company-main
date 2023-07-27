<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Device extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'devices';
    protected $protectFields = false;

    // Loại thiết bị
    const AUTO_DEVICE = 'auto';
    const SEMI_AUTO_DEVICE = 'semi_auto';
}