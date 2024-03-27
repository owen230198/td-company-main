<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AfterPrint extends Model
{
    protected $table = 'after_prints';
    protected $protectFields = false;
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
}
