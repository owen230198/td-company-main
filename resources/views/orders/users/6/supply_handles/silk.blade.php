@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::SILK;
        $silk_divide = \TDConst::SILK_SIZE_DIVIDE;
        $silk_compen_percent = (float) getDataConfig('QuoteConfig', 'SILK_COMPEN_PERCENT');
        $silk_plus = \TDConst::SILK_SIZE_PLUS;
        $base_need = getBaseNeedQtySquareSupply($supply_obj->supp_qty, $supply_size);
        $disable_all = 1;
        $bigger_width = getBigerWidthSize($supply_size);
    @endphp
    
    @include('quotes.products.supplies.title_config', ['divide' => $silk_divide, 'name' => 'vải lụa'])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $silk_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $silk_plus, 'divide' => $silk_divide])

    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nhung theo yêu cầu</span>
    </h3>

    @include('orders.users.6.supply_handles.view_handles.multiple', 
        [
            'arr_items' => [
                'key_supp' => \TDConst::SILK, 
                'note' => 'Vải lụa', 
                'supp_price' => $supply_size['materal'],
                'qtv' => $supply_size['qtv'],
                'base_need' =>  $base_need,
                'product_qty' => $supply_obj->product_qty,
                'over_supply' => true
            ],
            'sug_buying' => [
                'target' => $supply_size['materal'],
                'qtv' => $supply_size['qtv'],
                'width' => $bigger_width
            ],
            'type' => \TDConst::FIX_WIDTH
        ])
@endsection