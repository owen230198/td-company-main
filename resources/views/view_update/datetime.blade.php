@php
	$time_stamp = !empty($value) ? strtotime($value) : Time();
	$time = date('d/m/Y H:i', $time_stamp);
@endphp
<input type="text" name="{{ $name}}" value="{{ $time }}" class="form-control max_w_200 inputDatePicker">