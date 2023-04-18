<div class="mb-2 paper_product_config">
    @php
        $key_supp = \App\Constants\TDConstant::RUBBER;
        $rubber_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;
        $rubber_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
        $rubber_divide = \App\Constants\TDConstant::RUBBER_SIZE_DIVIDE;
        $rubber_plus = \App\Constants\TDConstant::RUBBER_SIZE_PLUS; 
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
        $key_device_cut = \App\Constants\TDConstant::CUT;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $rubber_divide, 'name' => 'cao su non'])
    
    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $rubber_compen_percent, 'compen_num' => $rubber_compen_num])
    
    @include('quotes.products.supplies.size_config', ['plus' => $rubber_plus, 'divide' => $rubber_divide])
    
    @include('quotes.products.supplies.select_supply_type')

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 'value' => getDeviceIdByKey($key_device_cut), 'element' => $key_supp])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => $key_supp])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 'value' => getDeviceIdByKey($key_device_peel), 'element' => $key_supp])
</div>