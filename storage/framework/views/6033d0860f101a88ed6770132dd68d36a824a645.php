<?php
	$select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
	$list_options = !empty($select_data['options']) ? $select_data['options'] : [];
?>
<div class="d-flex align-items-center w-100">
	<select name="<?php echo e($name); ?>" class="form-control<?php echo e(@$select_config['searchbox']?' select_config' : ''); ?>

	<?php echo e(@$attr['inject_class'] ? ' '.$attr['inject_class'] : ''); ?>" 
	<?php echo e(@$attr['placeholder'] ? 'placehoder='.$attr['placeholder'] : ''); ?> <?php echo e(@$attr['inject_attr'] ?? ''); ?>>
		<?php $__currentLoopData = $list_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<option value="<?php echo e($key); ?>" <?php echo e(@$value == $key ? 'selected' : ''); ?>>
				<?php echo e($option); ?>

			</option>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</select>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/select.blade.php ENDPATH**/ ?>