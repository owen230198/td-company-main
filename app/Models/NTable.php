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
                        'insert' => [
                            'customers',
                            'quotes', 
                            'orders', 
                            'products', 
                            'print_warehouses', 
                            'square_warehouses', 
                            'supply_warehouses', 
                            'other_warehouses',
                            'extend_warehouses', 
                            'supply_buyings',
                            'c_expertises',
                            'c_supplies'
                        ],
                        'update' => [
                            'customers',
                            'quotes', 
                            'orders', 
                            'products', 
                            'c_designs', 
                            'print_warehouses', 
                            'square_warehouses', 
                            'supply_warehouses', 
                            'other_warehouses',
                            'extend_warehouses', 
                            'supply_buyings',
                            'c_expertises',
                            'c_supplies'
                        ],
                        'copy' => [
                            'quotes', 
                            'orders', 
                            'products', 
                            'print_warehouses', 
                            'square_warehouses', 
                            'supply_warehouses', 
                            'other_warehouses',
                            'extend_warehouses', 
                            'supply_buyings',
                            'c_expertises'
                        ],
                        'remove' => [
                            'customers',
                            'quotes', 
                            'orders', 
                            'products', 
                            'supply_types', 
                            'print_warehouses', 
                            'square_warehouses', 
                            'supply_warehouses', 
                            'other_warehouses',
                            'extend_warehouses',
                            'c_expertises'
                        ],
                        'import' => [
                            'print_warehouses',
                            'supply_warehouses',
                            'square_warehouses',
                            'extend_warehouses',
                            'orders',
                        ]
                    ];
}