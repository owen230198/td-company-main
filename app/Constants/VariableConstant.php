<?php

namespace App\Constants;

class VariableConstant
{
    const BASE_ROLE = ['view'=>'Xem toàn bộ',
                        'insert'=>'Thêm dữ liệu',
                        'update'=>'Sửa dữ liệu',
                        'remove'=>'Xóa dữ liệu',
                        'view_my'=>'Xem dữ liệu của mình',
                        'update_my'=>'Sửa dữ liệu của mình',
                        'remove_my'=>'Xóa dữ liệu của mình'];
    const CONFIG_TABLE = ['q_configs', 'n_roles'];
    const CONFIG_TABLE_ROLE = ['view'=>'Xem dữ liệu',
                                'update'=>'Sửa dữ liệu']; 
    const ROLE_SELF_TABLE = [];

    const ACTION_TABLE_SELF = ['orders'];
}
