<div class="quote_supp_item {{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @php
        $key_supp = \TDConst::CARTON;
        $carton_divide = \TDConst::CARTON_SIZE_DIVIDE;
        $carton_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $carton_plus = \TDConst::CARTON_SIZE_PLUS;
        $key_device_elevate = \TDConst::ELEVATE;
        $key_device_peel = \TDConst::PEEL;
        $key_device_cut = \TDConst::CUT;
        $key_device_mill = \TDConst::MILL; 
        $pro_supply_name = [
            'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][name]',
            'type' => 'linking',
            'note' => 'Chọn loại vật tư',
            'attr' => ['required' => 1, 'readonly' => !empty($rework)],
            'value' => @$supply_obj->name,
            'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'supply_names', 'where' => ['type' => $key_supp]]]
        ];
    @endphp

    @if (empty($rework))
        @include('quotes.products.supplies.check_index_data')
    @endif

    @include('quotes.products.supplies.title_config', ['divide' => $carton_divide, 'name' => $key_supp])

    @include('view_update.view', $pro_supply_name)
    
    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $carton_compen_percent])

    <div class="{{ !empty($rework) ? 'd-none' : '' }}">
        @include('quotes.products.supplies.size_config', ['plus' => $carton_plus, 'divide' => $carton_divide])

        @include('quotes.products.supplies.select_supply_type')

        @php
            $data_cut = !empty($supply_obj->cut) ? json_decode($supply_obj->cut, true) : []; 
            $data_elevate = !empty($supply_obj->elevate) ? json_decode($supply_obj->elevate, true) : []; 
            $data_mill = !empty($supply_obj->mill) ? json_decode($supply_obj->mill, true) : []; 
            $data_peel = !empty($supply_obj->peel) ? json_decode($supply_obj->peel, true) : []; 
        @endphp
        @include('quotes.products.select_device', 
        ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
        'value' => !empty($supply_obj->id) ? @$data_cut['machine'] : getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 
        'element' => $key_supp])

        @include('quotes.products.select_device', 
        ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 
        'value' => !empty($supply_obj->id) ? @$data_elevate['machine'] : getDeviceId(['key_device' => $key_device_elevate, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

        @include('quotes.products.select_device', 
        ['key_device' => $key_device_mill, 'note' => 'Máy phay', 
        'value' => !empty($supply_obj->id) ? @$data_mill['machine'] : getDeviceId(['key_device' => $key_device_mill, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

        @include('quotes.products.select_device', 
        ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 
        'value' => !empty($supply_obj->id) ? @$data_peel['machine'] : getDeviceId(['key_device' => $key_device_peel, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

        @include('quotes.products.note_field')
    </div>
</div>