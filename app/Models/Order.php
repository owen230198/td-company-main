<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use App\Constants\VariableConstant;
    class Order extends Model
    {
        protected $table = 'orders';
        protected $protectFields = false; 
        const ARR_ROLE =  [
            'view'=> 1,
            'insert'=> 1,
            'update'=> 1,
            'remove'=> 1,
            'view_my'=> 1,
            'update_my'=> 1,
            'remove_my'=> 1,
            'acept'=>1
        ];
    }
    
?>