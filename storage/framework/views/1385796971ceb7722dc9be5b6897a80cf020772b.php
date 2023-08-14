<form action="<?php echo e(asset('update/'.$table_map.'/'.$obj_id.'')); ?>" method="POST" class="checkbox_module baseAjaxForm">
	<?php echo csrf_field(); ?>
	<?php echo $__env->make('view_update.checkbox', ['change_submit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_table/checkbox.blade.php ENDPATH**/ ?>