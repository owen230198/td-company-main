@include('print_data.header', ['title' => 'Lệnh sản xuất - Bồi hộp'])
    <div class="handle_content_print mt-4">
        <p class="d-flex align-items-center mb-2">
            <span class="w_60 d-block">Tên hàng</span> 
            <span class="font_bold ml-1">: {{ getFieldDataById('name', 'products', $data_item->product) }}</span>
        </p>   
    </div>
    <div class="mt-3">
        @php
            $fill = !empty($data_item->fill) ? json_decode($data_item->fill, true) : [];
        @endphp
        
        @if (!empty($fill['stage']) && is_array($fill['stage']))
            @foreach ($fill['stage'] as $fill_stage)
                <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    <span class="w_220 d-block">{{ str_replace('CHI PHÍ', '', getFieldDataById('name', 'materals', $fill_stage['materal'])) }}</span> 
                    <span class="ml-1 text-lowercase">: {{ getFieldDataById('name', 'devices', $fill_stage['machine']) }} - KT : {{ $fill_stage['length'] .' x '.  $fill_stage['width'] }}</span>
                </p> 
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
        <div class="mt-3">
            @php
                $finish = !empty($data_item->finish) ? json_decode($data_item->finish, true) : [];
            @endphp
            
            @if (!empty($finish['stage']) && is_array($finish['stage']))
                @foreach ($finish['stage'] as $finish_stage)
                    <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                        <span class="w_220 d-block">{{ getFieldDataById('name', 'devices', $finish_stage['materal']) }}</span> 
                        <span class="ml-1 text-lowercase">: Có </span>
                    </p> 
                @endforeach   
            @endif
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_220 d-block">SL sản phẩm</span> 
                <span class="ml-1 text-lowercase">: {{ $data_item->product_qty }} </span>
            </p> 
        </div>
    </div>