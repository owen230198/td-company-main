@php
    $pro_base_name_input = 'product['.$pro_index.']';
    $design_product_field = [
        'name' => $pro_base_name_input.'[design]',
        'note' => 'thiết kế',
        'attr' => ['readonly' => !empty($rework)],
        'type' => 'linking',
        'other_data' => ['data' => ['table' => 'design_types', 'select' => ['id', 'name']]],
        'value' => @$product['design']
    ];
    $category_product_field = [
        'name' => $pro_base_name_input.'[category]',
        'type' => 'linking',
        'note' => 'Nhóm sản phẩm',
        'attr' => ['required' => 1 , 
            'inject_class' => 'select_quote_procategory __select_product_category __category_product', 
            'inject_attr' => 'proindex='.$pro_index,
            'readonly' => !empty($product['category']) ? 1 : 0
        ],
        'other_data' => ['data' => ['table' => 'product_categories']],
        'value' => @$product['category']
    ];
    $style_product_field = [
        'name' => $pro_base_name_input.'[product_style]',
        'type' => 'linking',
        'note' => 'Kiểu hộp',
        'attr' => ['required' => 1 , 
            'inject_class' => '__select_product_style __style_product',
            'disable_field' => 1
        ],
        'other_data' => ['data' => ['table' => 'product_styles']],
        'value' => @$product['product_style']
    ];
@endphp
@include('view_update.view', $design_product_field)
<div class="__style_product_select_module {{ !empty($rework) ? 'd-none' : '' }}">
    @include('view_update.view', $category_product_field)
    <div class="__style_select mt-2" style="display: {{ !empty($product['product_style']) ? 'block' : 'none' }}">
        @include('view_update.view', $style_product_field)
    </div>
</div>
@if ((\GroupUser::isSale() || \GroupUser::isTechApply() || \GroupUser::isAdmin()) && empty($rework))
    @php
        $sale_shape_file = \App\Models\Product::SALE_SHAPE_FILE_FIELD;
        $sale_shape_file['name'] = $pro_base_name_input.'[sale_shape_file]';
        $sale_shape_file['value'] = @$product['sale_shape_file']; 
    @endphp
    @include('view_update.view', $sale_shape_file)
@endif