<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProviderDebt extends Model
{
    protected $table = 'provider_debts';
    protected $protectFields = false;
    protected $guarded = [];

    const DEBT = 'debt';
    const CREDIT = 'credit';

    static function insertData($name, $type, $provider, $arr_supp = [], $advance = 0)
    {
        $insert_debt['name'] = $name;
        $insert_debt['type'] = $type;
        $insert_debt['provider'] = $provider;
        foreach ($arr_supp as $key => $value) {
            $insert_debt[$key] = $value;
        }
        $insert_debt['advance'] = $advance;
        (new \BaseService())->configBaseDataAction($insert_debt);
        $id = ProviderDebt::insertGetId($insert_debt);
        self::getInsertCode($id);
    }

    static function getInsertCode($id)
    {
        ProviderDebt::where(['id' => $id])->update(['code' => 'CNVT-'.sprintf("%08s", $id)]);
    }
}
