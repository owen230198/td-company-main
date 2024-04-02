<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CRework extends Model
{
    protected $table = 'c_reworks';
    protected $protectFields = false;
    static function getRole()
    {
        $role = [
            \GroupUser::SALE => [
                'view' => 
                [
                    'with' => ['key' => 'status', 'value' => \StatusConst::NOT_ACCEPTED],
                ],
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
}
