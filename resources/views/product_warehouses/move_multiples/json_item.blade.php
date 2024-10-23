@php
    $fields = \App\Models\ProductWarehouse::getFieldMove();
    $index = @$index ?? 0;
@endphp
<tr class="__item_move_warehouse" data-index="{{ $index }}">
   
    @foreach ($fields as $key => $field)
        @php
            $name = $field['name'];
            $field['name'] = 'move_warehouse['.$index.']['.$name.']';
            if ($key != 0) {
                $field['attr']['inject_class'] .= ' __data_move_field';
            }
        @endphp
        <td class="text-center">
            @include('view_update.'.$field['type'], $field)
        </td>
    @endforeach
    <td class="center">
        <span class="d-flex justify-content-center color_white smooth fs-15 __remove_move_warehouse_item __tiny_btn bg_red radius_5 box_shadow_3 align-items-center mx-auto">
            <i class="fa fa-times" aria-hidden="true"></i>
        </span>
    </td>
</tr>