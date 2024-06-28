@include('print_data.header', ['title' => 'Lệnh sản xuất - Giấy in'])
    <div class="handle_content_print mt-4">
        <p class="d-flex align-items-center mb-2"><span class="w_66 d-block">Tên hàng</span> <span class="font_bold ml-1">: {{ $data_item->name }}</span></p>   
    </div>
    <div class="mt-3 row row-10">
        @php
            $stages = \TDConst::COMMAND_STAGE;
        @endphp
        @include('print_data.list_stage', ['stages' => $stages, 'data_item' => $data_item])
    </div>

    <div class="print_print_data_content mt-4 pt-4 border_top_dashed">
        @include('print_data.header', ['title' => 'lệnh In - vật tư giấy'])
        <div class="handle_content_print mt-4">
            <p class="d-flex align-items-center mb-2"><span class="w_66 d-block">Tên hàng</span> <span class="font_bold ml-1">: {{ $data_item->name }}</span></p>   
        </div>
        <div class="mt-3 row row-10">
            @php
                $print = !empty($data_item->nilon) ? json_decode($data_item->print, true) : [];
                $size = !empty($data_item->size) ? json_decode($data_item->size, true) : [];
            @endphp

            @include('print_data.info_item', ['name' => 'Kiểu in', 'info' =>  @\TDConst::PRINT_TYPE[$print['type']]]) 

            @include('print_data.info_item', ['name' => 'Số màu in', 'info' => @\TDConst::PRINT_COLOR[$print['color']]])

            @include('print_data.info_item', ['name' => 'Công nghệ in', 'info' => @\TDConst::PRINT_TECH[$print['machine']]])
            
            @if (!empty($size['materal']))
                @include('print_data.info_item', ['name' => 'Chất liệu giấy', 'info' => getFieldDataById('name', 'materals', $size['materal'])])
            @endif 

            @include('print_data.info_item', ['name' => 'Định lượng', 'info' => $size['qttv']])

            @include('print_data.info_item', ['name' => 'Khổ giấy', 'info' => $size['length'] .' x ' . $size['width']])

            @include('print_data.info_item', ['name' => 'Số lượng cần lấy', 'info' => $data_item->supp_qty])

            @if (!empty($print['note']))
                @include('print_data.note', ['note' => $print['note']])
            @endif
        </div>
    </div>