@php
	$time = @$data[$field['name']]!=''?date('m/d/Y', strtotime(@$data[$field['name']])):date('m/d/Y', Time())
@endphp
<p class="mb-0 text-center">{{ $time }}</p>