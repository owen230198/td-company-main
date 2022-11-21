<?php
namespace App\Constants;
class OrderConstant
{
    const COMMAND_KEY_TABLE = [
        'c_design'=>'c_designs',
        'c_process'=>'c_processes'
    ];
    const CHILD_TABLE_ORDER = ['products', 'c_designs', 'c_processes'];

    // PRODUCT CATEGORY TYPE
    const PRO_CATE_TYPE = [
        'pre_order'=>['name'=>'Hàng đặt'],
        'available'=>[
            'name'=>'Hàng bán sẵn', 
            'child'=>[
                'hard'=>['name'=>'Hộp cứng'],
                'paper'=>['name'=>'Hộp giấy']
            ]
        ]
    ];

    //Order Status
    const ORDER_NOT_ACCEPT = 'not_accept';
    const ORDER_ACCEPTED = 'accepted';

    //ORDER PAYMENT STATUS
    const ORD_NOT_PAYMENT = 'not_payment';
    const ORD_ADVANCE_PAYMENT = 'advance_payment';
    const ORD_PAID_PAYMENT = 'paid_payment';

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
        "finished_style"=>"Thành Phẩm(Lò xo, nẹp,..)",
        "finished_type"=>"Đóng gói hoặc bỏ thùng",
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