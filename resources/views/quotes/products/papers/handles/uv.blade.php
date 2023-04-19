@php
    $key_stage = \TDConst::UV;
    $paper_uv_face = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ]
@endphp
@include('view_update.view', $paper_uv_face)

@php
    $paper_uv_materal = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][materal]',
        'type' => 'linking',
        'note' => 'mực in',
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => $key_stage], 'select' => ['id', 'name']]]
    ]  
@endphp
@include('view_update.view', $paper_uv_materal)

@include('quotes.products.papers.handles.select_device', ['key_device' => $key_stage])