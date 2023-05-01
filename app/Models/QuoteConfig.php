<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class QConfig extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quote_configs';
    protected $protectFields = false;
}