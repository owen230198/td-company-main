@php
    $key_stage = \TDConst::PRINT;
    $paper_print_type = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][type]',
        'type' => 'select',
        'note' => 'kiểu in',
        'value' => \TDConst::ONE_PRINT_TYPE,
        'other_data' => ['data' => ['options' => \TDConst::PRINT_TYPE]]
    ] 
@endphp
@include('view_update.view', $paper_print_type)

@php
    $paper_print_color = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][color]',
        'type' => 'select',
        'note' => 'số màu in',
        'value' => 4,
        'other_data' => ['data' => ['options' => \TDConst::PRINT_COLOR]]
    ] 
@endphp
@include('view_update.view', $paper_print_color)

@php
    $paper_print_tech = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][machine]',
        'type' => 'select',
        'note' => 'công nghệ in',
        'value' => \TDConst::OFFSET_PRINT_TECH,
        'other_data' => ['data' => ['options' => \TDConst::PRINT_TECH]]
    ] 
@endphp
@include('view_update.view', $paper_print_tech)