@php
    $face_num = [
        'name' => 'face',
        'type' => 'select',
        'note' => 'số mặt cán đúng',
        'min_label' => 150,
        'value' => @$value['face'],
        'other_data' => ['data' => ['options' => [1 => 1, 2 => 2]]]
    ];
@endphp
@include('view_update.view', $face_num)

@php
    $cover_face_num = [
        'name' => 'cover_face',
        'type' => 'select',
        'note' => 'số mặt cán phủ đúng',
        'min_label' => 150,
        'value' => @$value['cover_face'],
        'other_data' => ['data' => ['options' => [1 => 1, 2 => 2]]]
    ];
@endphp
@include('view_update.view', $cover_face_num)