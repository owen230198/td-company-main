@php
    $key_stage = \App\Constants\TDConstant::FLOAT;
    $paper_float = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][act]',
        'type' => 'checkbox',
        'note' => 'Sản phẩm có thúc nổi'
    ]
@endphp
@include('view_update.view', $paper_float)