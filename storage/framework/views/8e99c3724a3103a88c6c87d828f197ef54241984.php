<?php
    $type = !empty($field['type']) ? $field['type'] : 'text';
    $field['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
    $field['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
?>
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
        <?php echo e($field['note']); ?> 
    </label>
    <?php echo $__env->make('view_search.'.$type, $field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_search/view.blade.php ENDPATH**/ ?>