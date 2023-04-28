@php
    $key_stage = \TDConst::METALAI;
    $paper_metalai_materal = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][materal]',
        'type' => 'linking',
        'note' => 'chất liệu',
        'value' =>  @$data_handle['materal'],
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['type' => $key_stage], 'select' => ['id', 'name']]]
    ]; 
    $paper_metalai_face = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'value' =>  @$data_handle['face'],
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ];
    
    $paper_cover_materal = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][cover_materal]',
        'type' => 'linking',
        'note' => 'chất liệu cán phủ trên',
        'value' =>  @$data_handle['cover_materal'],
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['type' => 'cover'], 'select' => ['id', 'name']]]
    ]; 
    $paper_cover_face = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][cover_face]',
        'type' => 'select',
        'note' => 'Số mặt cán phủ trên',
        'value' =>  @$data_handle['cover_face'],
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ]; 
@endphp

@include('view_update.view', $paper_metalai_materal)

@include('view_update.view', $paper_metalai_face)

@include('view_update.view', $paper_cover_materal)

@include('view_update.view', $paper_cover_face)

@include('quotes.products.papers.handles.select_device', ['key_device' => $key_stage, 'value' =>  @$data_handle['machine'],])