@php
	$time = !empty($value) ? date('d/m/Y H:i', strtotime($value)) : date('d/m/Y', Time())
@endphp
<p class="mb-0 text-center w_max_content">{{ $time }}</p>