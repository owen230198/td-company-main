<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CProcess extends Model
{
    protected $table = 'c_processes';
    protected $protectFields = false;
    const ARR_ROLE =  [
        'accept'=>1,
        'receive'=>1
    ];    
}

?>