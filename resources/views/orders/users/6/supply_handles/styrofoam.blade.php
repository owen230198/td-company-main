@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::STYRO;
        $styro_divide = \TDConst::STYRO_SIZE_DIVIDE;
        $styro_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $styro_plus = \TDConst::STYRO_SIZE_PLUS;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $styro_divide, 'name' => 'Mút xốp'])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $styro_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $styro_plus, 'divide' => $styro_divide])

    @include('quotes.products.supplies.select_supply_type')
    
    @include('orders.users.6.supply_handles.handle', ['compen_percent' => $styro_compen_percent])
@endsection