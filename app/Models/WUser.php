<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WUser extends Model
{
    protected $table = 'w_users';
    protected $protectField = false;
    static function getCurrent($field = '')
    {
        $user_login = !empty(session('worker_login')['user']) ? session('worker_login')['user'] : [];
        return !empty($field) && !empty($user_login[$field]) ? $user_login[$field] : $user_login;
    }

    static function getGroupUserFields()
    {
        $data = NDetailTable::where(['table_map' => 'w_salaries', 'name' => 'group_user'])->get();
        NDetailTable::handleField($data, 'insert');
        $ret = processArrField($data[0]);
        return $ret;
    }
}
