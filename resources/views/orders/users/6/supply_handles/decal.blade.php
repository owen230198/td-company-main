@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::DECAL;
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $decal_compen_percent = (float) getDataConfig('QuoteConfig', 'DECAL_COMPEN_PERCENT');
        $decal_plus = \TDConst::DECAL_SIZE_PLUS;
        $base_need = getBaseNeedQtySquareSupply($supply_obj->supp_qty, $supply_size);
        $disable_all = 1;
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'])
    
    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $decal_compen_percent])
    
    @include('quotes.products.supplies.size_config', ['plus' => $decal_plus, 'divide' => $decal_divide])

    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nhung theo yêu cầu</span>
    </h3>

    @include('orders.users.6.supply_handles.view_handles.multiple', 
        [
            'arr_items' => [
                'key_supp' => \TDConst::DECAL, 
                'note' => 'đề can nhung', 
                'supp_price' => $supply_size['materal'],
                'base_need' => $base_need,
                'qtv' => $supply_size['qtv'],
            ],
            'type' => \TDConst::FIX_WIDTH
        ])
@endsection