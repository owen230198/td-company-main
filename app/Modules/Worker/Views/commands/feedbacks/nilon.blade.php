@php
    $face_num = [
        'name' => 'face',
        'type' => 'select',
        'note' => 'số mặt cán đúng',
        'min_label' => 150,
        'other_data' => ['data' => ['options' => [1 => 1, 2 => 2]]]
    ];
@endphp
@include('view_update.view', $face_num)