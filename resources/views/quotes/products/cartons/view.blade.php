<div class="mb-2 paper_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>{{ $pindex == 0 ? 'Phần vật tư carton' : 'Vật tư carton thêm '.$pindex }}</span>
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
        <div class="d-flex align-items-center">
            @include('view_update.view', $pro_carton_qty)
            <span class="ml-1 color_gray"> x {{ $carton_compen_percent }} % + {{ $carton_compen_num }} BH</span>
        </div> 
    </div>
    @php
        $pro_carton_length = [
            'name' => 'product['.$j.'][carton]['.$pindex.'][size][length]',
            'note' => 'Kích thước chiều dài',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Mặc định 100cm'],
        ] 
    @endphp
    <div class="d-flex align-items-center">
        @include('view_update.view', $pro_carton_length)
        <span class="ml-1 color_gray">Kích thước tấm carton là 100cm x 120cm</span>
    </div> 

    @php
        $pro_carton_width = [
            'name' => 'product['.$j.'][carton]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
];
        $carton_width_plus = \App\Constants\TDConstant::CARTON_SIZE_WIDTH_PLUS; 
    @endphp
    <div class="d-flex align-items-center">
        @include('view_update.view', $pro_carton_width)
        <span class="ml-1 color_gray"> + {{ $carton_width_plus }}cm BH</span>
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
    @endphp
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => 'carton'])
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 'value' => getDeviceIdByKey($key_device_peel), 'element' => 'carton'])
</div>