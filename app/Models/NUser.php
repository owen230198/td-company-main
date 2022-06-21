<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_users';
    protected $protectFields = false;
}