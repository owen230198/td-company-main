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
        const APLA_PRICE_FACTOR = 1000;
        const APLA_PRICE_PLUS = 100000;
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
        const EXT_PRICE = 'ext_price';
        const MILL = 'mill';
        const CUT = 'cut';
        const BAG_PASTE = 'bag_paste';
        const HANDLE_STAGE = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in', 'color' => 'green'],
            ['key' => self::NILON, 'note' => 'Cán nilon', 'color' => 'green'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế', 'color' => 'green'],
            ['key' => self::PEEL, 'note' => 'Máy bóc lề', 'color' => 'green'],
            ['key' => self::BOX_PASTE, 'note' => 'Máy dán hộp giấy', 'color' => 'green'],
            ['key' => self::METALAI, 'note' => 'Cán metalai', 'color' => 'red'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ', 'color' => 'red'],
            ['key' => self::UV, 'note' => 'In lưới UV', 'color' => 'red'],
            ['key' => self::EXT_PRICE, 'note' => 'Phát sinh', 'color' => 'red']
        ];
        
        const HANDLE_STAGE_HARD = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in', 'color' => 'green'],
            ['key' => self::NILON, 'note' => 'Cán nilon', 'color' => 'green'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế', 'color' => 'green'],
            ['key' => self::PEEL, 'note' => 'Máy bóc lề', 'color' => 'green'],
            ['key' => self::METALAI, 'note' => 'Cán metalai', 'color' => 'red'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ', 'color' => 'red'],
            ['key' => self::FLOAT, 'note' => 'Thúc nổi carton', 'color' => 'red'],
            ['key' => self::UV, 'note' => 'In lưới UV', 'color' => 'red'],
            ['key' => self::EXT_PRICE, 'note' => 'Phát sinh', 'color' => 'red']
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

        // Thông số bù hao
        const COMPEN_PERCENT = 1;
        const CARTON_COMPEN_PERCENT = 1;
        const COMPEN_NUM = 100;
        const CARTON_COMPEN_NUM = 10;
        const CARTON_SIZE_PLUS = 1;
        const RUBBER_SIZE_PLUS = 2;
        const STYRO_SIZE_PLUS = 2;
        const SILK_SIZE_PLUS = 2;
        const MICA_SIZE_PLUS = 2;
        const CARTON_SIZE_DIVIDE = [100, 120];
        const RUBBER_SIZE_DIVIDE = [125, 250];
        const SILK_SIZE_DIVIDE = [150, 3000];
        const STYRO_SIZE_DIVIDE = [160, 200];
        const DECAL_SIZE_DIVIDE = [150, 3000];
        const MICA_SIZE_DIVIDE = [160, 1000];

        const SELECT_SUPP_LINK = [0 => 'Chọn vật tư link', 'carton' => 'Vật tư carton', 'rubber' => 'Vật tư cao su non'];

        //Loại thiết bị
        const AUTO_DEVICE = 1;
        const SEMI_AUTO_DEVICE = 2;

        //Vật tư
        const PAPER = 'paper';
        const CARTON = 'carton';
        const RUBBER = 'rubber';
        const DECAL = 'decal';
        const SILK = 'silk';
        const STYRO = 'styrofoam';
        const MICA = 'mica';
        const FILL_FINISH = 'fill_finish';
        const FILL = 'fill';
        const FINISH = 'finish';
        const MAGNET = 'magnet';

        //Thiết bị máy
        const PAPER_DEVICE = [
                                self::NILON => 'Máy cán màng',
                                self::ELEVATE => 'Máy bế',
                                self::PEEL => 'Máy bóc lề',
                                self::BOX_PASTE => 'Máy dán hộp giấy',
                                self::METALAI => 'Máy cán metalai',
                                self::COMPRESS => 'Máy ép nhũ',
                                self::UV => 'Máy in UV',
                                self::BAG_PASTE => 'Máy dán túi giấy'
                            ];
                            
        const CARTON_DEVICE = [
                                self::CUT => 'Máy xén',
                                self::ELEVATE => 'Máy bế',
                                self::MILL => 'Máy phay',
                                self::PEEL => 'Máy bóc lề'
                            ];

        const RUBBER_DEVICE = [
                                self::CUT => 'Máy xén',
                                self::ELEVATE => 'Máy bế',
                                self::PEEL => 'Máy bóc lề'
                            ];

        const DECAL_DEVICE = [self::CUT => 'Máy xén'];

        const SILK_DEVICE = [self::CUT => 'Máy xén'];

        const STYRO_DEVICE = [
                                self::CUT => 'Máy xén',
                                self::ELEVATE => 'Máy bế',
                                self::PEEL => 'Máy bóc lề'
                            ];

        const MICA_DEVICE = [
                                self::CUT => 'Máy xén',
                                self::ELEVATE => 'Máy bế',
                                self::PEEL => 'Máy bóc lề'
                            ];

        //Cấu tạo sản phẩm
        const HARD_BOX = 1;
        const PAPER_BOX = 2;
        const PAPER_ELEMENT = [['key' => 'papers', 'note' => 'Giấy in']];
        const HARD_ELEMENT = [
            ['key' => 'papers', 'note' => 'Giấy in', 'pro_field' => self::PAPER, 'device' => self::PAPER_DEVICE ,'table' => 'papers'],
            ['key' => 'cartons', 'note' => 'Carton', 'pro_field' => self::CARTON, 'device' => self::CARTON_DEVICE ,'table' => 'supplies'],
            ['key' => 'rubbers', 'note' => 'Cao su non', 'pro_field' => self::RUBBER, 'device' => self::RUBBER_DEVICE ,'table' => 'supplies'],
            ['key' => 'decals', 'note' => 'Đề can nhung', 'pro_field' => self::DECAL, 'device' => self::DECAL_DEVICE ,'table' => 'supplies'],
            ['key' => 'silks', 'note' => 'Vải lụa', 'pro_field' => self::SILK, 'device' => self::SILK_DEVICE ,'table' => 'supplies'],
            ['key' => 'styrofoams', 'note' => 'Mút phẳng', 'pro_field' => self::STYRO, 'device' => self::STYRO_DEVICE ,'table' => 'supplies'],
            ['key' => 'micaes', 'note' => 'Me Ka', 'pro_field' => self::MICA, 'device' => self::MICA_DEVICE ,'table' => 'supplies'],
            ['key' => 'fill_finishes', 'note' => 'Bồi + hoàn thiện', 'pro_field' => self::FILL_FINISH ,'table' => 'fill_finishes'] 
        ];

        const PLUS_PAPER = 100;

        const PRINT_SUBTRACT_PAPER = 1000;
        const PLUS_PAPER_DEVICE = 30;
        const FLOAT_PRICE = 30000;

        const FILL_PRICE = 50000;
        const MAGNET_PERC = 1.5;
    }
    
?>