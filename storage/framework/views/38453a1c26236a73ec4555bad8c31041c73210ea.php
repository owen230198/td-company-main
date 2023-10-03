<?php
	$time = !empty($value) ? date('d/m/Y H:i', strtotime($value)) : date('d/m/Y', Time())
?>
<p class="mb-0 text-center w_max_content"><?php echo e($time); ?></p><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/view_table/datetime.blade.php ENDPATH**/ ?>