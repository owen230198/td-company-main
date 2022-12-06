<?php

namespace App\Constants;

class VariableConstant
{
    const BASE_ROLE = [
        'view'=> 1,
        'insert'=> 1,
        'update'=> 1,
        'remove'=> 1,
        'view_my'=> 1,
        'update_my'=> 1,
        'remove_my'=> 1
    ];
    const CONFIG_TABLE_ROLE = ['view'=> 1, 'update'=> 1]; 
    const CONFIG_TABLE = ['q_configs', 'n_roles'];
    const ROLE_SELF_TABLE = ['order', 'c_designs', 'c_processes'];

    const ROLE_TITLE = [
        'view'=>'Xem toàn bộ',
        'insert'=>'Thêm dữ liệu',
        'update'=>'Sửa dữ liệu',
        'remove'=>'Xóa dữ liệu',
        'view_my'=>'Xem dữ liệu của mình',
        'update_my'=>'Sửa dữ liệu của mình',
        'remove_my'=>'Xóa dữ liệu của mình',
        'acept'=>'Duyệt dữ liệu',
        'receive'=>'Tiếp nhận'
    ];

    //Self action table 
    const ACTION_TABLE_SELF = ['orders', 'products'];

    //Action name
    const ACTION_INSERT = 'insert';
    const ACTION_UPDATE = 'update';
}
