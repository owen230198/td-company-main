@php
    $key_stage = \TDConst::NILON;
    $paper_nilon_face = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'value' => @$data_handle['face'] ?? 1,
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ];
@endphp
@include('quotes.products.select_supply_type', ['key_supp' => $key_supp, 'pro_index' => $pro_index, 'supp_index' => $supp_index, 'key_stage' => $key_stage])
@include('view_update.view', $paper_nilon_face)
@include('quotes.products.papers.handles.select_device', 
['key_device' => $key_stage, 
'value' => @$data_handle['machine'] ?? getDeviceId(['key_device' => $key_stage, 'supply' => 'paper', 'default_device' => 1])])