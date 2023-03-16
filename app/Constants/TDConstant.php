<?php
    namespace App\Constants;
    class TDConstant
    {
        //kiểu in
        const ONE_PRINT_TYPE = 1;
        const SELF_PRINT_TYPE = 2;
        const FLIP_PRINT_TYPE = 3;
        const OTHER_PRINT_TYPE = 4;
        const PRINT_TYPE = [
            'Chọn kiểu in',
            self::ONE_PRINT_TYPE => 'In 1 mặt',
            self::SELF_PRINT_TYPE => 'In nó trở nó',
            self::FLIP_PRINT_TYPE => 'In nó trở lật',
            self::OTHER_PRINT_TYPE => 'In Nó trở khác'
        ];

        //số màu in
        const APLA_PRINT_COLOR = 'apla_print_color';
        const PRINT_COLOR = ['Chọn số màu in', 1, 2, 3, 4, 5, 6, self::APLA_PRINT_COLOR => 'In áp la 1 mặt'];

        //Yêu cầu thợ in
        const DESIGN_PRINT_REQ = 1;
        const OLD_PRINT_REQ = 2;
        const CUSTOM_PRINT_REQ = 3;
        const CUSTOM_COLOR_PRINT_REQ = 4;
        const PRINT_REQUIRED = [
            'Yêu cầu thợ in',
            self::DESIGN_PRINT_REQ => 'Theo file thiết kế',
            self::OLD_PRINT_REQ => 'Theo mẫu cũ',
            self::CUSTOM_PRINT_REQ => 'Theo mẫu khách',
            self::CUSTOM_COLOR_PRINT_REQ => 'Khách duyệt màu'
        ];

        //Công nghệ in
        const OFFSET_PRINT_TECH = 1;
        const OFFSET_UV_PRINT_TECH = 2;
        const LABEL_PRINT_TECH = 3;
        const KTS_PRINT_TECH = 4;
        const PRINT_TECH = [
            'Chọn công nghệ in',
            self::OFFSET_PRINT_TECH => 'In offset',
            self::OFFSET_UV_PRINT_TECH => 'In offset uv',
            self::LABEL_PRINT_TECH => 'In Label',
            self::KTS_PRINT_TECH => 'In KTS'
        ];

        //công đoạn sản xuất
        const PRINT = 'print';
        const NILON = 'nilon';
        const METALAI = 'metalai';
        const COMPRESS = 'compress';
        const FLOAT = 'float';
        const UV = 'uv';
        const ELEVATE = 'elevate';
        const PEEL = 'peel';
        const BOX_PASTE = 'box_paste'; 
        const TEMP_EXT = 'temp_ext';
        const OTHER_EXT = 'other_ext';
        const HANDLE_STAGE = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in',],
            ['key' => self::NILON, 'note' => 'Cán nilon'],
            ['key' => self::METALAI, 'note' => 'Cán metalai'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ'],
            ['key' => self::FLOAT, 'note' => 'Thúc nổi'],
            ['key' => self::UV, 'note' => 'In lưới UV'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế'],
            ['key' => self::PEEL, 'note' => 'Máy bóc lề'],
            ['key' => self::BOX_PASTE, 'note' => 'Máy dán hộp giấy'],
            ['key' => self::TEMP_EXT, 'note' => 'Phát sinh tem, toa'],
            ['key' => self::OTHER_EXT, 'note' => 'Phát sinh vật tư khác']
        ]; 

        const SIDE_LID = 1;
        const SIDE_BOTTOM = 2;
        const SIDE_HALF_BOTTOM = 3;
        const PRO_SIZE_SIDE = [
            'Chọn KT hông nắp + đáy',
            self::SIDE_LID => 'Hông cạnh nắp',
            self::SIDE_BOTTOM => 'Hông cạnh đáy',
            self::SIDE_HALF_BOTTOM => 'Hông cạnh đáy 1/2'
        ];
    }
    
?>