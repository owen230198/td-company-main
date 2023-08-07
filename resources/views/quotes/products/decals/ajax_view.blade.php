<div class="quote_supp_item decal_module {{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @php
        $key_supp = \TDConst::DECAL;
        $decal_compen_percent = (float) getDataConfig('QuoteConfig', 'SILK_COMPEN_PERCENT');
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $decal_plus = \TDConst::DECAL_SIZE_PLUS;
        // $pro_decal_supply = [
        //     'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][supply_price]',
        //     'type' => 'linking',
        //     'note' => 'Chọn vật tư',
        //     'value' => @$supply_size['supply_price'],
        //     'other_data' => ['config' => ['search' => 1],
        //     'data' => ['table' => 'supply_prices', 'where' => ['type' => $key_supp]]]
        // ];
        $key_device_cut = \TDConst::CUT;
        $data_cut = !empty($supply_obj->cut) ? json_decode($supply_obj->cut, true) : []; 
    @endphp

    @include('quotes.products.supplies.check_index_data')

    @include('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'])

    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $decal_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $decal_plus, 'divide' => $decal_divide])

    @include('quotes.products.supplies.select_supply_type')

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' => !empty($supply_obj->id) ? @$data_cut['machine'] : getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])
    @include('quotes.products.note_field', ['key_supp' => $key_supp])
</div>