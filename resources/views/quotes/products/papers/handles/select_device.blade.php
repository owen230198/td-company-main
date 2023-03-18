@php
    $paper_device = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_device.'][machine]',
        'type' => 'linking',
        'note' => 'thiết bị',
        'value' => @$value ?? 0,
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => $key_device], 'select' => ['id', 'name']]]
    ] 
@endphp
@include('view_update.view', $paper_device)