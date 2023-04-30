<?php
	$time = !empty($value) ? date('d/m/Y', strtotime($value)) : date('d/m/Y', Time())
?>
<p class="mb-0 text-center w_max_content"><?php echo e($time); ?></p><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_table/datetime.blade.php ENDPATH**/ ?>