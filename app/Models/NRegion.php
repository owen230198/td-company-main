<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NRegion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_regions';
    protected $protectFields = false;

    public function getRegionOfTable($table, $action = 'update')
    {
        $data = $this->select('n_regions.id', 'n_regions.name')->join('n_detail_tables', 'n_regions.id', '=', 'n_detail_tables.region')
        ->where('n_detail_tables.table_map', $table)
        ->where('n_detail_tables.act', 1)
        ->where('n_detail_tables.'.$action, 1)
        ->groupBy('n_regions.id')
        ->get()->toArray();
        return $data;
    }

    public function getRegionOfConfig($table)
    {
        $data = $this->select('n_regions.id', 'n_regions.name')->join($table, 'n_regions.id', '=', $table.'.region')
        ->where($table.'.act', 1)->groupBy('n_regions.id')->get()->toArray();
        return $data;
    }
}