<div class="group_class_view <?php echo e(@$other_data['group_class']); ?>" <?php echo e(@$other_data['inject_attr']); ?>>
    <div class="row">
        <?php $__currentLoopData = $child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 align-self-center">
                <?php echo $__env->make('view_search.view', ['field' => $field_child], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
    </div> 
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_search/group.blade.php ENDPATH**/ ?>