<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $table = 'products';
    protected $protectFields = false;
    static $childTable = ['papers', 'supplies', 'fill_finishes'];
}

?>