@php
    $pro_fill_price = [
        'name' => 'product['.$j.'][fill_finish]['.$pindex.'][fill_price]',
        'note' => 'Đơn giá bồi',
        'value' => 0
    ] 
@endphp
@include('view_update.view', $pro_fill_price)
@php
    $pro_finishes_price = [
        'name' => 'product['.$j.'][fill_finish]['.$pindex.'][finish_price]',
        'note' => 'Đơn giá hoàn thiện',
        'value' => 0
    ] 
@endphp
@include('view_update.view', $pro_finishes_price)