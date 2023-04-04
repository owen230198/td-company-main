<div class="mb-2 paper_product_config">
    @php
        $rubber_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;
        $rubber_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
        $rubber_divide = \App\Constants\TDConstant::RUBBER_SIZE_DIVIDE;
    @endphp
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <p class="mb-1">{{ $pindex == 0 ? 'Phần vật tư cao su non' : 'Vật tư cao su non thêm '.$pindex }}</p>
        <p class="mb-1">Kích thước tấm cao su non là {{ $rubber_divide[0] }} x {{ $rubber_divide[1] }}cm</p>
    </h3>
    
    <div class="quantity_paper_module quantity_supply_module" data-percent = {{ $rubber_compen_percent }} data-num = {{ $rubber_compen_num }}>
        @php
            $pro_rubber_qty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        @endphp
        @include('view_update.view', $pro_rubber_qty)

        @php
            $pro_rubber_nqty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][nqty]',
                'note' => 'Số bát',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        @endphp
        @include('view_update.view', $pro_rubber_nqty)
        
        @php
            $pro_rubber_qty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][rubber_qty]',
                'note' => 'Tổng SL vật tư',
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        @endphp
        <div class="d-flex align-items-center">
            @include('view_update.view', $pro_rubber_qty)
            <span class="ml-1 color_gray"> x {{ $rubber_compen_percent }} % + {{ $rubber_compen_num }} BH</span>
        </div> 
    </div>
    
    @php
        $rubber_plus = \App\Constants\TDConstant::RUBBER_SIZE_PLUS; 
    @endphp
    <div class="calc_size_module" data-plus = {{ $rubber_plus }} data-divide = {{ $rubber_divide[0] }}>
        @php
            $pro_rubber_temp_length = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][size][temp_length]',
                'note' => 'KT chiều dài sơ bộ',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT(cm)', 'inject_class' => 'temp_size_length'],
            ] 
        @endphp
        <div class="d-flex alig-items-center">
            @include('view_update.view', $pro_rubber_temp_length)
            <span class="ml-1 color_gray mt-1"> + {{ $rubber_plus }}cm</span>
        </div>

        @php
            $pro_rubber_length = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][size][length]',
                'note' => 'KT chiều dài tối ưu',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Đơn vị cm', 'inject_class' => 'otm_size_length'],
            ] 
        @endphp
        @include('view_update.view', $pro_rubber_length)
    </div>

    @php
        $pro_rubber_width = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ];
    @endphp
    <div class="d-flex">
        @include('view_update.view', $pro_rubber_width)
        <span class="ml-1 color_gray mt-1"> + {{ $rubber_plus }}cm BH</span>
    </div>
    
    @php
        $pro_rubber_supply = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::RUBB_SUPP]]]
        ] 
    @endphp
    @include('view_update.view', $pro_rubber_supply)
    @php
        $pro_rubber_supply = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn định lượng',
            'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
            'other_data' => ['config' => ['search_box' => 1], 'data' => ['table' => 'supply_prices']]
        ] 
    @endphp
    @include('view_update.view', $pro_rubber_supply)

    @php
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
        $key_device_cut = \App\Constants\TDConstant::CUT;
    @endphp
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 'value' => getDeviceIdByKey($key_device_cut), 'element' => 'rubber'])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => 'rubber'])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 'value' => getDeviceIdByKey($key_device_peel), 'element' => 'rubber'])
</div>