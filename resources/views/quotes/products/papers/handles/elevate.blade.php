@php
    $key_stage = \App\Constants\TDConstant::ELEVATE;
    $paper_elevate_ext_price = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][ext_price]',
            'note' => 'Thêm giá cho khuôn phức tạp',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
@endphp
@include('view_update.view', $paper_elevate_ext_price)

@include('quotes.products.papers.handles.select_device', ['key_device' => $key_stage])

@if (@$category == 2)
    <div class="mt-2 pt-2 border_top_white">
        @include('quotes.products.papers.handles.float')
    </div>
@endif