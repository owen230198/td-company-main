<?php 
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:''; 
	}
?>
<textarea class="tinymce" name="<?= $name ?>" <?= @$field['required']&&$field['required']==1?'required':'' ?>><?= $value ?></textarea>