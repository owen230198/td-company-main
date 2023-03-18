@php
    $key_stage = \App\Constants\TDConstant::PRINT;
    $paper_print_type = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][type]',
        'type' => 'select',
        'note' => 'kiểu in',
        'value' => \App\Constants\TDConstant::ONE_PRINT_TYPE,
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_TYPE]]
    ] 
@endphp
@include('view_update.view', $paper_print_type)

@php
    $paper_print_color = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][color]',
        'type' => 'select',
        'note' => 'số màu in',
        'value' => 4,
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_COLOR]]
    ] 
@endphp
@include('view_update.view', $paper_print_color)

@php
    $paper_print_tech = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][machine]',
        'type' => 'select',
        'note' => 'công nghệ in',
        'value' => \App\Constants\TDConstant::OFFSET_PRINT_TECH,
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_TECH]]
    ] 
@endphp
@include('view_update.view', $paper_print_tech)