@php
    $key_stage = \App\Constants\TDConstant::FLOAT;
    $paper_float_price = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
        'note' => 'Đơn giá thúc nổi',
        'attr' => ['type_input' => 'number'],
        'value' => 0
    ]
@endphp
@include('view_update.view', $paper_float_price)