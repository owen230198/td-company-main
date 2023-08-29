@php
    $wh_name = 'over_supply['.$index.']';
    $field_warehouses = [
        [
            'name' => $wh_name.'[name]',
            'note' => 'Tên',
            'type' => 'text',
            'value' => '',
        ],
        [
            'name' => $wh_name.'[length]',
            'note' => 'Khổ chiều dài',
            'attr' => ['type_input' => 'number'],
            'type' => 'text',
            'value' => 0,
        ],
        [
            'name' => $wh_name.'[width]',
            'note' => 'Khổ chiều rộng',
            'attr' => ['type_input' => 'number'],
            'type' => 'text',
            'value' => 0,
        ],
        [
            'name' => $wh_name.'[qty]',
            'note' => 'SL nhập kho',
            'attr' => [ 'type_input' => 'number'],
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
<div class="__handle_supply_item position-relative {{ $index > 0 ? 'mt-3 pt-3 border_top_eb' : '' }}" data-take = "0">
    @if ($index > 0)
        <button type="button" class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth __supply_handle_btn_remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button> 
    @endif
    @foreach ($field_warehouses as $field_warehouse)
        @include('view_update.view', $field_warehouse)     
    @endforeach
</div>