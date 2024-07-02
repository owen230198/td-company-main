@php
    $wh_name = 'over_supply['.$index.']';
    $field_warehouses = [
        [
            'name' => $wh_name.'[length]',
            'note' => 'Băng lề chiều dài',
            'attr' => ['type_input' => 'number', 'inject_class' => 'plan_input_warehouse_size'],
            'type' => 'text',
            'value' => 0,
        ],
        [
            'name' => $wh_name.'[width]',
            'note' => 'Băng lề chiều rộng',
            'attr' => ['type_input' => 'number', 'inject_class' => 'plan_input_warehouse_size'],
            'type' => 'text',
            'value' => 0,
        ],
        [
            'name' => $wh_name.'[qty]',
            'note' => 'SL nhập kho',
            'attr' => [ 'type_input' => 'number', 'inject_class' => 'plan_input_warehouse_qty', 'readonly' => 1],
            'type' => 'text',
            'value' => 0,
        ],
        [
            'name' => $wh_name.'[note]',
            'note' => 'Ghi chú',
            'type' => 'textarea',
            'value' => ''
        ]
    ]    
@endphp
@foreach ($field_warehouses as $field_warehouse)
    @include('view_update.view', $field_warehouse)     
@endforeach