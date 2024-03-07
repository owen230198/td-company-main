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
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty __input_module_made_by_partner', 'placeholder' => 'Nhập số lượng'],
                'value' => @$product['qty']
            ],
            [
                'name' => $pro_base_name_input.'[made_by]',
                'note' => 'Đơn vị sản xuất',
                'type' => 'linking',
                'attr' => ['required' => 1, 'inject_class' => '__select_pro_made_by'],
                'other_data' => ['config' => ['search' => 1], 
                    'inject_attr' => 'proindex='.$pro_index,
                    'data' => ['table' => 'partners', 'select' => ['id', 'name', 'type'], 'field_value' => 'type']],
                'value' => @$product['made_by']
            ]
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
    <div class="ajax_made_by_content">
        
    </div>
    @include('view_update.view', $note_product_field)
    @if (!empty($order_get) && $is_made_own)
        @include('orders.products.extend_info')   
    @endif
</div>