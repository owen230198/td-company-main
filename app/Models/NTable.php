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
                        'insert' => ['quotes', 'orders', 'products', 'print_warehouses', 'square_warehouses', 'supply_warehouses', 'other_warehouses'],
                        'update' => ['quotes', 'orders', 'products', 'c_designs', 'print_warehouses', 'square_warehouses', 'supply_warehouses', 'other_warehouses'],
                        'copy' => ['quotes', 'orders', 'products', 'print_warehouses', 'square_warehouses', 'supply_warehouses', 'other_warehouses'],
                        'remove' => ['quotes', 'orders', 'products', 'supply_types', 'print_warehouses', 'square_warehouses', 'supply_warehouses', 'other_warehouses']
                    ];
}