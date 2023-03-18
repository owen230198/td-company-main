@php
    $key_stage = \App\Constants\TDConstant::EXT_PRICE;
    $paper_ext_price = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
        'note' => 'Chi phí 1 sản phẩm',
        'attr' => ['type_input' => 'number'],
        'value' => 0
    ] 
@endphp
@include('view_update.view', $paper_ext_price)
<p class="font-italic color_red mb-1">Dành cho điền giá 1 sản phẩm.</p>
<p class="font-italic color_red mb-1">1. Tem + toa đi kèm hộp.</p>
<p class="font-italic color_red mb-1">2. Các chi phí phát sinh vật tư khác.</p>