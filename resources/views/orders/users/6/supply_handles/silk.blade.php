@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::SILK;
        $silk_divide = \TDConst::SILK_SIZE_DIVIDE;
        $silk_compen_percent = (float) getDataConfig('QuoteConfig', 'SILK_COMPEN_PERCENT');
        $silk_plus = \TDConst::SILK_SIZE_PLUS;
        $pro_silk_supply = [
            'name' => '',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'value' => @$supply_size['supply_price'],
            'other_data' => ['config' => ['search' => 1],
            'data' => ['table' => 'materals', 'where' => ['type' => $key_supp]]]
        ];
        $base_need = getBaseNeedQtySquareSupply($supply_obj->supp_qty, $supply_size);
        $arr_items = [
            'key_supp' => $key_supp,
            'note' => 'Đề can nhung',
            'supp_price' => @$supply_size['supply_price'],
            'base_need' => $base_need,
            'index' => 0
        ]
    @endphp
    
    @include('quotes.products.supplies.title_config', ['divide' => $silk_divide, 'name' => 'vải lụa'])

    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $silk_compen_percent])

    @include('quotes.products.supplies.size_config', ['plus' => $silk_plus, 'divide' => $silk_divide])

    @include('view_update.view', $pro_silk_supply)

    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nhung theo yêu cầu</span>
    </h3>

    <div class="__supply_handle_list" data-table = 'square_warehouses' data-need ="{{ @$base_need ?? 0 }}">
        @include('orders.users.6.supply_handles.view_handles.square_warehouses.item', $arr_items)
    </div>

@endsection