@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::DECAL;
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $decal_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $pro_decal_qty = [
            'name' => '',
            'note' => 'Số lượng',
            'value' => !empty($supply_obj->id) ? @$supply_obj->product_qty : @$pro_qty,
            'attr' => ['type_input' => 'number', 'required' => 1]
        ];

        $arr_option = \TDConst::SELECT_SUPP_LINK;
        array_push($arr_option, 'Khác');
        $pro_decal_nqty = [
            'name' => '',
            'note' => 'Số bát',
            'type' => 'select',
            'attr' => ['inject_class' => 'select_decal_nqty'],
            'value' => @$supply_obj->nqty,
            'other_data' => ['data' => ['options' => $arr_option]]
        ];
        $pro_decal_qty_supp = [
            'name' => '',
            'note' => 'Tổng SL vật tư link từ',
            'type' => 'select',
            'value' => @$supply_obj->supp_qty_linking,
            'other_data' => ['data' => ['options' => \TDConst::SELECT_SUPP_LINK]]
        ];
        $pro_decal_length_supp = [
            'name' => '',
            'note' => 'Kích thước chiều dài',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
            'value' => @$supply_size['length']
        ];

        $pro_decal_width_supp = [
            'name' => '',
            'note' => 'Kích thước chiều rộng',
            'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
            'value' => @$supply_size['width']
        ];
        $pro_decal_supply = [
            'name' => '',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'value' => @$supply_size['supply_price'],
            'other_data' => ['config' => ['search' => 1],
            'data' => ['table' => 'supply_prices', 'where' => ['type' => $key_supp]]]
        ];
    @endphp
    @include('quotes.products.supplies.check_index_data')

    @include('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'])

    @include('view_update.view', $pro_decal_qty)

    @include('view_update.view', $pro_decal_nqty)

    @include('view_update.view', $pro_decal_qty_supp) 

    <div class="module_decal_size" style="display: {{ @$supply_obj->nqty == 1 ? 'block' : 'none' }}">
        @include('view_update.view', $pro_decal_length_supp) 

        @include('view_update.view', $pro_decal_width_supp) 
    </div>

    @include('view_update.view', $pro_decal_supply)
    @php
        $where = [
                    'type' => $key_supp,
                    'supp_price' => @$supply_size['supply_price'],
                    'status' => 'imported'
                ]
    @endphp
    @include('orders.users.6.supply_handles.handle', ['compen_percent' => $decal_compen_percent, 'where_size_type' => $where])
@endsection