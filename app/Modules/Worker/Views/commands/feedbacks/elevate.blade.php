@php
    $num = [
        'name' => 'shape',
        'type' => 'select',
        'note' => 'số khuôn đúng',
        'min_label' => 150,
        'value' => @$value['shape'],
        'other_data' => ['data' => ['options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6]]]
    ];
    $float = [
        'name' => 'float',
        'type' => 'select',
        'note' => 'Thúc nổi',
        'min_label' => 150,
        'value' => !empty($value['float']['act']),
        'other_data' => ['data' => ['options' => ['Không', 'Có']]]
    ];
@endphp
@include('view_update.view', $float)
@include('view_update.view', $num)