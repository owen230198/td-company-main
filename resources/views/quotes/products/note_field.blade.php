@php
    $pro_supply_note = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][note]',
        'type' => 'textarea',
        'note' => 'Ghi chú',
        'value' => @$supply_obj->note
    ];
@endphp
@include('view_update.view', $pro_supply_note)