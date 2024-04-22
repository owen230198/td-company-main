@php
    $base_name = 'category';
    $data_value = !empty($data_search['category']) ? $data_search['category'] : [];
    $field_category = [
        'name' => $base_name.'[group]',
        'type' => 'linking',
        'attr' => ['inject_class' => '__select_product_category', 'placeholder' => 'Chọn nhóm sản phẩm'],
        'other_data' => ['data' => ['table' => 'product_categories']],
        'value' => @$data_value['group']
    ];
    $field_style = [
        'name' => $base_name.'[style]',
        'type' => 'linking',
        'attr' => [
            'inject_class' => '__select_product_style', 
            'placeholder' => 'Chọn kiểu hộp', 
            'disable_field' => 1
        ],
        'other_data' => ['data' => ['table' => 'product_styles']],
        'value' => @$data_value['style']
    ]
@endphp
<div class="w-100 __style_product_select_module">
    @include('view_update.linking', $field_category)
    <div class="__style_select mt-2" style="display: {{ !empty($data_value['group']) ? 'block' : 'none' }}">
        @include('view_update.linking', $field_style)
    </div>
</div>