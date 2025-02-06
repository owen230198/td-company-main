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

    static function insertData($data_rework)
    {
        
        $data_rework['status'] = \StatusConst::NOT_ACCEPTED;
        $data_rework['rework_status'] = Product::NEED_REWORK;
        (new \BaseService)->configBaseDataAction($data_rework);
        $insert_id = CRework::insertGetId($data_rework);
        self::getInsertCode($insert_id);
        logActionUserData('insert', 'c_reworks', $insert_id);
    }

    static function getInsertCode($id){
        CRework::where('id', $id)->update(['code' => 'RW-'.formatCodeInsert($id)]);
    }
}
