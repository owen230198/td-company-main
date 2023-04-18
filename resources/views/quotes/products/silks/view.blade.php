<div class="mb-2 paper_product_config">
    @php
        $key_supp = \App\Constants\TDConstant::SILK;
        $silk_compen_percent = \App\Constants\TDConstant::CARTON_COMPEN_PERCENT;;
        $silk_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
        $silk_divide = \App\Constants\TDConstant::SILK_SIZE_DIVIDE;
        $silk_plus = \App\Constants\TDConstant::SILK_SIZE_PLUS; 
        $pro_silk_supply = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][supply_price]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supply_prices', 'where' => ['type' => $key_supp]]]
        ];
        $pro_silk_ext_price = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][prescript_price]',
            'note' => 'Phát sinh giá lụa cao cấp',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ];
        $key_device_cut = \App\Constants\TDConstant::CUT;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $silk_divide, 'name' => 'vải lụa'])
    
    @include('quotes.products.supplies.quantity_config', 
    ['compen_percent' => $silk_compen_percent, 'compen_num' => $silk_compen_num])

    @include('quotes.products.supplies.size_config', ['plus' => $silk_plus, 'divide' => $silk_divide])

    @include('view_update.view', $pro_silk_supply)

    <div class="d-flex align-items-center">
        @include('view_update.view', $pro_silk_ext_price)
        <span class="ml-1 color_gray">Giá cho 1 sản phẩm</span>
    </div> 

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' =>  getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])
</div>