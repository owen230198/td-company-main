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

    static function handleField(&$data, $action, $where = [])
    {
        $rowspan = 1;
        $fields = [];
        foreach ($data as $field) {
            if($field['parent'] == 0 && $field['type'] == 'group'){
                $rowspan = 2;
                $childs = NDetailTable::where(['act' => 1, 'parent' => $field['id']])->orderBy('ord', 'asc')->get()->toArray();
                $field['child'] = $childs;
                $field['colspan'] = !empty($childs) ? count($childs) : 1;
            }
            $conditions = !empty($field['condition']) ? json_decode($field['condition'], true) : [];
            if(!empty($field['group_user'])){
                $arr_group = explode(',', $field['group_user']);
                if (in_array(\GroupUser::getCurrent(), $arr_group)) {
                    $fields[] = $field;       
                }
            }elseif (!empty($where) && !empty($conditions)) {
                foreach ($conditions as $condition) {
                    if (in_array($condition, $where)) {
                        $fields[] = $field;
                        break;
                    }
                }
            }else{
                $fields[] = $field;    
            }
        }
        $data = in_array($action, ['view', 'rp_view']) ? ['rowspan' => $rowspan, 'field_shows' => $fields] : $fields;
    }
}