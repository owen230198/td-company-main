<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NDetailTable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_detail_tables';
    protected $protectFields = false;

    static function handleField(&$data, $action)
    {
        $rowspan = 1;
        foreach ($data as $key => $field) {
            if($field['parent'] == 0 && $field['type'] == 'group'){
                $rowspan = 2;
                $data[$key]['child'] = NDetailTable::where(['act' => 1, 'parent' => $field['id']])->orderBy('ord', 'asc')->get()->toArray();
                $data[$key]['colspan'] = !empty($data[$key]['child']) ? count($data[$key]['child']) : 1;
            }
        }
        $data = $action == 'view' ? ['rowspan' => $rowspan, 'field_shows' => $data] : $data;
    }
}