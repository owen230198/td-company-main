@php
    $key_stage = \TDConst::FLOAT;
    $elevate_key = \TDConst::ELEVATE;
    $float_base_name = @$category == 1 ? '['.$key_stage.']' : '['.$elevate_key.']['.$key_stage.']';
    $paper_float_price = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']'.$float_base_name.'[price]',
        'note' => 'Giá tiền thúc nổi 1 sp',
        'attr' => ['type_input' => 'number'],
        'value' => 0
    ];
    $paper_float_shape_price = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']'.$float_base_name.'[shape_price]',
        'note' => 'Giá khuôn thúc nổi 1 sp',
        'attr' => ['type_input' => 'number'],
        'value' => 0
    ]  
@endphp
<div class="d-flex align-items-center">
    @include('view_update.view', $paper_float_price)
    <span class="ml-2 fs-12 font-italic color_red">Giá lượt/bát sp (không phải giá lượt/ tờ in)</span>
</div>

<div class="d-flex align-items-center">
    @include('view_update.view', $paper_float_shape_price)
    <span class="ml-2 fs-12 font-italic color_red">Giá khuôn/bát sp (không phải giá khuôn/tờ in)</span>
</div>

@if (isHardBox(@$cate))
    @include('quotes.products.papers.handles.select_device', ['key_device' => $key_stage])
@endif