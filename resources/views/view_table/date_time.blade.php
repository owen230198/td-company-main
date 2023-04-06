@php
	$time = @$data[$field['name']]!=''?date('m/d/Y H:i', strtotime(@$data[$field['name']])):date('m/d/Y H:i', Time())
@endphp
<p class="mb-0 text-center w_max_content">{{ $time }}</p>