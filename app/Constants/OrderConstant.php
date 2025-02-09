<?php
    namespace App\Constants;

    use App\Models\COrder;
    use \App\Models\Order;
    use \App\Models\CSupply;
    use App\Models\SupplyBuying;

    class OrderConstant
    {
        //ORDER PAYMENT STATUS
        const ORD_NOT_PAYMENT = 'not_payment';
        const ORD_ADVANCE_PAYMENT = 'advance_payment';
        const ORD_PAID_PAYMENT = 'paid_payment';
        const ACCEPT_REQURIRED_TABLE = [
            [
                'icon' => 'orders', 
                'table' => 'products', 
                'text' => 'Duyệt thiết kế', 
                'condition' => ['status' => Order::NOT_ACCEPTED],
                'link' => 'view/products?default_data=%7B"status"%3A"'.Order::NOT_ACCEPTED.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::SALE, \GroupUser::TECH_APPLY, \GroupUser::DESIGN] 
            ], 
            [
                'icon' => 'c_designs', 
                'table' => 'c_designs', 
                'text' => 'Lệnh thiết kế', 
                'condition' => ['status' => Order::NOT_ACCEPTED],
                'link' => 'view/c_designs?default_data=%7B"status"%3A"'.Order::NOT_ACCEPTED.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::TECH_APPLY, \GroupUser::DESIGN]
            ],
            [
                'icon' => 'tech', 
                'table' => 'products', 
                'text' => 'Xử lí kỹ thuật', 
                'condition' => ['status' => Order::DESIGN_SUBMITED],
                'link' => 'view/products?default_data=%7B"status"%3A"'.Order::DESIGN_SUBMITED.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::TECH_APPLY, \GroupUser::DESIGN, \GroupUser::TECH_HANDLE]  
            ],
            [
                'icon' => 'print_join', 
                'table' => 'papers', 
                'text' => 'Lệnh in ghép', 
                'condition' => ['status' => Order::TECH_SUBMITED, 'is_join' => 1],
                'link' => 'list-print-joined',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::TECH_APPLY, \GroupUser::DESIGN, \GroupUser::TECH_HANDLE]   
            ],
            [
                'icon' => 'c_processes', 
                'table' => 'products', 
                'text' => 'Duyệt sản xuất', 
                'condition' => ['status' => Order::TECH_SUBMITED],
                'link' => 'view/products?default_data=%7B"status"%3A"'.Order::TECH_SUBMITED.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::TECH_APPLY, \GroupUser::TECH_HANDLE, \GroupUser::PLAN_HANDLE]   
            ],
            [
                'icon' => 'exsupp', 
                'table' => 'c_supplies', 
                'text' => 'Xuất vật tư',
                'condition' => ['status' => CSupply::HANDLING],
                'link' => 'view/c_supplies?default_data=%7B"status"%3A"'.CSupply::HANDLING.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::PLAN_HANDLE, \GroupUser::WAREHOUSE]  
            ],
            [
                'icon' => 'imbox', 
                'table' => 'supply_warehouses', 
                'text' => 'Băng lề vật tư',
                'condition' => ['status' => \StatusConst::WAITING],
                'link' => 'view/supply_warehouses?default_data=%7B"status"%3A"'.\StatusConst::WAITING.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::PLAN_HANDLE, \GroupUser::WAREHOUSE, \GroupUser::ACCOUNTING]  
            ],
            [
                'icon' => 'imsupp', 
                'table' => 'print_warehouses', 
                'text' => 'Băng lề giấy in',
                'condition' => ['status' => \StatusConst::WAITING],
                'link' => 'view/print_warehouses?default_data=%7B"status"%3A"'.\StatusConst::WAITING.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::PLAN_HANDLE, \GroupUser::WAREHOUSE, \GroupUser::ACCOUNTING]  
            ],
            [
                'icon' => 'contact', 
                'table' => 'buying_items', 
                'text' => 'Liên hệ NCC vật tư',
                'condition' => ['status' => \StatusConst::PROCESSING],
                'link' => 'view/buying_items?default_data=%7B"status"%3A"'.\StatusConst::PROCESSING.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::PLAN_HANDLE, \GroupUser::APPLY_BUYING, \GroupUser::DO_BUYING]  
            ],
            [
                'icon' => 'apply_buy', 
                'table' => 'buying_items', 
                'text' => 'Duyệt mua vật tư',
                'condition' => ['status' => \StatusConst::NOT_ACCEPTED],
                'link' => 'view/buying_items?default_data=%7B"status"%3A"'.\StatusConst::NOT_ACCEPTED.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::PLAN_HANDLE, \GroupUser::APPLY_BUYING, \GroupUser::DO_BUYING]  
            ],
            // [
            //     'icon' => 'buy', 
            //     'table' => 'buying_items', 
            //     'text' => 'Mua vật tư',
            //     'condition' => ['status' => \StatusConst::ACCEPTED],
            //     'link' => 'view/buying_items?default_data=%7B"status"%3A"'.\StatusConst::ACCEPTED.'"%7D',
            //     'group_user' => [\GroupUser::ADMIN, \GroupUser::PLAN_HANDLE, \GroupUser::APPLY_BUYING, \GroupUser::DO_BUYING]  
            // ],
            [
                'icon' => 'submit_buy', 
                'table' => 'buying_items', 
                'text' => 'Nhập kho vật tư đã mua',
                'condition' => ['status' => SupplyBuying::BOUGHT],
                'link' => 'view/buying_items?default_data=%7B"status"%3A"'.SupplyBuying::BOUGHT.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::PLAN_HANDLE, \GroupUser::WAREHOUSE, \GroupUser::APPLY_BUYING, \GroupUser::DO_BUYING, \GroupUser::ACCOUNTING]  
            ],
            [
                'icon' => 'after_print', 
                'table' => 'after_prints', 
                'text' => 'KCS sau in',
                'condition' => ['status' => \StatusConst::PROCESSING],
                'link' => 'view/after_prints?default_data=%7B"status"%3A"'.\StatusConst::PROCESSING.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::KCS]  
            ],
            [
                'icon' => 'kcs', 
                'table' => 'c_products', 
                'text' => 'KCS thành phẩm',
                'condition' => ['status' => \StatusConst::PROCESSING],
                'link' => 'view/c_products?default_data=%7B"status"%3A"'.\StatusConst::PROCESSING.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::KCS, \GroupUser::PRODUCT_WAREHOUSE]  
            ],
            [
                'icon' => 'rework', 
                'table' => 'c_reworks', 
                'text' => 'Sản xuất lại sản phẩm',
                'condition' => ['status' => \StatusConst::NOT_ACCEPTED],
                'link' => 'view/c_reworks?default_data=%7B"status"%3A"'.\StatusConst::NOT_ACCEPTED.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::SALE]  
            ],
            [
                'icon' => 'product_waiting', 
                'table' => 'c_expertises', 
                'text' => 'Duyệt nhập kho thành phẩm',
                'condition' => ['status' => \StatusConst::NOT_ACCEPTED],
                'link' => 'view/c_expertises?default_data=%7B"status"%3A"'.\StatusConst::NOT_ACCEPTED.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::KCS, \GroupUser::PRODUCT_WAREHOUSE, \GroupUser::ACCOUNTING]  
            ],
            [
                'icon' => 'product_export', 
                'table' => 'c_orders', 
                'text' => 'Duyệt xuất thành phẩm',
                'condition' => ['status' => \StatusConst::NOT_ACCEPTED],
                'link' => 'view/c_orders?default_data=%7B"status"%3A"'.\StatusConst::NOT_ACCEPTED.'","type"%3A"'.COrder::SELL.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::KCS, \GroupUser::PRODUCT_WAREHOUSE, \GroupUser::ACCOUNTING]  
            ],
            [
                'icon' => 'c_payment', 
                'table' => 'c_payments', 
                'text' => 'Đề xuất chi',
                'condition' => ['status' => \StatusConst::PROCESSING],
                'link' => 'view/c_payments?default_data=%7B"status"%3A"'.\StatusConst::PROCESSING.'"%7D',
                'group_user' => [\GroupUser::ADMIN, \GroupUser::ACCOUNTING]  
            ]
        ];

        //Kiểu đơn
        const INCLUDE = 'include';
        const SINGLE = 'single';

        //PROCESS STAGE 
        const STAGE_PROCESS = [   
            "crop"=>"Xén Thành Phẩm",
            "soles_size"=>"Kích Thước Đế",
            "finished_size"=>"Khổ Thành Phẩm",
            "roll"=>"Cán Nilon",
            "num_face"=>"Số Mặt Cán",
            "elevated_frame"=>"Khuôn Bế",
            "compress_frame"=>"Khuôn Ép Nhũ",
            "push_frame"=>"Khuôn Thúc Nổi",
            "soles_fill"=>"Đế Bồi",
            "emul_color"=>"Màu Nhũ",
            "soles_roll"=>"Cán Đế",
            "finished_style"=>"Lò xo - nẹp",
            "finished_type"=>"Đóng gói - bỏ thùng",
            "pin"=>"Ghim Lồng",
            "glue"=>"Keo Gáy",
            "elevated"=>"Bế",
            "compress"=>"Ép Nhũ",
            "jump"=>"Số Nhảy",
            "fill"=>"Bồi",
            "stamp"=>"Dập Nổi",
            "grooved"=>"Phay - Sẻ Rãnh",
            "finish"=>"GC Thành Phẩm",
            "fold"=>"Gấp Máy",
            "sew"=>"Khâu Chỉ",
            "sawing"=>"Bế Răng Cưa"
        ];
    }
?>