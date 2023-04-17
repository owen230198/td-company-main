<div class="mb-2 paper_product_config">
    @php
        $mica_divide = \App\Constants\TDConstant::MICA_SIZE_DIVIDE;
        $mica_compen_percent = 0;
        $mica_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
    @endphp
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <p class="mb-1">{{ $pindex == 0 ? 'Phần vật tư mica' : 'Vật tư mica thêm '.$pindex }}</p>
        <p class="mb-1">Kích thước tấm mica là {{ $mica_divide[0] }} x {{ $mica_divide[1] }}cm</p>
    </h3>
    
    <div class="quantity_paper_module" data-percent = {{ $mica_compen_percent }} data-num = {{ $mica_compen_num }}>
        @php
            $pro_mica_qty = [
                'name' => 'product['.$j.'][mica]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'value' => @$pro_qty,
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        @endphp
        @include('view_update.view', $pro_mica_qty)

        @php
            $pro_mica_nqty = [
                'name' => 'product['.$j.'][mica]['.$pindex.'][nqty]',
                'note' => 'Số bát/tờ in',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        @endphp
        @include('view_update.view', $pro_mica_nqty)
        
        @php
            $pro_mica_qty = [
                'name' => 'product['.$j.'][mica]['.$pindex.'][mica_qty]',
                'note' => 'Số lượng vật tư',
                'value' => @$pro_qty,
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        @endphp
        <div class="d-flex align-items-center">
            @include('view_update.view', $pro_mica_qty)
            <span class="ml-1 color_gray">+ {{ $mica_compen_num }} BH</span>
        </div> 
    </div>

    @php
        $mica_plus = \App\Constants\TDConstant::MICA_SIZE_PLUS; 
    @endphp
    <div class="calc_size_module" data-plus = {{ $mica_plus }} data-divide = {{ $mica_divide[0] }}>
        @php
            $pro_mica_temp_length = [
                'name' => 'product['.$j.'][mica]['.$pindex.'][size][temp_length]',
                'note' => 'KT chiều dài sơ bộ',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT(cm)', 'inject_class' => 'temp_size_length'],
            ] 
        @endphp
        <div class="d-flex alig-items-center">
            @include('view_update.view', $pro_mica_temp_length)
            <span class="ml-1 color_gray mt-1"> + {{ $mica_plus }}cm</span>
        </div>

        @php
            $pro_mica_length = [
                'name' => 'product['.$j.'][mica]['.$pindex.'][size][length]',
                'note' => 'KT chiều dài tối ưu',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Đơn vị cm', 'inject_class' => 'otm_size_length'],
            ] 
        @endphp
        @include('view_update.view', $pro_mica_length)
    </div>
    
    @php
        $pro_mica_width = [
            'name' => 'product['.$j.'][mica]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ];
    @endphp
    <div class="d-flex">
        @include('view_update.view', $pro_mica_width)
        <span class="ml-1 color_gray mt-1"> + {{ $mica_plus }}cm BH</span>
    </div>

    @php
        $pro_mica_supply = [
            'name' => 'product['.$j.'][mica]['.$pindex.'][supply_type]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supply_type', 'where' => ['type' => \App\Constants\TDConstant::MICA_SUPP]]]
        ] 
    @endphp
    @include('view_update.view', $pro_mica_supply)

    @php
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
        $key_device_cut = \App\Constants\TDConstant::CUT;
    @endphp
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 'value' => getDeviceIdByKey($key_device_cut), 'element' => 'mica'])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => 'mica'])

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Máy bóc lề', 'value' => getDeviceIdByKey($key_device_peel), 'element' => 'mica'])
</div>