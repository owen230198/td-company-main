<div class="mb-2 paper_product_config decal_module">
    @php
        $decal_divide = \App\Constants\TDConstant::DECAL_SIZE_DIVIDE;
    @endphp
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <p class="mb-1">{{ $pindex == 0 ? 'Phần vật tư decal nhung' : 'Vật tư decal nhung thêm '.$pindex }}</p>
        <p class="mb-1">Kích thước tấm decal nhung là {{ $decal_divide[0] }} x {{ $decal_divide[1] }}cm</p>
    </h3>
    @php
        $pro_decal_qty = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][qty]',
            'note' => 'Số lượng',
            'value' => @$pro_qty,
            'attr' => ['type_input' => 'number', 'required' => 1]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_qty)

    @php
        $arr_option = \App\Constants\TDConstant::SELECT_SUPP_LINK;
        array_push($arr_option, 'Khác');
        $pro_decal_nqty = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][nqty]',
            'note' => 'Số bát',
            'type' => 'select',
            'attr' => ['inject_class' => 'select_decal_nqty'],
            'other_data' => ['data' => ['options' => $arr_option]]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_nqty)
    
    @php
        $pro_decal_qty_supp = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][decal_qty]',
            'note' => 'Tổng SL vật tư',
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_qty_supp) 
    
   <div class="module_decal_size" style="display: none">
        @php
            $pro_decal_length_supp = [
                'name' => 'product['.$j.'][decal]['.$pindex.'][size][length]',
                'note' => 'Kích thước chiều dài',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
            ] 
        @endphp
        @include('view_update.view', $pro_decal_length_supp) 

        @php
            $pro_decal_width_supp = [
                'name' => 'product['.$j.'][decal]['.$pindex.'][size][width]',
                'note' => 'Kích thước chiều rộng',
                'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
            ] 
        @endphp
        @include('view_update.view', $pro_decal_width_supp) 
   </div>

    @php
        $pro_decal_supply = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][supply_type]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supply_type', 'where' => ['type' => \App\Constants\TDConstant::DECAL_SUPP]]]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_supply)

    @php
        $key_device_cut = \App\Constants\TDConstant::CUT;
    @endphp
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_cut, 'note' => 'Máy xén', 'value' => getDeviceIdByKey($key_device_cut), 'element' => 'decal'])
</div>