<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class QPaper extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q_papers';
    protected $protectFields = false;
}