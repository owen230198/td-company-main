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
                        'insert' => ['quotes', 'orders'],
                        'update' => ['quotes', 'orders', 'c_designs'],
                        'copy' => ['quotes', 'orders'],
                        'remove' => ['quotes', 'orders', 'supply_types']
                    ];
}