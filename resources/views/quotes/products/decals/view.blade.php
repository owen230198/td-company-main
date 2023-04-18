<div class="mb-2 paper_product_config decal_module">
    @php
        $key_supp = \App\Constants\TDConstant::DECAL;
        $decal_divide = \App\Constants\TDConstant::DECAL_SIZE_DIVIDE;
        $pro_decal_qty = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][qty]',
            'note' => 'Số lượng',
            'value' => @$pro_qty,
            'attr' => ['type_input' => 'number', 'required' => 1]
        ];

        $arr_option = \App\Constants\TDConstant::SELECT_SUPP_LINK;
        array_push($arr_option, 'Khác');
        $pro_decal_nqty = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][nqty]',
            'note' => 'Số bát',
            'type' => 'select',
            'attr' => ['inject_class' => 'select_decal_nqty'],
            'other_data' => ['data' => ['options' => $arr_option]]
        ];
        $pro_decal_qty_supp = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][supp_qty]',
            'note' => 'Tổng SL vật tư',
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ];
        $pro_decal_length_supp = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][size][length]',
            'note' => 'Kích thước chiều dài',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ];

        $pro_decal_width_supp = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        ];
        $pro_decal_supply = [
            'name' => 'product['.$j.']['.$key_supp.']['.$pindex.'][supply_price]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supply_prices', 'where' => ['type' => $key_supp]]]
        ];
        $key_device_cut = \App\Constants\TDConstant::CUT;
    @endphp
    
    @include('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'])
    
    @include('view_update.view', $pro_decal_qty)

    @include('view_update.view', $pro_decal_nqty)
    
    @include('view_update.view', $pro_decal_qty_supp) 
    
   <div class="module_decal_size" style="display: none">
        @include('view_update.view', $pro_decal_length_supp) 

        @include('view_update.view', $pro_decal_width_supp) 
   </div>

    @include('view_update.view', $pro_decal_supply)

    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 
    'value' =>  getDeviceId(['key_device' => $key_device_cut, 'supply' => $key_supp, 'default_device' => 1]), 'element' => $key_supp])
</div>