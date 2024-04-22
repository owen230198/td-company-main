@php
    $key_stage = \TDConst::ELEVATE;
    $paper_elevate_ext_price = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][ext_price]',
        'note' => 'Thêm giá cho khuôn phức tạp',
        'attr' => ['type_input' => 'number'],
        'value' => @$data_handle['ext_price'] ?? 0
    ];
@endphp
<div class="d-flex align-items-center">
    @include('view_update.view', $paper_elevate_ext_price)
    <span class="ml-2 font-italic color_red fs-12">Khuôn nhiều chi tiết khác thường</span>
</div>

@include('quotes.products.papers.handles.select_device', ['key_device' => $key_stage, 'value' => @$data_handle['machine']])

@php
    $paper_elevate_float_act = [
        'name' => $paper_hd_base_name.'['.$key_stage.'][float][act]',
        'note' => 'Thúc nổi',
        'type' => 'checkbox',
        'attr' => ['inject_class' => '__elevate_float_checkbox'],
        'value' => @$data_handle['float']['act']
    ];
@endphp
<div class="mt-2 pt-2 border_top_white __paper_elevate_float_handle">
    @include('view_update.view', $paper_elevate_float_act)
    <div class="__float_base_config" style="display: {{ @$data_handle['float']['act'] == 0 ? 'none' : 'block' }}">
        @include('quotes.products.papers.handles.float', ['data_handle' => @$data_handle['float'], 'float_extend' => true])
    </div>
</div>