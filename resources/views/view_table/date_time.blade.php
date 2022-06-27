@php
	$time = $data[$field['name']]!=''?$data[$field['name']]:date('d/m/y, h:i:s A', Time())
@endphp
<p class="mb-0">{{ $time }}</p>