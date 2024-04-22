<div class="config_handle_paper_pro">
    <div class="mb-2 base_product_config">
        @php
            $pro_name_field = [
                'name' => '',
                'note' => 'Tên sản phẩm',
                'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name', 'placeholder' => 'Nhập tên', 'disable_field' => 1],
                'value' => !empty($product['id']) ? @$product['name'] : ''
            ];
            $pro_qty_field = [
                'name' => '',
                'note' => 'Số lượng sản phẩm',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty', 'placeholder' => 'Nhập số lượng', 'disable_field' => 1],
                'value' => @$product['qty']
            ];
            $pro_category_field = [
                'name' => '',
                'type' => 'linking',
                'note' => 'Nhóm sản phẩm',
                'attr' => ['required' => 1, 'inject_class' => 'select_quote_procategory', 'inject_attr' => 'proindex='.$pro_index, 'disable_field' => 1],
                'other_data' => ['data' => ['table' => 'product_categories']],
                'value' => @$product['category']
            ]
        @endphp

        @include('view_update.view', $pro_name_field)

        @include('view_update.view', $pro_qty_field)
        
        @include('view_update.view', $pro_category_field)
    </div>
</div>