<?php 
	$name = @$field['name']?$field['name']:'';
	$value = isset($data[$name])?$data[$name]:'';
?>
<div class="checkbox_module">
	<input type="hidden" name="{{ $name }}" value = {{ $value }}>
	<input type="checkbox" name="" class="toggle" {{ $value=='1'?'checked':'' }}/>
</div>