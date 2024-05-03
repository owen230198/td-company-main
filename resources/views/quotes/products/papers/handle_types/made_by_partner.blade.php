@php
    $key_supp = \TDConst::PAPER;
    $base_name = 'product['.$pro_index.']['.$key_supp.']['.$supp_index.']';
    $cost_product_fields = [
        [
            'name' => $base_name.'[made_by]',
            'note' => 'Đơn vị sản xuất',
            'type' => 'linking',
            'attr' => ['required' => 1],
            'other_data' => ['config' => ['search' => 1], 
                'data' => ['table' => 'partners', 'select' => ['id', 'name']]],
            'value' => @$supply_obj->made_by
        ],
        [
            'name' => $base_name .'[qty]',
            'note' => 'Số lượng sản phẩm',
            'value' => @$supply_obj->qty ?? @$pro_qty,
            'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_paper_qty pro_qty_input supp_qty_modul_input __input_module_made_by_partner',
            'disable_field' => !empty($disable_all) || in_array('qty', @$arr_disable ?? []) ? 1 : 0]
        ],
        [
            'name' => '',
            'note' => 'Giá mua',
            'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_paper_price __input_module_made_by_partner', 'placeholder' => 'Nhập đơn giá'],
            'value' =>!empty($supply_obj->qty) ? (float) @$supply_obj->total_cost / (int) $supply_obj->qty : 0,
        ],
        [
            'name' => $base_name.'[total_cost]',
            'note' => 'Tổng tiền mua',
            'attr' => ['readonly' => 1, 'type_input' => 'number', 'required' => 1, 'inject_class' => 'input_paper_total_cost'],
            'value' => (float) @$supply_obj->total_cost
        ],
        [
            'name' => '',
            'note' => 'Giá bán',
            'attr' => ['type_input' => 'number', 'readonly' => 1, 'inject_class' => 'input_paper_price'],
            'value' => !empty($supply_obj->qty) ? (float) @$supply_obj->total_amount / (int) $supply_obj->qty : 0,
        ],
        [
            'name' => $base_name.'[total_amount]',
            'note' => 'Thành tiền',
            'attr' => ['readonly' => 1, 'type_input' => 'number', 'required' => 1, 'inject_class' => 'input_paper_total_amount'],
            'value' => (float) @$supply_obj->total_amount
        ],
        [
            'name' => $base_name .'[detail]',
            'note' => 'Ghi chú mua hàng',
            'type' => 'textarea',
            'value' => @$supply_obj->detail
        ],
    ];
@endphp
<div class="made_by_partner_module">
    @foreach ($cost_product_fields as $cost_fied)
        @include('view_update.view', $cost_fied)     
    @endforeach 
</div>