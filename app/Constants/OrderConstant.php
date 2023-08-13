<?php
namespace App\Constants;
use \App\Models\Order;
use \App\Models\CSupply;
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
            'table' => 'orders', 
            'text' => 'Đơn chờ duyệt thiết kế', 
            'status' => Order::NOT_ACCEPTED 
        ], 
        [
            'icon' => 'c_designs', 
            'table' => 'c_designs', 
            'text' => 'Lệnh thiết kế', 
            'status' => Order::NOT_ACCEPTED 
        ],
        [
            'icon' => 'tech', 
            'table' => 'orders', 
            'text' => 'Đơn cần xử lí kỹ thuật', 
            'status' => Order::DESIGN_SUBMITED
        ],
        [
            'icon' => 'c_processes', 
            'table' => 'orders', 
            'text' => 'Đơn cần duyệt sản xuất', 
            'status' => Order::TECH_SUBMITED
        ],
        ['icon' => 'exsupp', 
        'table' => 'c_supplies', 
        'text' => 'Yêu cầu xuất vật tư',
        'status' => CSupply::HANDLING
        ],
        ['icon' => 'export', 'table' => 'c_prints', 'text' => 'Yêu cầu xuất khuôn'],
        ['icon' => 'imbox', 
        'table' => 'supply_warehouses', 
        'text' => 'Yêu cầu nhập kho băng lề vật tư',
        'status' => SupplyWarehouse::WAITING
        ],
        ['icon' => 'imsupp', 
        'table' => 'print_warehouses', 
        'text' => 'Yêu cầu nhập kho băng lề giấy in',
        'status' => SupplyWarehouse::WAITING
        ],
    ];
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