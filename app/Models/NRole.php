<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class NRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_roles';
    protected $protectFields = false;
    static $roleSelf = ['view'=>'Xem dữ liệu', 'update'=>'Sửa dữ liệu'];
    public function getModuleByGroupUser($group_user_id)
    {
		$roleModule = $this->where('n_group_user_id', $group_user_id)->join('n_modules',
		'n_modules.id', '=', 'n_roles.module_id')->get();
        $data = $roleModule->filter(function($item){
            return $item['view']==1||$item['view_my']==1||$item['update']==1||$item['update_my']==1;
        });
        return $data->values()->all();
    }

    public function getPermissionAction($index="*", $table, $group_user_id)
    {
        $data = $this->where('n_roles.n_group_user_id', $group_user_id)->join('n_modules','n_modules.id', '=', 'n_roles.module_id')
        ->where('n_modules.table_map', $table)->select($index)->first();
        return $data;
    }
}
