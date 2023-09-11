<?php
    $arr_value = !empty($value) ? json_decode($value, true) : [];
?>
<?php if(!empty($arr_value)): ?>
    <?php $__currentLoopData = $arr_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!empty($item_value['name']) && !empty($item_value['value'])): ?>
        <p class="d-flex align-items-center color_green mb-1">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            <?php echo e($item_value['name']); ?> : <?php echo e($item_value['value']); ?>.
        </p> 
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_table/json_name.blade.php ENDPATH**/ ?>