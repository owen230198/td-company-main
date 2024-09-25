<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CProduct extends Model
{
    protected $table = 'c_products';
    protected $protectFields = false;
    protected $guarded = [];
    static function getRole()
    {
        $role = [
            \GroupUser::KCS => [
                'view' => 
                [
                    'with' => ['key' => 'status', 'value' => \StatusConst::PROCESSING],
                ],
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }

    static function getInsertCode($id)
    {
        CProduct::where(['id' => $id])->update(['code' => 'KCS-'.sprintf("%08s", $id)]);
    }
}
