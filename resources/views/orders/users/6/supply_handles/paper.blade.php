@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @include('quotes.products.papers.supply_print', ['no_exc' => 1, 'disable_all' => true])
    @php
        $nilon = json_decode($supply_obj->nilon, true);
        $metalai = json_decode($supply_obj->metalai, true);
        $base_supp_qty = calValuePercentPlus($supply_obj->supp_qty, $supply_obj->supp_qty, getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
        $data_length = @$supply_size['width'] < @$supply_size['length'] ? @$supply_size['width'] : @$supply_size['length'];
        $base_need = $base_supp_qty*($data_length/10);
    @endphp
    @if (!empty($nilon['materal']))
        @include('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => ['key_supp' => \TDConst::NILON, 'note' => 'màng nilon', 'supp_price' => $nilon['materal'],
        'base_need' => $base_need],
        'type' => 'square_warehouses'])
    @endif

    {{-- chọn vật tư cán metalai --}}
    @if (!empty($metalai['materal']))
        @include('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => ['key_supp' => \TDConst::METALAI, 'note' => 'màng metalai', 'supp_price' => $metalai['materal'],
        'base_need' => $base_need],
        'type' => 'square_warehouses'])
    @endif 
    
    {{-- Chọn vật tư cán phủ trên --}}
    @if (!empty($metalai['cover_materal']))
    @include('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => ['key_supp' => \TDConst::COVER, 
        'note' => 'màng phủ trên ('.$metalai['cover_face'].' mặt)', 
        'supp_price' => $metalai['cover_materal'],
        'base_need' => $base_need],
        'type' => 'square_warehouses'])
    @endif 
    <div class="process_paper_plan">
        @include('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => ['key_supp' => \TDConst::PAPER, 
        'note' => 'giấy in', 
        'supp_price' => $supply_size['materal'],
        'qtv' => $supply_size['qttv'],
        'base_need' => $base_supp_qty],
        'type' => 'print_warehouses'])
    </div> 
    
    <div class="plan_over_supply">
        @include('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => [
        'title_handle' => 'Nhập kho băng lề giấy in', 
        'supp_price' => $supply_size['materal'],
        'qtv' => $supply_size['qttv']],
        'type' => 'over_supplies'])
    </div>
@endsection