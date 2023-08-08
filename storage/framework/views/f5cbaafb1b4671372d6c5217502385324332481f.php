<div class="checkbox_module d-flex align-items-center">
	<input type="hidden" name="<?php echo e($name); ?>" value = "<?php echo e(@$value); ?>" class="change_submit <?php echo e(@$attr['inject_class']); ?>" <?php echo e(@$attr['inject_attr']); ?>>
	<input type="checkbox" name="" class="toggle" <?php echo e(@$value == 1 ? 'checked' : ''); ?>/>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/checkbox.blade.php ENDPATH**/ ?>