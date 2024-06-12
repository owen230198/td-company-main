@php
	$time = !empty($value) ? getDateTimeFormat($value) : date('d/m/Y H:i', Time())
@endphp
<p class="mb-0 text-center w_max_content">{{ $time }}</p>