@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::RUBBER;
        $rubber_divide = \TDConst::RUBBER_SIZE_DIVIDE;
        $rubber_compen_percent = (float) getDataConfig('QuoteConfig', 'RUBBER_COMPEN_PERCENT');
        $rubber_plus = \TDConst::RUBBER_SIZE_PLUS;
        $disable_all = true;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $rubber_divide, 'name' => 'Cao su'])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $rubber_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $rubber_plus, 'divide' => $rubber_divide])

    @include('quotes.products.supplies.select_supply_type')
    
    @include('orders.users.6.supply_handles.handle', ['compen_percent' => $rubber_compen_percent])
@endsection