<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $protectFields = false;
    //type
    const HARD_BOX = 1;
    const PAPER_BOX = 2;
    const PAPER_BAG = 3;
    const STAMP = 4;
    const LABEL_STAMP = 5;
    const LEAFLET = 6;
}
?>