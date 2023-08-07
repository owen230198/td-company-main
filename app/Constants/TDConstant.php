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
        const SIZE = 'size';
        const PRINT = 'print';
        const NILON = 'nilon';
        const METALAI = 'metalai';
        const COVER = 'cover';
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
        const FOLD = 'fold';
        const HANDLE_STAGE = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in', 'color' => 'normal'],
            ['key' => self::NILON, 'note' => 'Cán nilon', 'color' => 'normal'],
            ['key' => self::METALAI, 'note' => 'Cán metalai', 'color' => 'red'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ', 'color' => 'red'],
            ['key' => self::UV, 'note' => 'In lưới UV', 'color' => 'red'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế', 'color' => 'normal'],
            ['key' => self::PEEL, 'note' => 'Máy bóc lề', 'color' => 'normal'],
            ['key' => self::BOX_PASTE, 'note' => 'Máy dán hộp giấy', 'color' => 'normal'],
            ['key' => self::EXT_PRICE, 'note' => 'Phát sinh', 'color' => 'red']
        ];
        
        const HANDLE_STAGE_HARD = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in', 'color' => 'normal'],
            ['key' => self::NILON, 'note' => 'Cán nilon', 'color' => 'normal'],
            ['key' => self::METALAI, 'note' => 'Cán metalai', 'color' => 'red'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ', 'color' => 'red'],
            ['key' => self::UV, 'note' => 'In lưới UV', 'color' => 'red'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế', 'color' => 'normal'],
            ['key' => self::FLOAT, 'note' => 'Thúc nổi carton', 'color' => 'red'],
            ['key' => self::PEEL, 'note' => 'Máy bóc lề', 'color' => 'normal'],
            ['key' => self::EXT_PRICE, 'note' => 'Phát sinh', 'color' => 'red']
        ];

        const HANDLE_STAGE_BAG = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in', 'color' => 'normal'],
            ['key' => self::NILON, 'note' => 'Cán nilon', 'color' => 'normal'],
            ['key' => self::METALAI, 'note' => 'Cán metalai', 'color' => 'red'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ', 'color' => 'red'],
            ['key' => self::UV, 'note' => 'In lưới UV', 'color' => 'red'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế', 'color' => 'normal'],
            ['key' => self::PEEL, 'note' => 'Máy bóc lề', 'color' => 'normal'],
            ['key' => self::BAG_PASTE, 'note' => 'Máy dán túi giấy', 'color' => 'normal'],
            ['key' => self::EXT_PRICE, 'note' => 'Phát sinh', 'color' => 'red']
        ];

        const HANDLE_STAGE_STAMP = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in', 'color' => 'normal'],
            ['key' => self::NILON, 'note' => 'Cán nilon', 'color' => 'normal'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ', 'color' => 'red'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế', 'color' => 'normal'],
            ['key' => self::CUT, 'note' => 'Máy xén', 'color' => 'normal'],
            ['key' => self::EXT_PRICE, 'note' => 'Phát sinh', 'color' => 'red']
        ];

        const HANDLE_STAGE_LABEL = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in', 'color' => 'normal'],
            ['key' => self::NILON, 'note' => 'Cán nilon', 'color' => 'normal'],
            ['key' => self::METALAI, 'note' => 'Cán metalai', 'color' => 'red'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ', 'color' => 'red'],
            ['key' => self::UV, 'note' => 'In lưới UV', 'color' => 'red'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế', 'color' => 'normal'],
            ['key' => self::PEEL, 'note' => 'Máy bóc lề', 'color' => 'normal'],
            ['key' => self::EXT_PRICE, 'note' => 'Phát sinh', 'color' => 'red']
        ];

        const HANDLE_STAGE_LEAFLET = [
            ['key' => self::PRINT, 'note' => 'Quy cách - kiểu in', 'color' => 'normal'],
            ['key' => self::NILON, 'note' => 'Cán nilon', 'color' => 'normal'],
            ['key' => self::METALAI, 'note' => 'Cán metalai', 'color' => 'red'],
            ['key' => self::COMPRESS, 'note' => 'Ép nhũ', 'color' => 'red'],
            ['key' => self::UV, 'note' => 'In lưới UV', 'color' => 'red'],
            ['key' => self::ELEVATE, 'note' => 'Máy bế', 'color' => 'normal'],
            ['key' => self::PEEL, 'note' => 'Máy bóc lề', 'color' => 'normal'],
            ['key' => self::FOLD, 'note' => 'Máy gấp vạch', 'color' => 'normal'],
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
        const CARTON_SIZE_PLUS = 1;
        const RUBBER_SIZE_PLUS = 2;
        const STYRO_SIZE_PLUS = 2;
        const SILK_SIZE_PLUS = 2;
        const DECAL_SIZE_PLUS = 2;
        const MICA_SIZE_PLUS = 2;
        const CARTON_SIZE_DIVIDE = [100, 120];
        const RUBBER_SIZE_DIVIDE = [125, 250];
        const SILK_SIZE_DIVIDE = [150, 3000];
        const STYRO_SIZE_DIVIDE = [160, 200];
        const DECAL_SIZE_DIVIDE = [150, 3000];
        const MICA_SIZE_DIVIDE = [160, 1000];

        const SELECT_SUPP_LINK = [0 => 'Chọn vật tư link', 'carton' => 'Vật tư carton', 'rubber' => 'Vật tư cao su non'];

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
                                self::METALAI => 'Máy cán metalai',
                                self::COMPRESS => 'Máy ép nhũ',
                                self::UV => 'Máy in UV',
                                self::ELEVATE => 'Máy bế',
                                self::PEEL => 'Máy bóc lề',
                                self::BOX_PASTE => 'Máy dán hộp giấy',
                                self::BAG_PASTE => 'Máy dán túi giấy',
                                self::MILL => 'Máy xén'
                            ];

        const PAPER_HARD_DEVICE = [
                                self::PRINT => 'Máy in',
                                self::NILON => 'Máy cán màng',
                                self::METALAI => 'Máy cán metalai',
                                self::COMPRESS => 'Máy ép nhũ',
                                self::UV => 'Máy in UV',
                                self::ELEVATE => 'Máy bế',
                                self::FLOAT => 'Máy thúc nổi carton',
                                self::PEEL => 'Máy bóc lề',
                                self::BOX_PASTE => 'Máy dán hộp giấy',
                                self::BAG_PASTE => 'Máy dán túi giấy',
                                self::CUT => 'Máy xén',
                                self::FOLD => 'Máy gấp vạch'
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
        const FILL_DEVICE = [
                                self::FILL => 'Thiết bị máy bồi',
                                self::FINISH => 'Công đoạn hoàn thiện'
                            ];

        const ALL_DEVICE_KEY = self::PAPER_HARD_DEVICE + self::FILL_DEVICE;

        const FILL_FINISH_STAGE = [
            self::FILL => 'Bồi',
            self::FINISH => 'Hoàn thiện',
            self::MAGNET => 'vật tư nam châm'
        ];

        const MATERAL_SUPPLY_TYPE = [
            self::PAPER => [
                ['key' => self::PAPER, 'name' => 'Tên phụ giấy in', 'table' => 'paper_extends'],
                ['key' => self::PAPER, 'name' => 'Chất liệu giấy', 'table' => 'materals'],
                ['key' => self::NILON, 'name' => 'Chất liệu cán nilon', 'table' => 'materals'],
                ['key' => self::METALAI, 'name' => 'Chất liệu cán metalai', 'table' => 'materals'],
                ['key' => self::COVER, 'name' => 'Chất liệu cán phủ trên', 'table' => 'materals'],
                ['key' => self::UV, 'name' => 'Mực in UV', 'table' => 'materals']
            ],
            self::CARTON => [
                ['key' => self::CARTON, 'name' => 'Nhà cung cấp', 'table' => 'supply_types', 'is_name' => 0],
                ['key' => self::CARTON, 'name' => 'DS nhà cung cấp carton', 'table' => 'supply_types', 'is_name' => 1]    
            ],
            self::RUBBER => [
                ['key' => self::RUBBER, 'name' => 'DS nhà cung cấp', 'table' => 'supply_types', 'is_name' => 0]   
            ],
            self::STYRO => [
                ['key' => self::STYRO, 'name' => 'DS nhà cung cấp', 'table' => 'supply_types', 'is_name' => 0]   
            ],
            self::DECAL => [
                ['key' => self::DECAL, 'name' => 'DS nhà cung cấp', 'table' => 'supply_types', 'is_name' => 0]   
            ],
            self::SILK => [
                ['key' => self::SILK, 'name' => 'DS nhà cung cấp', 'table' => 'supply_types', 'is_name' => 0]   
            ],
            self::MICA => [
                ['key' => self::MICA, 'name' => 'DS nhà cung cấp', 'table' => 'supply_types', 'is_name' => 0]   
            ],
            self::FILL_FINISH => [
                ['key' => self::FILL, 'name' => 'Loại giấy bồi', 'table' => 'supply_prices'],
                ['key' => self::MAGNET, 'name' => 'Vật tư nam châm', 'table' => 'supply_prices'],     
            ]
        ];

        //Cấu tạo sản phẩm
        const PAPER_ELEMENT = [['key' => 'papers', 'note' => 'Giấy in', 'pro_field' => self::PAPER, 'device' => self::PAPER_DEVICE ,'table' => 'papers']];
        const HARD_ELEMENT = [
            ['key' => 'papers', 'note' => 'Giấy in', 'pro_field' => self::PAPER, 'device' => self::PAPER_HARD_DEVICE ,'table' => 'papers'],
            ['key' => 'cartons', 'note' => 'Carton', 'pro_field' => self::CARTON, 'device' => self::CARTON_DEVICE ,'table' => 'supplies'],
            ['key' => 'rubbers', 'note' => 'Cao su non', 'pro_field' => self::RUBBER, 'device' => self::RUBBER_DEVICE ,'table' => 'supplies'],
            ['key' => 'styrofoams', 'note' => 'Mút phẳng', 'pro_field' => self::STYRO, 'device' => self::STYRO_DEVICE ,'table' => 'supplies'],
            ['key' => 'decals', 'note' => 'Đề can nhung', 'pro_field' => self::DECAL, 'device' => self::DECAL_DEVICE ,'table' => 'supplies'],
            ['key' => 'silks', 'note' => 'Vải lụa', 'pro_field' => self::SILK, 'device' => self::SILK_DEVICE ,'table' => 'supplies'],
            ['key' => 'micaes', 'note' => 'Me Ka', 'pro_field' => self::MICA, 'device' => self::MICA_DEVICE ,'table' => 'supplies'],
            ['key' => 'fill_finishes', 'note' => 'Bồi + hoàn thiện', 'pro_field' => self::FILL_FINISH, 'table' => 'fill_finishes', 'device' => self::FILL_DEVICE] 
        ];

        // flow xử lí 
        const QUOTE_FLOW = 1;
        const ORDER_ACTION_FLOW = 2;
        const ORDER_APLLY_FLOW = 3;
        const ORDER_DESIGN_FLOW = 4;
    }
    
?>