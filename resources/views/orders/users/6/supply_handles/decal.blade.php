@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @php
        $key_supp = \TDConst::DECAL;
        $decal_divide = \TDConst::DECAL_SIZE_DIVIDE;
        $decal_compen_percent = (float) getDataConfig('QuoteConfig', 'DECAL_COMPEN_PERCENT');
        $decal_plus = \TDConst::DECAL_SIZE_PLUS;
        $pro_decal_supply = [
            'name' => '',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'value' => @$supply_size['supply_price'],
            'other_data' => ['config' => ['search' => 1],
            'data' => ['table' => 'materals', 'where' => ['type' => $key_supp]]]
        ];
        $decal_chose_supp = [
            'name' => 'c_supply[supp_price]',
            'type' => 'linking',
            'note' => 'Chọn nhung trong kho',
            'value' => '',
            'other_data' => [
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'square_warehouses', 
                    'where' => ['type' => $key_supp,
                                'supp_price' => @$supply_size['supply_price'],
                                'status' => 'imported']
                ]
            ]
        ];
        $base_supp_qty = $supply_obj->supp_qty;
        $data_length = @$supply_size['width'] < @$supply_size['length'] ? @$supply_size['width'] : @$supply_size['length'];
        $base_need = $base_supp_qty * ($data_length/10);
        $arr_items = [
            'key_supp' => $key_supp,
            'note' => 'Đề can nhung',
            'supp_price' => @$supply_size['supply_price'],
            'base_need' => $base_need,
            'index' => 0
        ]
    @endphp
    @include('quotes.products.supplies.title_config', ['divide' => $decal_divide, 'name' => 'đề can nhung'])
    
    @include('quotes.products.supplies.quantity_config', ['compen_percent' => $decal_compen_percent])
    
    @include('quotes.products.supplies.size_config', ['plus' => $decal_plus, 'divide' => $decal_divide])
    
    @include('view_update.view', $pro_decal_supply)

    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nhung theo yêu cầu</span>
    </h3>

    <div class="__supply_handle_list" data-table = 'square_warehouses' data-need ="{{ @$base_need ?? 0 }}">
        @include('orders.users.6.supply_handles.view_handles.square_warehouses.item', $arr_items)
    </div>
@endsection