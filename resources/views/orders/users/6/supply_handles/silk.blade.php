@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::SILK;
        $silk_divide = \TDConst::SILK_SIZE_DIVIDE;
        $silk_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $silk_plus = \TDConst::SILK_SIZE_PLUS;
    @endphp
    
    @include('quotes.products.supplies.title_config', ['divide' => $silk_divide, 'name' => 'vải lụa'])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $silk_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $silk_plus, 'divide' => $silk_divide])

    @include('quotes.products.supplies.select_supply_type')
    
    @include('orders.users.6.supply_handles.handle', ['compen_percent' => $silk_compen_percent])
@endsection