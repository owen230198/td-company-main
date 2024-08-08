@php
    $float = [
        'name' => 'float',
        'type' => 'select',
        'note' => 'Thúc nổi',
        'min_label' => 150,
        'value' => !empty($value['float']),
        'other_data' => ['data' => ['options' => ['Không', 'Có']]]
    ];
@endphp
@include('view_update.view', $float)