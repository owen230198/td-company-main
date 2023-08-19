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
            // [
            //     'name' => 'name',
            //     'note' => 'Tên',
            //     'type' => 'text' 
            // ],
            [
                'name' => 'product_qty',
                'note' => 'Số lượng sp',
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
                'other_data' => ['role_update' => [\GroupUser::SALE]] 
            ],
            'sale_shape_file' =>
            [
                'note' => 'Khuôn kinh doanh tính giá',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::SALE]] 
            ],
            'tech_shape_file' =>
            [
                'note' => 'Khuôn sản xuất (Kỹ thuật)',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::TECH_APPLY]]
            ],
            'design_file' =>
            [
                'note' => 'File gốc (P. Thiết kế)',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::DESIGN]]
            ],
            'design_shape_file' =>
            [
                'note' => 'File bình theo khuôn (P. Thiết kế)',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::DESIGN]]
            ],
            'handle_shape_file' =>
            [
                'note' => 'Khuôn ép nhũ, thúc nổi, in UV',
                'type' => 'file',
                'other_data' => ['role_update' => [\GroupUser::TECH_HANDLE]]
            ]
        ];

        static function getFeildFileByStage($stage)
        {
            $ext_pro_feild_file = self::FEILD_FILE;
            if ((\GroupUser::isSale() && @$stage == Order::NOT_ACCEPTED) || empty($stage)) {
                return [
                    'custom_design_file' => $ext_pro_feild_file['custom_design_file'],
                    'sale_shape_file' => $ext_pro_feild_file['sale_shape_file'],
                ];   
            }elseif (@$stage == Order::NOT_ACCEPTED) {
                return [
                    'sale_shape_file' => $ext_pro_feild_file['sale_shape_file'],
                    'tech_shape_file' => $ext_pro_feild_file['tech_shape_file'],
                ];   
            }elseif (@$stage == Order::TO_DESIGN) {
                unset(
                    $ext_pro_feild_file['sale_shape_file'], 
                    $ext_pro_feild_file['handle_shape_file']
                );    
            }elseif(@$stage == Order::DESIGN_SUBMITED){
                return [
                    'design_shape_file' => $ext_pro_feild_file['design_shape_file'],
                    'handle_shape_file' => $ext_pro_feild_file['handle_shape_file']
                ]; 
            };
            return $ext_pro_feild_file;
        }
    }

?>