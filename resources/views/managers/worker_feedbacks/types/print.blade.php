@php
    $print_color = [
        'name' => 'color',
        'type' => 'select',
        'note' => 'số màu in đúng',
        'min_label' => 150,
        'value' => @$value['color'],
        'other_data' => ['data' => ['options' => \TDConst::PRINT_COLOR]]
    ];
@endphp
@include('view_update.view', $print_color)