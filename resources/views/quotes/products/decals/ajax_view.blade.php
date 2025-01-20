<div class="quote_supp_item decal_module {{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @php
        $key_supp = \TDConst::DECAL;
        $decal_compen_percent = (float) getDataConfig('QuoteConfig', 'DECAL_COMPEN_PERCENT');
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $decal_plus = \TDConst::DECAL_SIZE_PLUS;
        $key_device_cut = \TDConst::CUT;
        $data_cut = !empty($supply_obj->cut) ? json_decode($supply_obj->cut, true) : []; 
    @endphp

    @if (empty($rework))
        @include('quotes.products.supplies.check_index_data')
    @endif

    @include('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'])

    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $decal_compen_percent])

    <div class="{{ !empty($rework) ? 'd-none' : '' }}">
       @include('quotes.products.select_supply_type', ['key_supp' => $key_supp, 'pro_index' => $pro_index, 'supp_index' => $supp_index, 'key_stage' => 'size', 'key_type' => $key_supp, 'value' => @$supply_size])

        @include('quotes.products.select_device', 
        ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
        'value' => @$data_cut['machine'] ?? getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])
        @include('quotes.products.note_field', ['key_supp' => $key_supp])
    </div>
</div>