@php
    $paper_nilon_materal = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][nilon][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => 'nilon'], 'select' => ['id', 'name']]]
    ] 
@endphp
@include('view_update.view', $paper_nilon_materal)

@php
    $paper_nilon_face = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][nilon][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ] 
@endphp
@include('view_update.view', $paper_nilon_face)

@include('quotes.products.papers.handles.device_note', ['key_device' => 'nilon'])