@php
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = isset($data[$name])?$data[$name]:''; 
	}
@endphp
<input type="{{ @$field['type_input']??'text' }}" class="form-control" 
name="{{ @$field['table_map']=='orders'?'order['.$name.']':$name }}" value="{{ $value }}" 
{{ @$field['required']==1?'required':'' }} {{ @$field['disable_field']==1?'disabled':'' }}
{{ @$field['type_input']=='number'?'min=0':'' }}>