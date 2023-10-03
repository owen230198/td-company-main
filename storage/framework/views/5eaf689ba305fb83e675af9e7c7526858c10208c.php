<?php
	$time_stamp = !empty($value) ? strtotime($value) : Time();
	$time = date('d/m/Y H:i', $time_stamp);
?>
<input type="text" name="<?php echo e($name); ?>" value="<?php echo e($time); ?>" class="form-control max_w_200 inputDatePicker"><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/view_update/datetime.blade.php ENDPATH**/ ?>