@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @include('quotes.products.papers.supply_print', ['no_exc' => 1, 'disable_all' => true])
    @php
        $nilon = json_decode($supply_obj->nilon, true);
        $metalai = json_decode($supply_obj->metalai, true);
    @endphp
    @if (!empty($nilon['materal']))
        @include('orders.users.6.supply_handles.view_handles.squares.view', 
        ['key_supp' => \TDConst::NILON, 'note' => 'màng nilon', 'supp_price' => $nilon['materal']])
    @endif

    {{-- chọn vật tư cán metalai --}}
    @if (!empty($metalai['materal']))
        @include('orders.users.6.supply_handles.view_handles.squares.view', 
        ['key_supp' => \TDConst::METALAI, 'note' => 'màng metalai', 'supp_price' => $metalai['materal']])
    @endif 
    
    {{-- Chọn vật tư cán phủ trên --}}
    @if (!empty($metalai['cover_materal']))
    @include('orders.users.6.supply_handles.view_handles.squares.view', 
        ['key_supp' => \TDConst::COVER, 
        'note' => 'màng phủ trên ('.$metalai['cover_face'].' mặt)', 
        'supp_price' => $metalai['cover_materal']])
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