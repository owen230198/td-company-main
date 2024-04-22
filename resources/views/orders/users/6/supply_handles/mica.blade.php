@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::MICA;
        $mica_divide = \TDConst::MICA_SIZE_DIVIDE;
        $mica_compen_percent = (float) getDataConfig('QuoteConfig', 'MICA_COMPEN_PERCENT');
        $mica_plus = \TDConst::MICA_SIZE_PLUS;
    @endphp
    @include('quotes.products.supplies.check_index_data')
    
    @include('quotes.products.supplies.title_config', ['divide' => $mica_divide, 'name' => 'vải lụa'])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $mica_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $mica_plus, 'divide' => $mica_divide])

    @include('quotes.products.supplies.select_supply_type')
    
    @include('orders.users.6.supply_handles.handle', ['compen_percent' => $mica_compen_percent])
@endsection