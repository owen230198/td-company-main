@php
    $paper_metalai_materal = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][metalai][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => 'metalai'], 'select' => ['id', 'name']]]
    ] 
@endphp
@include('view_update.view', $paper_metalai_materal)

@php
    $paper_metalai_face = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][metalai][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ] 
@endphp
@include('view_update.view', $paper_metalai_face)

@include('quotes.products.papers.handles.device_note', ['key_device' => 'metalai'])