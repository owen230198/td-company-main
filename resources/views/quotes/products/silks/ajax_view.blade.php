<div class="quote_supp_item {{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @php
        $key_supp = \TDConst::SILK;
        $silk_compen_percent = (float) getDataConfig('QuoteConfig', 'SILK_COMPEN_PERCENT');
        $silk_divide = \TDConst::SILK_SIZE_DIVIDE;
        $silk_plus = \TDConst::SILK_SIZE_PLUS; 
        $key_device_cut = \TDConst::CUT;
        $data_cut = !empty($supply_obj->cut) ? json_decode($supply_obj->cut, true) : []; 
    @endphp
    @if (empty($rework))
        @include('quotes.products.supplies.check_index_data')
    @endif
    
    @include('quotes.products.supplies.title_config', ['divide' => $silk_divide, 'name' => 'vải lụa'])

    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $silk_compen_percent])

    <div class="{{ !empty($rework) ? 'd-none' : '' }}">
       @include('quotes.products.select_supply_type', ['key_supp' => $key_supp, 'pro_index' => $pro_index, 'supp_index' => $supp_index, 'key_stage' => 'size', 'key_type' => $key_supp, 'value' => @$supply_size])

        @include('quotes.products.select_device', 
        ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
        'value' => @$data_cut['machine'] ?? getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])
        @include('quotes.products.note_field', ['key_supp' => $key_supp])
    </div>
</div>