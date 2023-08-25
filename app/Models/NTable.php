<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NTable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_tables';
    protected $protectFields = false;
    static $specific = [
                        'insert' => ['quotes', 'orders', 'products'],
                        'update' => ['quotes', 'orders', 'products', 'c_designs'],
                        'copy' => ['quotes', 'orders', 'products'],
                        'remove' => ['quotes', 'orders', 'products', 'supply_types']
                    ];
    static $except_linking = ['customers', 'square_warehouses'];
}