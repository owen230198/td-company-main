@php
    $value = !empty($data->total_amount) && !empty($data->qty) && (int) @$data->qty > 0 ? $data->total_amount / $data->qty : 0;
@endphp
<p class="mb-0 w_max_content">{{ !empty($attr['type_input']) && $attr['type_input'] == 'price' ? number_format($value).'đ' : @$value }}</p>