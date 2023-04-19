@php
    $key_stage = \TDConst::NILON;
    $paper_nilon_materal = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'value' => getDefaultMateralIDByKey($key_stage),
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['materal_key' => $key_stage], 'select' => ['id', 'name']]]
    ]
@endphp
@include('view_update.view', $paper_nilon_materal)

@php
    $paper_nilon_face = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'value' => 1,
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ] 
@endphp
@include('view_update.view', $paper_nilon_face)

@include('quotes.products.papers.handles.select_device', 
['key_device' => $key_stage, 
'value' => getDeviceId(['key_device' => $key_stage, 'supply' => 'paper', 'default_device' => 1])])