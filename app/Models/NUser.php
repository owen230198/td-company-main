<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class NUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'n_users';
    protected $protectFields = false;
    static $table_group = 'n_group_users';

    const ROLE_TECH_APPLY = 'apply_design';
    const ROLE_TECH_DESIGN = 'design';
    const ROLE_TECH_HANDLE = 'tech_handle';

    static function getCurrent($field = '')
    {
        $user_login = !empty(session('user_login')['user']) ? session('user_login')['user'] : [];
        return !empty($field) && !empty($user_login[$field]) ? $user_login[$field] : $user_login;
    }

    static function getSupplyRole(){
        $user = getDetailDataByID('NUser', self::getCurrent('id'));
        return !empty($user['supply_role']) ? json_decode($user['supply_role'], true) : [];
    }

    static function getExtRole(){
        $user = getDetailDataByID('NUser', self::getCurrent('id'));
        return !empty($user['ext_role']) ? json_decode($user['ext_role'], true) : [];
    }
}