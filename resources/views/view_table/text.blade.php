@if (@$attr['type_input'] == 'number' && !is_string($value))
    @dd(@$value);
@endif
<p class="mb-0 w_max_content">{{ @$attr['type_input'] == 'price' ? number_format(@$value) : @$value }}</p>