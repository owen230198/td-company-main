<?php
    $check_disabled = @$attr['type_input'] == 'password' && @$value != '';
?>
<input type="<?php echo e(@$attr['type_input'] ?? 'text'); ?>" 
class="form-control<?php echo e(@$attr['inject_class'] ? ' '.$attr['inject_class'] : ''); ?>" name="<?php echo e($name); ?>" value="<?php echo e(@$value); ?>"
<?php echo e(@$attr['disable_field'] == 1 || ($check_disabled) ? 'disabled' : ''); ?>

<?php echo e(@$attr['readonly'] == 1 ? 'readonly' : ''); ?>

<?php echo e(@$attr['type_input'] == 'number' ? 'min=0 step=any' : ''); ?> 
placeholder="<?php echo e(@$attr['placeholder'] ?? 'Nhập '.mb_strtolower($note)); ?>">
<?php if($check_disabled): ?>
    <button type="button" class="p-2 bg_green color_white box_shadow_3 ml-2 __pass_change"><i class="fa fa-pencil-square-o mr-1" aria-hidden="true"></i></button>    
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/text.blade.php ENDPATH**/ ?>