<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class QuoteConfig extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quote_configs';
    protected $protectFields = false;
}