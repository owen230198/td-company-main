@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::SILK;
        $silk_divide = \TDConst::SILK_SIZE_DIVIDE;
        $silk_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $silk_plus = \TDConst::SILK_SIZE_PLUS;
        $pro_silk_supply = [
            'name' => '',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'value' => @$supply_size['supply_price'],
            'other_data' => ['config' => ['search' => 1],
            'data' => ['table' => 'materals', 'where' => ['type' => $key_supp]]]
        ];
        $silk_chose_supp = [
            'name' => 'c_supply[supp_price]',
            'type' => 'linking',
            'note' => 'Chọn lụa trong kho',
            'value' => '',
            'other_data' => [
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'square_warehouses', 
                    'where' => ['type' => $key_supp,
                                'supp_price' => @$supply_size['supply_price'],
                                'status' => 'imported']
                ]
            ]
        ]
    @endphp
    
    @include('quotes.products.supplies.title_config', ['divide' => $silk_divide, 'name' => 'vải lụa'])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $silk_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $silk_plus, 'divide' => $silk_divide])

    @include('view_update.view', $pro_silk_supply)

    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nhung theo yêu cầu</span>
    </h3>

    @include('view_update.view', $silk_chose_supp)

@endsection