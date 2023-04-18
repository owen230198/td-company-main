<div class="mb-2 paper_product_config">
    @php
        $key_supp = \App\Constants\TDConstant::CARTON;
        $carton_divide = \App\Constants\TDConstant::CARTON_SIZE_DIVIDE;
        $carton_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;
        $carton_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
        $carton_plus = \App\Constants\TDConstant::CARTON_SIZE_PLUS;
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
        $key_device_cut = \App\Constants\TDConstant::CUT;
        $key_device_mill = \App\Constants\TDConstant::MILL; 
    @endphp

    @include('quotes.products.supplies.title_config', ['divide' => $carton_divide, 'name' => $key_supp])
    
    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $carton_compen_percent, 'compen_num' => $carton_compen_num])

    @include('quotes.products.supplies.size_config', ['plus' => $carton_plus, 'divide' => $carton_divide])

    @include('quotes.products.supplies.select_supply_type')

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' =>  getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 
    'value' =>  getDeviceId(['key_device' => $key_device_elevate, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_mill, 'note' => 'Máy phay', 
    'value' =>  getDeviceId(['key_device' => $key_device_mill, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 
    'value' =>  getDeviceId(['key_device' => $key_device_peel, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])
</div>