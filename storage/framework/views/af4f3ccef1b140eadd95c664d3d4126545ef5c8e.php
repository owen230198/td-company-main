<?php
    $type = !empty($type) ? $type : 'text';
?>
<?php if($type == 'group'): ?>
    <?php echo $__env->make('view_update.'.$type, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <div class="form-group d-flex mb-2">
        <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
            <?php if(@$attr['required'] == 1): ?>
                <span class="fs-15 mr-1">*</span>
            <?php endif; ?>
            <?php echo e($note); ?> 
        </label>
        <?php echo $__env->make('view_update.'.$type, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?><?php /**PATH /var/www/html/td-company-app/resources/views/view_update/view.blade.php ENDPATH**/ ?>