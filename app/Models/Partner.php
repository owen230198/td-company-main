<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $protectFields = false;

    static function getInsertCode($id)
    {
        Partner::where(['id' => $id])->update(['code' => 'DTSX-'.sprintf("%08s", $id)]);
    }
}
