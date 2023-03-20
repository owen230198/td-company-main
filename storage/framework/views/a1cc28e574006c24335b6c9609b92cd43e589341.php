<input type="<?php echo e(@$attr['type_input'] ?? 'text'); ?>" 
class="form-control<?php echo e(@$attr['inject_class'] ? ' '.$attr['inject_class'] : ''); ?>" name="<?php echo e($name); ?>" value="<?php echo e(@$value); ?>" 

<?php echo e(@$attr['disable_field'] == 1 ? 'disabled' : ''); ?>

<?php echo e(@$attr['type_input'] == 'number' ? 'min=0 step=any' : ''); ?> 
placeholder="<?php echo e(@$attr['placeholder'] ?? 'Nhập '.strtolower($note)); ?>"><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/text.blade.php ENDPATH**/ ?>