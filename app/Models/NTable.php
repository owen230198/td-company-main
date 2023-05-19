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
                        'update' => ['quotes', 'orders'],
                        'remove' => ['quotes', 'orders'],
                        'copy' => ['quotes', 'orders'],
                        'remove' => ['quotes', 'orders']
                    ];
}