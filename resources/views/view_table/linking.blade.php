@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $label = getFieldDataById($field_title, $select_data['table'], $value)
@endphp
<p class="color_main py-1 radius_5 mb-0 text-center linking_table">
	{{ $label }}
</p>