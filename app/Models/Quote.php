<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quotes';
    protected $protectFields = false;
    static $tableChild = array('q_papers', 'q_cartons', 'q_foams', 'q_silks', 'q_finishes');
    static $roleSelf = ['view'=>'Xem dữ liệu', 'insert'=>'Thêm dữ liệu', 'update'=>'Sửa dữ liệu'];
}
