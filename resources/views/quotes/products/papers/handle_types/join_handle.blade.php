@php
    $note_input = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']'.'[note]',
        'note' => 'Ghi chú in ghép',
        'type' => 'textarea',
        'value' => @$supply_obj->note
    ];
    $qty_input = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']'.'[qty]',
        'attr' => ['required' => 1, 'inject_class' => 'pro_qty_input'],
        'note' => 'Số lượng',
        'type' => 'text',
        'value' => @$supply_obj->product_qty
    ]
@endphp
@include('view_update.view', $qty_input)
@include('view_update.view', $note_input)
