@php
	$time = $data[$field['name']]!=''?date('d/m/y', strtotime($data[$field['name']])):date('d/m/y', Time())
@endphp
<p class="mb-0">{{ $time }}</p>