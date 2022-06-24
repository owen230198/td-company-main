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

    public function getRegionOfTable($table)
    {
        $data = $this->select('n_regions.id', 'n_regions.name')->join('n_detail_tables', 'n_regions.id', '=', 'n_detail_tables.region')
        ->where('n_detail_tables.table_map', $table)
        ->where('n_detail_tables.act', 1)
        ->where('n_detail_tables.update', 1)
        ->groupBy('n_regions.id')
        ->get()->toArray();
        return $data;
    }

    public function getRegionOfConfig($table)
    {
        $this->select('n_regions.id, n_regions.name');
        $this->join(''.$table.' as config', 
        'n_regions.id = config.region
        AND config.act = 1');
        $this->groupBy('n_regions.id');
        $data = $this->get()->getResult('array');
        return $data;
    }
}