<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CSupply extends Model
{
    protected $table = 'c_supplies';
    protected $protectFields = false;
    const NOT_HANDLE = 'not_handle';    
}

?>