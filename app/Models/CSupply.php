<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CSupply extends Model
{
    protected $table = 'c_supplies';
    protected $protectFields = false;
    //status
    const NOT_HANDLE = 'not_handle';
    const HANDLING = 'handling'; 
    const HANDLE_SUBMITED = 'handle_submited';

    //type
    const IMPORT = 1;
    const EXPORT = 2;     
}

?>