<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NModule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_modules';
    protected $protectFields = false;

    public function getParentbyModule($menus)
    {
        $arr_parents = array();
        foreach($menus as $menu){
            $parent = $this->find(@$menu['parent'])->toArray();
            if ($parent && !in_array($parent, $arr_parents)) {
                array_push($arr_parents, $parent);
            }
        }
        return $arr_parents;
    }
}