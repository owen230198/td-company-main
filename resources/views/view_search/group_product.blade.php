@php
    $base_name = 'category';
    $data_value = !empty($data_search['category']) ? $data_search['category'] : [];
    $group_val = @$data_value['group'];
    $field_category = [
        'name' => $base_name.'[group]',
        'type' => 'linking',
        'attr' => ['inject_class' => '__select_product_category', 'placeholder' => 'Chọn nhóm sản phẩm'],
        'other_data' => ['data' => ['table' => 'product_categories']],
        'value' => @$group_val
    ];
    $other_data_style = ['table' => 'product_styles'];
    if (!empty($group_val)) {
        $other_data_style['where']['category'] = $group_val;
    }
    $field_style = [
        'name' => $base_name.'[style]',
        'type' => 'linking',
        'attr' => [
            'inject_class' => '__select_product_style', 
            'placeholder' => 'Chọn kiểu hộp'
        ],
        'other_data' => [
            'data' => $other_data_style
        ],
        'value' => @$data_value['style']
    ]
@endphp
<div class="w-100 __style_product_select_module">
    @include('view_update.linking', $field_category)
    <div class="__style_select mt-2" style="display: {{ !empty($group_val) ? 'block' : 'none' }}">
        @include('view_update.linking', $field_style)
    </div>
</div>