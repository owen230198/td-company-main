<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_roles';
    protected $protectFields = false;

    public function getModuleByGroupUser($group_user_id)
    {
		$data = $this->where('view', 1)->where('n_group_user_id', $group_user_id)->join('n_modules', 
		'n_modules.id', '=', 'n_roles.module_id')->get()->toArray();
        return $data;
    }

    public function getPermissionAction($index="*", $table, $group_user_id)
    {
        $data = $this->where('view', 1)->where('n_group_user_id', $group_user_id)->join('n_modules', 
        'n_modules.id', '=', 'n_roles.module_id')->where('n_modules.table_map', $table)->select($index)->first();
        return $data;
    }
}