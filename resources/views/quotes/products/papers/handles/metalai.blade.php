@php
    $key_stage = \TDConst::METALAI;
    $paper_metalai_face = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][face]',
        'type' => 'select',
        'note' => 'Số mặt',
        'value' =>  @$data_handle['face'],
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ];
    
    $paper_cover_materal = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][cover_materal]',
        'type' => 'linking',
        'note' => 'chất liệu cán phủ trên',
        'value' =>  @$data_handle['cover_materal'],
        'other_data' => ['data' => ['table' => 'materals', 'where' => ['type' => 'cover'], 'select' => ['id', 'name']]]
    ]; 
    $paper_cover_face = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][cover_face]',
        'type' => 'select',
        'note' => 'Số mặt cán phủ trên',
        'value' =>  @$data_handle['cover_face'],
        'other_data' => ['data' => ['options' => ['Chọn số mặt', 1, 2]]]
    ]; 
@endphp

@include('quotes.products.select_supply_type', ['key_supp' => $key_supp, 'pro_index' => $pro_index, 'supp_index' => $supp_index, 'key_stage' => $key_stage, 'key_type' => $key_stage])

@include('view_update.view', $paper_metalai_face)

@include('quotes.products.select_supply_type', ['key_supp' => $key_supp, 'pro_index' => $pro_index, 'supp_index' => $supp_index, 'key_stage' => \TDConst::COVER, 'key_type' => \TDConst::COVER])

@include('view_update.view', $paper_cover_face)

@include('quotes.products.papers.handles.select_device', ['key_device' => $key_stage, 'value' =>  @$data_handle['machine'],])