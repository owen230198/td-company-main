<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BaseReceipt extends Model
{
    protected $table = 'base_receipts';
    protected $protectFields = false;
    static function getInsertCode($id)
    {
        BaseReceipt::where(['id' => $id])->update(['code' => 'CK'.sprintf("%08s", $id)]);
    }

    static function insertWithHardData($receipt_code, $receipt)
    {
        $data['name'] = 'Chuyển kho thành phẩm: '.date('d/m/Y H:i', Time()); 
        $data['note'] = $data['name'];
        $data['hard_code'] = $receipt_code;
        $data['hard_file'] = $receipt;
        (new \BaseService())->configBaseDataAction($data);
        $id = BaseReceipt::insertGetId($data);
        BaseReceipt::getInsertCode($id);
        return $id;
    }

    static function getRole()
    {
        $role = [
            \GroupUser::ACCOUNTING => [
                'view' => 1,
            ],
        ];
        return !empty($role[\GroupUser::getCurrent()]) ? $role[\GroupUser::getCurrent()] : [];
    }
}
