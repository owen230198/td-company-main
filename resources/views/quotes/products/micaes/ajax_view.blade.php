<div class="quote_supp_item {{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @php
        $key_supp = \TDConst::MICA;
        $mica_divide = \TDConst::MICA_SIZE_DIVIDE;
        $mica_compen_percent = 0;
        $mica_compen_num = \TDConst::CARTON_COMPEN_NUM;
        $mica_plus = \TDConst::MICA_SIZE_PLUS; 
        $pro_mica_supply = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][supply_price]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supply_prices', 'where' => ['type' => $key_supp]]]
        ];
        $key_device_elevate = \TDConst::ELEVATE;
        $key_device_peel = \TDConst::PEEL;
        $key_device_cut = \TDConst::CUT;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $mica_divide, 'name' => 'mica'])
    
    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $mica_compen_percent, 'compen_num' => $mica_compen_num])

    @include('quotes.products.supplies.size_config', ['plus' => $mica_plus, 'divide' => $mica_divide])

    @include('view_update.view', $pro_mica_supply)

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' =>  getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 
    'value' =>  getDeviceId(['key_device' => $key_device_elevate, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 
    'value' =>  getDeviceId(['key_device' => $key_device_peel, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])
</div>