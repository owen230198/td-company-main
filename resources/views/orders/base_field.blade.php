<div class="order_field_update __order_field_module mt- pt-3 border_top_eb">
    @php
        $order_field_update = [
            [
                'name' => 'order[customer]',
                'attr' => ['readonly' => !empty($data_order['customer'])],
                'note' => 'Khách hàng',
                'type' => 'linking',
                'other_data' => ['config' => ['search' => 1], 'data'=> ['table' => 'customers']],
                'value' => @$data_order['customer']
            ],
            [
                'name' => 'order[represent]',
                'attr' => ['readonly' => !empty($data_order['represent'])],
                'note' => 'Người liên hệ',
                'type' => 'linking',
                'other_data' => ['config' => ['search' => 1], 'data'=> ['table' => 'represents']],
                'value' => @$data_order['represent']
            ],
            [
                'name' => '',
                'note' => 'Tổng tiền (chưa bao gồm VAT)',
                'attr' => ['disable_field' => 1, 'inject_class' => '__quote_total_input'],
                'value' => @$data_order['amount'] ?? @$order_cost
            ],
            [
                'name' => 'order[vat]',
                'note' => 'VAT',
                'type' => 'checkbox',
                'attr' => ['inject_class' => '__vat_order_checkbox', 'inject_attr' => 'vat_per='.getDataConfig('QuoteConfig', 'VAT_PERC', 0).''],
                'value' => @$data_order['vat'] ?? 0
            ],
            [
                'name' => 'order[total_amount]',
                'note' => 'Tổng tiền đơn hàng',
                'attr' => ['readonly' => 1, 'inject_class' => '__order_total_input'],
                'value' => round(@$data_order['total_amount'] ?? @$order_cost)
            ]
        ];
        $c_order_fields = [
            [
                'name' => 'c_order[advance]',
                'note' => 'Tạm ứng đơn hàng',
                'attr' => ['type_input' => 'number', 'inject_class' => '__order_advance_input'],
                'value' => 0
            ],
            [
                'name' => 'c_order[rest]',
                'note' => 'Chi phí còn lại',
                'attr' => ['readonly' => 1, 'inject_class' => '__order_rest_input'],
                'value' => @$order_cost
            ],
            [
                'name' => 'c_order[receipt]',
                'note' => 'File bill tạm ứng',
                'type' => 'filev2',
                'table_map' => 'orders',
                'field_name' => 'receipt',
                'other_data' => ['role_update' => [\GroupUser::SALE], 'field_name' => 'rest_bill']
            ],
            [
                'name' => 'c_order[note]',
                'note' => 'Ghi chú công nợ',
                'type' => 'textarea'
            ]
        ];
    @endphp
    @foreach ($order_field_update as $order_field)
        @include('view_update.view', $order_field)    
    @endforeach
    @if (@$action == 'insert')
        @foreach ($c_order_fields as $c_order_field)
            @include('view_update.view', $c_order_field)    
        @endforeach    
    @endif
    @include('view_update.view', 
    [
        'name' => 'order[ship_note]',
        'note' => 'Ghi chú giao hàng',
        'type' => 'textarea',
        'value' => @$data_order['ship_note']
    ])
</div>