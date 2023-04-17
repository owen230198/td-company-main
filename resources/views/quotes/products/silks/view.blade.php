<div class="mb-2 paper_product_config">
    @php
        $silk_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;;
        $silk_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
        $silk_divide = \App\Constants\TDConstant::SILK_SIZE_DIVIDE;
    @endphp
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <p class="mb-1">{{ $pindex == 0 ? 'Phần vật tư lụa' : 'Vật tư silk thêm '.$pindex }}</p>
        <p class="mb-1">Kích thước tấm lụa là {{ $silk_divide[0] }} x {{ $silk_divide[1] }}cm</p>
    </h3>
    
    <div class="quantity_paper_module quantity_supply_module" data-percent = {{ $silk_compen_percent }} data-num = {{ $silk_compen_num }}>
        @php
            $pro_silk_qty = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'value' => @$pro_qty,
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        @endphp
        @include('view_update.view', $pro_silk_qty)

        @php
            $pro_silk_nqty = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][nqty]',
                'note' => 'Số bát',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        @endphp
        @include('view_update.view', $pro_silk_nqty)
        
        @php
            $pro_silk_qty = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][silk_qty]',
                'note' => 'Tổng SL vật tư',
                'value' => @$pro_qty,
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        @endphp
        <div class="d-flex align-items-center">
            @include('view_update.view', $pro_silk_qty)
            <span class="ml-1 color_gray"> x {{ $silk_compen_percent }} % + {{ $silk_compen_num }} BH</span>
        </div> 
    </div>

    @php
        $silk_plus = \App\Constants\TDConstant::SILK_SIZE_PLUS; 
    @endphp
    <div class="calc_size_module" data-plus = {{ $silk_plus }} data-divide = {{ $silk_divide[0] }}>
        @php
            $pro_silk_temp_length = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][size][temp_length]',
                'note' => 'KT chiều dài sơ bộ',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT(cm)', 'inject_class' => 'temp_size_length'],
            ] 
        @endphp
        <div class="d-flex alig-items-center">
            @include('view_update.view', $pro_silk_temp_length)
            <span class="ml-1 color_gray mt-1"> + {{ $silk_plus }}cm</span>
        </div>

        @php
            $pro_silk_length = [
                'name' => 'product['.$j.'][silk]['.$pindex.'][size][length]',
                'note' => 'KT chiều dài tối ưu',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Đơn vị cm', 'inject_class' => 'otm_size_length'],
            ] 
        @endphp
        @include('view_update.view', $pro_silk_length)
    </div>

    @php
        $pro_silk_width = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ];
    @endphp
    <div class="d-flex">
        @include('view_update.view', $pro_silk_width)
        <span class="ml-1 color_gray mt-1"> + {{ $silk_plus }}cm BH</span>
    </div>

    @php
        $pro_silk_supply = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][supply_type]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supply_type', 'where' => ['type' => \App\Constants\TDConstant::SILK_SUPP]]]
        ] 
    @endphp
    @include('view_update.view', $pro_silk_supply)

    @php
        $pro_silk_ext_price = [
            'name' => 'product['.$j.'][silk]['.$pindex.'][prescript_price]',
            'note' => 'Phát sinh giá lụa cao cấp',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
    @endphp
    <div class="d-flex align-items-center">
        @include('view_update.view', $pro_silk_ext_price)
        <span class="ml-1 color_gray">Giá cho 1 sản phẩm</span>
    </div> 

    @php
        $key_device_cut = \App\Constants\TDConstant::CUT;
    @endphp
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 'value' => getDeviceIdByKey($key_device_cut), 'element' => 'silk'])
</div>