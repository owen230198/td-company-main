<div class="mb-2 paper_product_config">
    @php
        $carton_divide = \App\Constants\TDConstant::CARTON_SIZE_DIVIDE;
    @endphp
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <p class="mb-1">{{ $pindex == 0 ? 'Phần vật tư carton' : 'Vật tư carton thêm '.$pindex }}</p>
        <p class="mb-1">Kích thước tấm carton là {{ $carton_divide[0] }} x {{ $carton_divide[1] }}cm</p>
    </h3>
    @php
        $carton_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;
        $carton_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
    @endphp
    
    <div class="quantity_paper_module" data-percent = {{ $carton_compen_percent }} data-num = {{ $carton_compen_num }}>
        @php
            $pro_carton_qty = [
                'name' => 'product['.$j.'][carton]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        @endphp
        @include('view_update.view', $pro_carton_qty)

        @php
            $pro_carton_nqty = [
                'name' => 'product['.$j.'][carton]['.$pindex.'][nqty]',
                'note' => 'Số bát/tờ in',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        @endphp
        @include('view_update.view', $pro_carton_nqty)
        
        @php
            $pro_carton_qty = [
                'name' => 'product['.$j.'][carton]['.$pindex.'][carton_qty]',
                'note' => 'Tổng SL vật tư',
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input', 'readonly' => 1],
            ] 
        @endphp
        <div class="d-flex">
            @include('view_update.view', $pro_carton_qty)
            <span class="ml-1 color_gray mt-1"> x {{ $carton_compen_percent }} % + {{ $carton_compen_num }} BH</span>
        </div> 
    </div>
    
    @php
        $carton_plus = \App\Constants\TDConstant::CARTON_SIZE_PLUS; 
    @endphp
    <div class="calc_size_module" data-plus = {{ $carton_plus }} data-divide = {{ $carton_divide[0] }}>
        @php
            $pro_carton_temp_length = [
                'name' => 'product['.$j.'][carton]['.$pindex.'][size][temp_length]',
                'note' => 'KT chiều dài sơ bộ',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT(cm)', 'inject_class' => 'temp_size_length'],
            ] 
        @endphp
        <div class="d-flex alig-items-center">
            @include('view_update.view', $pro_carton_temp_length)
            <span class="ml-1 color_gray mt-1"> + {{ $carton_plus }}cm</span>
        </div>

        @php
            $pro_carton_length = [
                'name' => 'product['.$j.'][carton]['.$pindex.'][size][length]',
                'note' => 'KT chiều dài tối ưu',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Đơn vị cm', 'inject_class' => 'otm_size_length'],
            ] 
        @endphp
        @include('view_update.view', $pro_carton_length)
    </div>

    @php
        $pro_carton_width = [
            'name' => 'product['.$j.'][carton]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ];
    @endphp
    <div class="d-flex">
        @include('view_update.view', $pro_carton_width)
        <span class="ml-1 color_gray mt-1"> + {{ $carton_plus }}cm BH</span>
    </div> 

    @php
        $pro_carton_supply = [
            'name' => 'product['.$j.'][carton]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::CARTON_SUPP]]]
        ] 
    @endphp
    @include('view_update.view', $pro_carton_supply)
    @php
        $pro_carton_supply = [
            'name' => 'product['.$j.'][carton]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn định lượng',
            'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
            'other_data' => ['config' => ['search_box' => 1], 'data' => ['table' => 'supply_prices']]
        ] 
    @endphp
    @include('view_update.view', $pro_carton_supply)

    @php
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
        $key_device_cut = \App\Constants\TDConstant::CUT;
        $key_device_mill = \App\Constants\TDConstant::MILL;
    @endphp
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 'value' => getDeviceIdByKey($key_device_cut), 'element' => 'carton'])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => 'carton'])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_mill, 'note' => 'Máy phay', 'value' => getDeviceIdByKey($key_device_mill), 'element' => 'carton'])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 'value' => getDeviceIdByKey($key_device_peel), 'element' => 'carton'])
</div>