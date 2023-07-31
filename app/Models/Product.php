<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\Order;
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

        const FEILD_FILE = [
            'custom_design_file' =>
            [
                'note' => 'File thiết kế khách gửi',
                'type' => 'file',
                'role_update' => [\GroupUser::SALE]
            ],
            'sale_shape_file' =>
            [
                'note' => 'Khuôn kinh doanh tính giá',
                'type' => 'file',
                'role_update' => [\GroupUser::SALE]
            ],
            'tech_shape_file' =>
            [
                'note' => 'Khuôn sản xuất (Kỹ thuật)',
                'type' => 'file'
            ],
            'design_file' =>
            [
                'note' => 'File gốc (P. Thiết kế)',
                'type' => 'file'
            ],
            'design_shape_file' =>
            [
                'note' => 'File bình theo khuôn (P. Thiết kế)',
                'type' => 'file'
            ],
            'handle_shape_file' =>
            [
                'note' => 'Khuôn ép nhũ, thúc nổi, in UV',
                'type' => 'file'
            ]
        ];

        static function getFeildFileByStage($stage)
        {
            $ext_pro_feild_file = self::FEILD_FILE;
            if ((\GroupUser::isSale() && @$stage == Order::NOT_ACCEPTED) || empty($stage)) {
                unset(
                    $ext_pro_feild_file['tech_shape_file'], 
                    $ext_pro_feild_file['design_file'], 
                    $ext_pro_feild_file['design_shape_file'], 
                    $ext_pro_feild_file['handle_shape_file']
                );    
            }elseif (@$stage == Order::NOT_ACCEPTED) {
                unset(
                    $ext_pro_feild_file['custom_design_file'],
                    $ext_pro_feild_file['design_file'], 
                    $ext_pro_feild_file['design_shape_file'], 
                    $ext_pro_feild_file['handle_shape_file']
                );    
            }elseif (\GroupUser::isDesign()) {
                unset(
                    $ext_pro_feild_file['sale_shape_file'], 
                    $ext_pro_feild_file['handle_shape_file']
                );    
            }elseif(\GroupUser::isTechHandle()){
                unset(
                    $ext_pro_feild_file['custom_design_file'],
                    $ext_pro_feild_file['sale_shape_file'], 
                    $ext_pro_feild_file['tech_shape_file'], 
                    $ext_pro_feild_file['design_file']
                );  
            };
            return $ext_pro_feild_file;
        }
    }

?>