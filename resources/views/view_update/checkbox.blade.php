@php
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:0;
	}
@endphp
<div class="checkbox_module">
	<input type="hidden" name="{{ @$field['table_map']=='orders'?'order['.$name.']':$name }}" value = {{ $value }}>
	<input type="checkbox" name="" class="toggle" {{ $value==1?'checked':'' }}/>
</div>