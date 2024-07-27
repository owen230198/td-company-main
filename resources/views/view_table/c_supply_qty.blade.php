@php
    $value_qty = !empty($value) ? json_decode($value, true) : ['qty' => 0];
@endphp
@if (!empty($value_qty['hank']))
    <p class="d-flex align-items-center color_green mb-1 w_max_content">
        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
        Số cuộn : {{ $value_qty['hank'] }}.
    </p> 
@endif

@if (!empty($value_qty['weight']))
    <p class="d-flex align-items-center color_green mb-1 w_max_content">
        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
        Số kg : {{ $value_qty['weight'] }}.
    </p> 
@endif