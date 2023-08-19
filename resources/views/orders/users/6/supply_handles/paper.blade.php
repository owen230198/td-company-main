@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @include('quotes.products.papers.supply_print', ['no_exc' => 1, 'disable_all' => true])
    @php
        $nilon = json_decode($supply_obj->nilon, true);
        $metalai = json_decode($supply_obj->metalai, true);
    @endphp
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư màng theo yêu cầu</span>
    </h3>
    @if (!empty($nilon['materal']))
        @php
            $nilon_chose_supp = [
                'name' => 'c_supply[materal]['.\TDConst::NILON.']]',
                'type' => 'linking',
                'note' => 'Chọn màng nilon',
                'value' => '',
                'other_data' => [
                    'config' => ['search' => 1], 
                    'data' => [
                        'table' => 'square_warehouses', 
                        'where' => ['type' => 'nilon',
                                    'supp_price' => $nilon['materal'],
                                    'status' => 'imported']
                    ]
                ]
            ]
        @endphp
        @include('view_update.view', $nilon_chose_supp)
    @endif

    {{-- chọn vật tư cán metalai --}}
    @if (!empty($metalai['materal']))
        @php
            $metalai_chose_supp = [
                'name' => 'c_supply[materal]['.\TDConst::METALAI.']',
                'type' => 'linking',
                'note' => 'Chọn màng cán metalai ('.$metalai['face'].' mặt)' ,
                'value' => '',
                'other_data' => [
                    'config' => ['search' => 1], 
                    'data' => [
                        'table' => 'square_warehouses', 
                        'where' => ['type' => 'metalai',
                                    'supp_price' => $metalai['materal'],
                                    'status' => 'imported']
                    ]
                ]
            ]
        @endphp
        @include('view_update.view', $metalai_chose_supp)
    @endif 
    
    {{-- Chọn vật tư cán phủ trên --}}
    @if (!empty($metalai['cover_materal']))
        @php
            $metalai_chose_supp = [
                'name' => 'c_supply[materal]['.\TDConst::COVER.']',
                'type' => 'linking',
                'note' => 'Chọn màng cán phủ trên ('.$metalai['cover_face'].' mặt)' ,
                'value' => '',
                'other_data' => [
                    'config' => ['search' => 1], 
                    'data' => [
                        'table' => 'square_warehouses', 
                        'where' => ['type' => 'cover',
                                    'supp_price' => $metalai['cover_materal'],
                                    'status' => 'imported']
                    ]
                ]
            ]
        @endphp
        @include('view_update.view', $metalai_chose_supp)
    @endif 
    <div class="process_paper_plan">
        @include('orders.users.6.supply_handles.handle', [
            'where_size_supp' => [
                    'type' => 'paper',
                    'supp_price' => @$supply_size['materal'],
                    'status' => 'imported'
            ],
            'table_type' => 'print_warehouses',
            'compen_percent' => getDataConfig('QuoteConfig', 'COMPEN_PERCENT')
        ])
    </div> 
@endsection