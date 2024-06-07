@include('print_data.header', ['title' => 'Lệnh sản xuất - Bồi hộp'])
    <div class="handle_content_print mt-4">
        <p class="d-flex align-items-center mb-2">
            <span class="w_60 d-block">Tên hàng</span> 
            <span class="font_bold ml-1">: {{ getFieldDataById('name', 'products', $data_item->product) }}</span>
        </p>   
    </div>
    <div class="mt-3 row row-10">
        @php
            $fill = !empty($data_item->fill) ? json_decode($data_item->fill, true) : [];
        @endphp
        
        @if (!empty($fill['stage']) && is_array($fill['stage']))
            @foreach ($fill['stage'] as $fill_stage)
                @include('print_data.info_item', 
                ['name' => str_replace('CHI PHÍ', '', getFieldDataById('name', 'materals', $fill_stage['materal'])), 
                'info' =>  getFieldDataById('name', 'devices', $fill_stage['machine']). '- KT :' .$fill_stage['length'] .' x '.  $fill_stage['width']])
            @endforeach   
        @endif
    </div>

    <div class="print_print_data_content mt-4 pt-4 border_top_dashed">
        @include('print_data.header', ['title' => 'Lệnh sản xuất - Hoàn thiện cuối'])
        <div class="handle_content_print mt-4">
            <p class="d-flex align-items-center mb-2">
                <span class="w_60 d-block">Tên hàng</span> 
                <span class="font_bold ml-1">: {{ getFieldDataById('name', 'products', $data_item->product) }}</span>
            </p>   
        </div>
        <div class="mt-3 row row-10">
            @php
                $finish = !empty($data_item->finish) ? json_decode($data_item->finish, true) : [];
            @endphp
            
            @if (!empty($finish['stage']) && is_array($finish['stage']))
                @foreach ($finish['stage'] as $finish_stage)
                    @include('print_data.info_item', ['name' => getFieldDataById('name', 'devices', $finish_stage['materal']), 'info' => 'Có'])
                @endforeach   
            @endif
            @include('print_data.info_item', ['name' => 'SL thành phẩm', 'info' => $data_item->product_qty])
        </div>
    </div>