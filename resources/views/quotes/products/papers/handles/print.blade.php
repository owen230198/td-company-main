@php
    $key_stage = \TDConst::PRINT;
    $paper_print_type = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][type]',
        'type' => 'select',
        'note' => 'kiểu in',
        'value' => @$data_handle['type'],
        'other_data' => ['data' => ['options' => \TDConst::PRINT_TYPE]]
    ];
    $paper_print_color = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][color]',
        'type' => 'select',
        'note' => 'số màu in',
        'value' => @$data_handle['color'] ?? 4,
        'other_data' => ['data' => ['options' => \TDConst::PRINT_COLOR]]
    ];
    $paper_print_tech = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][machine]',
        'type' => 'select',
        'note' => 'công nghệ in',
        'value' => @$data_handle['machine'],
        'other_data' => ['data' => ['options' => \TDConst::PRINT_TECH]]
    ];
@endphp
@include('view_update.view', $paper_print_type)

@include('view_update.view', $paper_print_color)

@include('view_update.view', $paper_print_tech)