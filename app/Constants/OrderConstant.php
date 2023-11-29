<?php
namespace App\Constants;
use \App\Models\Order;
use \App\Models\CSupply;
use App\Models\SupplyBuying;
use App\Models\SupplyWarehouse;

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
            'text' => 'Đơn chờ duyệt thiết kế', 
            'condition' => ['status' => Order::NOT_ACCEPTED],
            'link' => 'view/products?default_data=%7B"status"%3A"'.Order::NOT_ACCEPTED.'"%7D' 
        ], 
        [
            'icon' => 'c_designs', 
            'table' => 'c_designs', 
            'text' => 'Lệnh thiết kế', 
            'condition' => ['status' => Order::NOT_ACCEPTED],
            'link' => 'view/c_designs?default_data=%7B"status"%3A"'.Order::NOT_ACCEPTED.'"%7D'  
        ],
        [
            'icon' => 'tech', 
            'table' => 'products', 
            'text' => 'Đơn cần xử lí kỹ thuật', 
            'condition' => ['status' => Order::DESIGN_SUBMITED],
            'link' => 'view/products?default_data=%7B"status"%3A"'.Order::DESIGN_SUBMITED.'"%7D' 
        ],
        [
            'icon' => 'c_processes', 
            'table' => 'products', 
            'text' => 'Đơn cần duyệt sản xuất', 
            'condition' => ['status' => Order::TECH_SUBMITED],
            'link' => 'view/products?default_data=%7B"status"%3A"'.Order::TECH_SUBMITED.'"%7D' 
        ],
        [
            'icon' => 'exsupp', 
            'table' => 'c_supplies', 
            'text' => 'Yêu cầu xuất vật tư',
            'condition' => ['status' => CSupply::HANDLING],
            'link' => 'view/products?default_data=%7B"status"%3A"'.Order::TECH_SUBMITED.'"%7D' 
        ],
        // [
        //     'icon' => 'export', 
        //     'table' => 'c_prints', 
        //     'text' => 'Yêu cầu xuất khuôn'
        // ],
        [
            'icon' => 'imbox', 
            'table' => 'supply_warehouses', 
            'text' => 'Yêu cầu nhập kho băng lề vật tư',
            'condition' => ['status' => SupplyWarehouse::WAITING],
            'link' => 'view/supply_warehouses?default_data=%7B"status"%3A"'.SupplyWarehouse::WAITING.'"%7D' 
        ],
        [
            'icon' => 'imsupp', 
            'table' => 'print_warehouses', 
            'text' => 'Yêu cầu nhập kho băng lề giấy in',
            'condition' => ['status' => SupplyWarehouse::WAITING],
            'link' => 'view/print_warehouses?default_data=%7B"status"%3A"'.SupplyWarehouse::WAITING.'"%7D' 
        ],
        [
            'icon' => 'apply_buy', 
            'table' => 'supply_buyings', 
            'text' => 'Yêu cầu duyệt mua vật tư',
            'condition' => ['status' => \StatusConst::NOT_ACCEPTED],
            'link' => 'view/supply_buyings?default_data=%7B"status"%3A"'.\StatusConst::NOT_ACCEPTED.'"%7D' 
        ],
        [
            'icon' => 'buy', 
            'table' => 'supply_buyings', 
            'text' => 'Yêu cầu mua vật tư',
            'condition' => ['status' => \StatusConst::ACCEPTED],
            'link' => 'view/supply_buyings?default_data=%7B"status"%3A"'.\StatusConst::ACCEPTED.'"%7D' 
        ],
        [
            'icon' => 'submit_buy', 
            'table' => 'supply_buyings', 
            'text' => 'Yêu cầu nhập kho vật tư đã mua',
            'condition' => ['status' => SupplyBuying::BOUGHT],
            'link' => 'view/supply_buyings?default_data=%7B"status"%3A"'.SupplyBuying::BOUGHT.'"%7D' 
        ],
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