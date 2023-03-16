<?php
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:0;
	}
?>
<div class="checkbox_module d-flex align-items-center">
	<input type="hidden" name="<?php echo e(@$field['table_map']=='orders'?'order['.$name.']':$name); ?>" value = <?php echo e($value); ?>>
	<input type="checkbox" name="" class="toggle" <?php echo e($value==1?'checked':''); ?>/>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/checkbox.blade.php ENDPATH**/ ?>