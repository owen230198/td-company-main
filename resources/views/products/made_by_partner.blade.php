@php
    $pro_base_name_input = 'product['.$pro_index.']';
    $cost_product_fields = [
        [
            'name' => '',
            'note' => 'Đơn giá',
            'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_price __input_module_made_by_partner', 'placeholder' => 'Nhập đơn giá'],
            'value' => !empty(@$product['qty']) ? @$product['total_amount']/@$product['qty'] : ''
        ],
        [
            'name' => $pro_base_name_input.'[total_amount]',
            'note' => 'Thành tiền',
            'attr' => ['readonly' => 1, 'type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_total_amount __input_module_made_by_partner'],
            'value' => @$product['total_amount']
        ]
    ];
@endphp
<div class="made_by_partner_module">
    @foreach ($cost_product_fields as $cost_fied)
        @include('view_update.view', $cost_fied)     
    @endforeach 
</div>