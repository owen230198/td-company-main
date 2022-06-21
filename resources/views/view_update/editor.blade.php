<?php 
	$name = @$field['name']?$field['name']:'';
	$value = isset($data[$name])?$data[$name]:'';
	$type = @$field['default_data']?$field['default_data']:'text';
?>
<textarea class="tinymce" name="<?= $name ?>" <?= @$field['required']&&$field['required']==1?'required':'' ?>><?= $value ?></textarea>