<div class="order_field_update __order_field_module mt- pt-3 border_top_eb">
    <input type="hidden" name="order[quote]" value="{{ $data_quote['id'] }}">
    @php
        $order_field_update = [
            [
                'name' => '',
                'note' => 'Tổng tiền (chưa bao gồm VAT)',
                'attr' => ['disable_field' => 1, 'inject_class' => '__order_total_input'],
                'value' => round(@$data_quote['total_amount'])
            ],
            [
                'name' => 'order[advance]',
                'note' => 'Tạm ứng đơn hàng',
                'attr' => ['type_input' => 'number', 'inject_class' => '__order_advance_input'],
                'value' => @$data_order['advance'] ?? 0
            ],
            [
                'name' => 'order[rest]',
                'note' => 'Chi phí còn lại',
                'attr' => ['readonly' => 1, 'inject_class' => '__order_rest_input'],
                'value' => @$data_order['rest'] ?? round(@$data_quote['total_amount'])
            ],
            [
                'name' => 'order[rest_bill]',
                'note' => 'File bill tạm ứng',
                'type' => 'file',
                'value' => @$data_order['rest_bill']
            ],
            [
                'name' => 'order[rest_note]',
                'note' => 'Ghi chú công nợ',
                'type' => 'textarea',
                'value' => @$data_order['rest_note']
            ],
            [
                'name' => 'order[ship_note]',
                'note' => 'Ghi chú giao hàng',
                'type' => 'textarea',
                'value' => @$data_order['ship_note']
            ]
        ]
    @endphp
    @foreach ($order_field_update as $order_field)
        @include('view_update.view', $order_field)    
    @endforeach
</div>