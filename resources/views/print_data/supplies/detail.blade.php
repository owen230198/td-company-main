@include('print_data.header', ['title' => 'Lệnh sản xuất - '. getTextSupply($data_item->type)])
    <div class="handle_content_print mt-4">
        <p class="d-flex align-items-center mb-2">
            <span class="w_66 d-block">Tên hàng</span> 
            <span class="font_bold ml-1">: {{ getFieldDataById('name', 'products', $data_item->product) }}</span>
        </p>   
    </div>
    <div class="mt-3 row row-10">
        @php
            $stages = \TDConst::COMMAND_STAGE_SUPPLY;
        @endphp
        @include('print_data.list_stage', ['stages' => $stages, 'data_item' => $data_item])

        @if (!empty($data_item->note))
            @include('print_data.info_item', ['name' => 'Ghi chú', 'info' =>  $data_item->note])
        @endif 
        @php
            $size = !empty($data_item->size) ? json_decode($data_item->size, true) : [];
            $supp_name = '';
            if (!empty($size['supply_type'])) {
                $supp_name .= getFieldDataById('name', 'supply_types', $size['supply_type']).' - DL : ';
                $supp_name .= getFieldDataById('name', 'supply_prices', $size['supply_price']);
            }else{
                $supp_name .= getFieldDataById('name', 'materals', $size['supply_price']);
            }
        @endphp

        @include('print_data.info_item', ['name' => 'Loại vật tư', 'info' => $supp_name])

        @include('print_data.info_item', ['name' => 'Khổ vật tư', 'info' => $size['length'] .' x ' . $size['width']])

        @include('print_data.info_item', ['name' => 'Số lượng cần lấy', 'info' => $data_item->supp_qty])
    </div>