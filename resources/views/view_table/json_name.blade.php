@php
    $arr_value = !empty($value) ? json_decode($value, true) : [];
@endphp
@if (!empty($arr_value))
    @foreach ($arr_value as $item_value)
        @if (!empty($item_value['name']) && !empty($item_value['value']))
        <p class="d-flex align-items-center color_green mb-1">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            {{ $item_value['name'] }} : {{ $item_value['value'] }}.
        </p> 
        @endif
    @endforeach
@endif