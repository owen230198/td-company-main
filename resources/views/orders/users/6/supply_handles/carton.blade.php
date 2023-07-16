@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::CARTON;
        $carton_divide = \TDConst::CARTON_SIZE_DIVIDE;
        $carton_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $carton_plus = \TDConst::CARTON_SIZE_PLUS;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $carton_divide, 'name' => $key_supp])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $carton_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $carton_plus, 'divide' => $carton_divide])

    @include('quotes.products.supplies.select_supply_type')
    @php
        $where = [
                    'type' => $key_supp, 
                    'supp_type' => @$supply_size['supply_type'],
                    'supp_price' => @$supply_size['supply_price'],
                    'status' => 'imported'
                ];
    @endphp
    @include('orders.users.6.supply_handles.handle', ['compen_percent' => $carton_compen_percent, 'where_size_type' => $where])
@endsection