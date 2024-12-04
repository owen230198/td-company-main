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
        Customer::where(['id' => $id])->update(['code' => 'PCH-'.sprintf("%08s", $id)]);
    }
}
