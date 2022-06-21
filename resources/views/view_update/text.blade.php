<?php 
	$name = @$field['name']?$field['name']:'';
	$value = isset($data[$name])?$data[$name]:'';
	$type = @$field['default_data']?$field['default_data']:'text';
?>
<input type="{{ $type }}" class="form-control" name="{{ $name }}" value="{{ $value }}" {{ @$field['require']?'required':'' }} {{ $type=='number'?'min=1':'' }}>