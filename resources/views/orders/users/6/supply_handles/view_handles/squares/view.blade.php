@php
    $index = @$index ?? 0;
    $base_supp_qty = calValuePercentPlus($supply_obj->supp_qty, $supply_obj->supp_qty, getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
    $data_length = @$supply_size['width'] < @$supply_size['length'] ? @$supply_size['width'] : @$supply_size['length'];
    $base_need = $base_supp_qty*($data_length/10);
@endphp
@extends('orders.users.6.supply_handles.view_handles.multiple')
@section('items')
    @include('orders.users.6.supply_handles.view_handles.squares.item')
@endsection