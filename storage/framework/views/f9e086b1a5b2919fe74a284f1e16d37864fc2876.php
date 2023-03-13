<?php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $list_options = getOptionDataField($select_data);
?>
<select class="multiple_select" multiple="multiple" data-note="<?php echo e($note); ?>">
    <?php if(!empty($list_options)): ?>
        <?php $__currentLoopData = $list_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e(@$option->id); ?>"><?php echo e($option->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>  
</select><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/multiplechoicelinking.blade.php ENDPATH**/ ?>