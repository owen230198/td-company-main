@php
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:''; 
	}
	$time_stamp = $value!=''?$value->getTimestamp():Time();
	$time = strftime('%Y-%m-%dT%H:%M:%S', $time_stamp);
@endphp
<input type="datetime-local" name="{{ $name }}" value="{{ $time }}" class="form-control">