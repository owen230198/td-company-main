<?php  
namespace App\Constants;
class NameConstant
{
	// QUOTE GROUP PRODUCT AUTH CONST
    const HARDBOX = 'hard_group';
    const PAPER = 'paper_group';
    const OTHER = 'other_group';

    //Customer Type
    const OLD_CUSTOMER = 1;
    const NEW_CUSTOMER = 2;

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
}
