<form action="<?php echo e(asset('do-update/'.$table_map.'/'.$id.'').'?ajax=1'); ?>" method="POST" class="baseAjaxForm">
	<?php echo csrf_field(); ?>
	<?php echo $__env->make('view_update.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_table/checkbox.blade.php ENDPATH**/ ?>