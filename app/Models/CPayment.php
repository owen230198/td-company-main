<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CPayment extends Model
{
    protected $table = 'c_payments';
    protected $protectFields = false;

    const GENERAL = 'general';
    const ORDER = 'order';
    const SUPPLIER = 'supplier';
    const PARTNER = 'partner';

    static function getInsertCode($id)
    {
        CPayment::where(['id' => $id])->update(['code' => 'CK-'.sprintf("%08s", $id)]);
    }

    static function beforeInsert(&$data)
    {
        $data['status'] = \StatusConst::PROCESSING;
    }
}
