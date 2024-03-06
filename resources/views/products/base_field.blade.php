<div class="mb-2 base_product_config">
    @php
        $pro_base_name_input = 'product['.$pro_index.']';
        $arr_pro_field = [
            [
                'name' => $pro_base_name_input.'[name]',
                'note' => 'Tên sản phẩm',
                'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name length_input', 'placeholder' => 'Nhập tên', 'readonly' => !empty($rework)],
                'value' => !empty($product['id']) ? @$product['name'] : ''
            ],
            [
                'name' => $pro_base_name_input.'[qty]',
                'note' => 'Số lượng sản phẩm',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty', 'placeholder' => 'Nhập số lượng'],
                'value' => @$product['qty']
            ],
            [
                'name' => $pro_base_name_input.'[made_by]',
                'note' => 'Đơn vị sản xuất',
                'type' => 'linking',
                'attr' => ['required' => 1, 'inject_class' => 'input_pro_made_by'],
                'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'partners', 'select' => ['id', 'name', 'type'], 'field_value' => 'type']],
                'value' => @$product['made_by']
            ]
        ];

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
        $note_product_field = [
            'name' => $pro_base_name_input.'[detail]',
            'type' => 'textarea',
            'note' => 'Ghi chú',
            'value' => @$product['detail']
        ];
    @endphp

    @foreach ($arr_pro_field as $field)
        @include('view_update.view', $field)
    @endforeach
    <div class="made_by_own_content" style="display: none">
        @include('view_update.view', $design_product_field)
        <div class="__style_product_select_module {{ !empty($rework) ? 'd-none' : '' }}">
            @include('view_update.view', $category_product_field)
            <div class="__style_select mt-2" style="display: {{ !empty($product['product_style']) ? 'block' : 'none' }}">
                @include('view_update.view', $style_product_field)
            </div>
        </div>
        @if (\GroupUser::isSale() || \GroupUser::isTechApply() || \GroupUser::isAdmin())
            @php
                $sale_shape_file = \App\Models\Product::SALE_SHAPE_FILE_FIELD;
                $sale_shape_file['name'] = $pro_base_name_input.'[sale_shape_file]';
                $sale_shape_file['value'] = @$product['sale_shape_file']; 
            @endphp
            @include('view_update.view', $sale_shape_file)
        @endif
        @include('view_update.view', $note_product_field)
        @if (!empty($order_get))
            @include('orders.products.extend_info')   
        @endif
    </div>
    <div class="made_by_partner" style="display: none">

    </div>
</div>