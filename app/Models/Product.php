<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    class Product extends Model
    {
        protected $table = 'products';
        protected $protectFields = false;
        static $childTable = ['papers', 'supplies', 'fill_finishes'];
        const SUPPLY_FIELDS = [
            [
                'name' => 'name',
                'note' => 'Tên',
                'type' => 'text' 
            ],
            [
                'name' => 'product_qty',
                'note' => 'Số lượng',
                'type' => 'text', 
                
            ],
            [
                'name' => 'supp_qty',
                'note' => 'Số lượng vật tư',
                'type' => 'text', 
                
            ],
            [
                'name' => 'created_by',
                'note' => 'Tạo bởi',
                'type' => 'linking', 
                'other_data' => '{
                    "config":{
                        "search":1
                    },
                    "data":{
                        "table":"n_users"
                    }
                }'
                
            ], 
            [
                'name' => 'created_at',
                'note' => 'Tạo lúc',
                'type' => 'datetime', 
                
            ],
        ];
    }

?>