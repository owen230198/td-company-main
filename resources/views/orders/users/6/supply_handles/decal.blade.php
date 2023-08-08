@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::DECAL;
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $decal_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $decal_plus = \TDConst::DECAL_SIZE_PLUS;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'])
    
    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $decal_compen_percent])
    
    @include('quotes.products.supplies.size_config', ['plus' => $decal_plus, 'divide' => $decal_divide])
    
    @include('quotes.products.supplies.select_supply_type')
    
    @include('orders.users.6.supply_handles.handle', ['compen_percent' => $decal_compen_percent])
@endsection