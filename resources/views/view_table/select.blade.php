@php
	$default_data = json_decode($field['default_data']);
	$value = $data[$field['name']];
	$title = getNameByDefaultData($default_data->data, $value);
@endphp
<p class="color_main bg_eb px-3 py-1 radius_5 mb-0 text-center">
	<?= $title ?>
</p>