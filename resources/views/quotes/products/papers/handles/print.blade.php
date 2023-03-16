@php
    $key_stage = \App\Constants\TDConstant::PRINT;
    $paper_print_type = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][type]',
        'type' => 'select',
        'note' => 'kiểu in',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_TYPE]]
    ] 
@endphp
@include('view_update.view', $paper_print_type)

@php
    $paper_print_color = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][color]',
        'type' => 'select',
        'note' => 'số màu in',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_COLOR]]
    ] 
@endphp
@include('view_update.view', $paper_print_color)

@php
    $paper_print_tech = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][machine]',
        'type' => 'select',
        'note' => 'công nghệ in',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_TECH]]
    ] 
@endphp
@include('view_update.view', $paper_print_tech)

@php
    $paper_print_req = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][color]',
        'type' => 'select',
        'note' => 'Yêu cầu thợ in',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRINT_REQUIRED]]
    ] 
@endphp
@include('view_update.view', $paper_print_req)

@php
    $paper_print_note = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][note]',
        'type' => 'textarea',
        'note' => 'Ghi chú'
    ] 
@endphp
@include('view_update.view', $paper_print_note)