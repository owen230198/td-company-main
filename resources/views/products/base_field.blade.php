<div class="mb-2 base_product_config">
    @php
        $pro_base_name_input = 'product['.$pro_index.']';
        $read_only_by_status = !empty($product->status);
        $read_only_by_rework = !empty($rework) || !empty($readonly_base);
        $check_readonly = $read_only_by_rework || $read_only_by_status;
        $arr_pro_field = [
            [
                'name' => $pro_base_name_input.'[name]',
                'note' => 'Tên sản phẩm',
                'attr' => [
                    'required' => 1, 
                    'inject_class' => 'quote_set_product_name length_input', 
                    'placeholder' => 'Nhập tên', 'readonly' => $check_readonly
                ],
                'value' => !empty($product['id']) ? @$product['name'] : ''
            ],
            [
                'name' => $pro_base_name_input.'[type]',
                'note' => 'Loại hàng',
                'type' => 'select',
                'attr' => ['required' => 1, 'readonly' => $check_readonly],
                'other_data' => [
                    'data' => ['options' => \TDConst::TYPE_PRODUCT_OPTIONS]
                ],
                'value' => !empty($product['id']) ? @$product['type'] : \TDConst::ORDER_PRODUCT
            ],
            [
                'name' => $pro_base_name_input.'[qty]',
                'note' => 'Số lượng sản phẩm',
                'attr' => [
                    'type_input' => 'number', 
                    'required' => 1, 
                    'inject_class' => 'input_pro_qty __input_module_made_by_partner', 
                    'placeholder' => 'Nhập số lượng', 
                    'readonly' => \App\Models\Product::canUpdateQty(@$product) ? 0 : (!empty($readonly_base) || $read_only_by_status)
                ],
                'value' => @$product['qty']
            ],
        ];
        $note_product_field = [
            'name' => $pro_base_name_input.'[detail]',
            'attr' => ['readonly' => $read_only_by_rework],
            'type' => 'textarea',
            'note' => 'Ghi chú',
            'value' => @$product['detail']
        ]
    @endphp

    @foreach ($arr_pro_field as $field)
        @include('view_update.view', $field)
    @endforeach
    @include('products.made_by_own')
    @include('view_update.view', $note_product_field)
    @if (!empty($order_get))
        @include('orders.products.extend_info')   
    @endif
</div>