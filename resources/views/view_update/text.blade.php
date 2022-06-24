@php
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = isset($data[$name])?$data[$name]:''; 
	}
@endphp
<input type="text" class="form-control" name="{{ $name }}" value="{{ $value }}" {{ @$field['required']&&$field['required']==1?'required':'' }}>