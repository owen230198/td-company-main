@php
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:''; 
	}
	$time_stamp = $value!=''?strtotime($value):Time();
	$time = date('m/d/Y H:i', $time_stamp);
@endphp
<input type="text" name="{{ @$field['table_map']=='orders'?'order['.$name.']':$name }}" value="{{ @$time }}" class="form-control max_w_200 inputDatePicker">