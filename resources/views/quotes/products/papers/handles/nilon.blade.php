@php
    $key_stage = \TDConst::NILON;
    $paper_nilon_materal = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'value' => !empty($data_paper->id) ? @$data_handle['materal'] : getDefaultMateralIDByKey($key_stage),
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['type' => $key_stage], 'select' => ['id', 'name']]]
    ];
    $paper_nilon_face = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'value' => !empty($data_paper->id) ? @$data_handle['face'] : 1,
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ];
@endphp
@include('view_update.view', $paper_nilon_materal)
@include('view_update.view', $paper_nilon_face)

@include('quotes.products.papers.handles.select_device', 
['key_device' => $key_stage, 
'value' => !empty($data_paper->id) ? @$data_handle['machine'] : getDeviceId(['key_device' => $key_stage, 'supply' => 'paper', 'default_device' => 1])])