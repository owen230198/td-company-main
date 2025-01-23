@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::CARTON;
        $carton_divide = \TDConst::CARTON_SIZE_DIVIDE;
        $carton_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
        $carton_plus = \TDConst::CARTON_SIZE_PLUS;
        $disable_all = true;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $carton_divide, 'name' => $key_supp])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $carton_compen_percent])

   @include('quotes.products.select_supply_type', 
    [
        'key_supp' => $key_supp, 
        'pro_index' => $pro_index, 
        'supp_index' => $supp_index, 
        'key_stage' => 'size', 
        'key_type' => $key_supp, 
        'value' => @$supply_size
    ])
    
    @include('orders.users.6.supply_handles.handle', ['compen_percent' => $carton_compen_percent])
@endsection