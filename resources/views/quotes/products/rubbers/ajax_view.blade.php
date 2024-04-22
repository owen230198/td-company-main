<div class="quote_supp_item {{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @php
        $key_supp = \TDConst::RUBBER;
        $rubber_compen_percent = (float) getDataConfig('QuoteConfig', 'RUBBER_COMPEN_PERCENT');
        $rubber_divide = \TDConst::RUBBER_SIZE_DIVIDE;
        $rubber_plus = \TDConst::RUBBER_SIZE_PLUS; 
        $key_device_elevate = \TDConst::ELEVATE;
        $key_device_peel = \TDConst::PEEL;
        $key_device_cut = \TDConst::CUT;
    @endphp
    @if (empty($rework))
        @include('quotes.products.supplies.check_index_data')
    @endif
    
    @include('quotes.products.supplies.title_config', ['divide' => $rubber_divide, 'name' => 'cao su non'])
    
    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $rubber_compen_percent])
    
    <div class="{{ !empty($rework) ? 'd-none' : '' }}">
        @include('quotes.products.supplies.size_config', ['plus' => $rubber_plus, 'divide' => $rubber_divide])
    
        @include('quotes.products.supplies.select_supply_type')

        @php
            $data_cut = !empty($supply_obj->cut) ? json_decode($supply_obj->cut, true) : []; 
            $data_elevate = !empty($supply_obj->elevate) ? json_decode($supply_obj->elevate, true) : []; 
            $data_peel = !empty($supply_obj->peel) ? json_decode($supply_obj->peel, true) : []; 
        @endphp

        @include('quotes.products.select_device', 
        ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
        'value' => @$data_cut['machine'] ?? getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

        @include('quotes.products.select_device', 
        ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 
        'value' => @$data_elavate['machine'] ?? getDeviceId(['key_device' => $key_device_elevate, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

        @include('quotes.products.select_device', 
        ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 
        'value' => @$data_peel['machine'] ?? getDeviceId(['key_device' => $key_device_peel, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])
        
        @include('quotes.products.note_field', ['key_supp' => $key_supp])
    </div>
</div>