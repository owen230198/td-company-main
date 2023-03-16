@php
    $key_stage = \App\Constants\TDConstant::METALAI;
    $paper_metalai_materal = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => $key_stage], 'select' => ['id', 'name']]]
    ] 
@endphp
@include('view_update.view', $paper_metalai_materal)

@php
    $paper_metalai_face = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ] 
@endphp
@include('view_update.view', $paper_metalai_face)

@include('quotes.products.papers.handles.device_note', ['key_device' => $key_stage])