@php
    $value = @$value == '' ? 'Chưa có nội dung' : $value;
@endphp
<p class="mb-0 w_max_content">{{ !empty($attr['type_input']) && $attr['type_input'] == 'price' ? number_format((float)$value) : @$value }}</p>