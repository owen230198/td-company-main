<div class="group_class_view <?php echo e(@$other_data['group_class']); ?>" <?php echo e(@$other_data['inject_attr']); ?>>
    <?php $__currentLoopData = $child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $arr = processArrField($field_child);
            $arr['value'] = @$dataItem[$field_child['name']];
        ?>
        <?php echo $__env->make('view_update.view', $arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/group.blade.php ENDPATH**/ ?>