@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @include('quotes.products.papers.supply_print', ['no_exc' => 1, 'disable_all' => true])
    @php
        $nilon = json_decode($supply_obj->nilon, true);
        $metalai = json_decode($supply_obj->metalai, true);
        $cover = json_decode($supply_obj->cover, true);
        $base_supp_qty = $supply_obj->supp_qty;
        $base_need_square = getBaseNeedQtySquareSupply($base_supp_qty, $supply_size);
    @endphp
    @if (!empty($nilon['materal']) && !empty($nilon['qtv']))
        @include('orders.users.6.supply_handles.view_handles.multiple', 
        ['arr_items' => [
            'key_supp' => \TDConst::NILON, 
            'note' => 'màng nilon', 
            'supp_price' => $nilon['materal'],
            'qtv' => $nilon['qtv'],
            'base_need' => $base_need_square
        ],
        'type' => \TDConst::HANK])
    @endif

    {{-- chọn vật tư cán metalai --}}
    @if (!empty($metalai['materal']))
        @include('orders.users.6.supply_handles.view_handles.multiple', 
        [
            'arr_items' => [
                'key_supp' => \TDConst::METALAI, 
                'note' => 'màng metalai ('.$metalai['face'].' mặt)', 
                'supp_price' => $metalai['materal'], 
                'base_need' => $base_need_square,
                'qtv' => $metalai['qtv'],
            ],
            'type' => \TDConst::HANK
        ])
    @endif 
    
    {{-- Chọn vật tư cán phủ trên --}}
    @if (!empty($cover['materal']) && !empty($cover['qtv']))
    @include('orders.users.6.supply_handles.view_handles.multiple', 
        [
            'arr_items' => [
                'key_supp' => \TDConst::COVER, 
                'note' => 'màng phủ trên ('.$cover['face'].' mặt)', 
                'supp_price' => $cover['materal'],
                'base_need' => $base_need_square,
                'qtv' => $cover['qtv'],
            ],
            'type' => \TDConst::HANK
        ])
    @endif 
    <div class="plan_handle_supply_module">
        <div class="process_paper_plan">
            @php
                $arr_items = [
                    'key_supp' => \TDConst::PAPER, 
                    'note' => 'giấy in', 
                    'base_need' => $supply_obj->supp_qty
                ];
                if (!empty($supply_size['materal']) && $supply_size['materal'] != 'other') {
                    $arr_items['supp_price'] = $supply_size['materal'];
                }
                if (!empty($supply_size['qtv'])) {
                    $arr_items['qtv'] = $supply_size['qtv'];
                }
            @endphp
            @include('orders.users.6.supply_handles.view_handles.multiple', 
            ['arr_items' => $arr_items, 'type' => \TDConst::PAPER])
        </div> 
    </div>
@endsection