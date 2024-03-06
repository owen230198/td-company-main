<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $protectFields = false;

    static function getInsertCode()
    {
        return 'DTSX-'.getCodeInsertTable('partners');
    } 
}
