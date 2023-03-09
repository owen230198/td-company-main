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
    public function getModuleByGroupUser($group_user_id, $menu = 1)
    {
        $where = ['n_group_user_id' => $group_user_id, 'act'=>1];
        if($menu == 1){
            $where['menu'] = 1;
        }
		$roleModule = $this->where($where)->join('n_modules',
		'n_modules.id', '=', 'n_roles.module_id')->get();
        $data = $roleModule->filter(function($item){
            $roleItem = json_decode($item['json_data_role'], true);
            return @$roleItem['view']==1 || @$roleItem['view_my']==1
            || @$roleItem['update']==1 || @$roleItem['update_my']==1
            || @$roleItem['accept']==1 || @$roleItem['receive']==1;
        });
        return $data->values()->all();
    }

    public function getPermissionAction($index="*", $table, $group_user_id)
    {
        $data = $this->where('n_roles.n_group_user_id', $group_user_id)
        ->join('n_modules','n_modules.id', '=', 'n_roles.module_id')
        ->where('n_modules.table_map', $table)->select($index)->first();
        return $data;
    }
}
