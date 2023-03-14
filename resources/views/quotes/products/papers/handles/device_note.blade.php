@php
    $paper_device = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_device.'][machine]',
        'type' => 'linking',
        'note' => 'thiết bị',
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => $key_device], 'select' => ['id', 'name']]]
    ] 
@endphp
@include('view_update.view', $paper_device)

@php
    $paper_note = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_device.'][note]',
        'type' => 'textarea',
        'note' => 'ghi chú'
    ] 
@endphp
@include('view_update.view', $paper_note)