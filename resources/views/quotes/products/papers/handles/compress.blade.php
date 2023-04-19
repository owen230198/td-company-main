<div class="d-flex align-items-center">
    @php
        $key_stage = \TDConst::COMPRESS;
        $paper_compress_price = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
            'note' => 'Giá tiền 1 sản phẩm',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
    @endphp
    @include('view_update.view', $paper_compress_price)
    <span class="ml-2 fs-12 font-italic color_red">Giá lượt/bát sp (không phải giá lượt/ tờ in)</span>
</div>

<div class="d-flex align-items-center">
    @php
        $paper_compress_shape_price = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][shape_price]',
            'note' => 'Giá khuôn 1 sản phẩm',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
    @endphp
    @include('view_update.view', $paper_compress_shape_price)
    <span class="ml-2 fs-12 font-italic color_red">Giá khuôn/bát sp (không phải giá khuôn/tờ in)</span>
</div>

@include('quotes.products.papers.handles.select_device', ['key_device' => $key_stage])