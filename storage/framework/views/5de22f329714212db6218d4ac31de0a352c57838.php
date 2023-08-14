
<?php $__env->startSection('content'); ?>
<div class="base_content_view">
    <div class="supply_list">
        <?php $__currentLoopData = $supply_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(url('view/'.$supply['table'].'?default_data={"type":"'.$supply['type'].'","status":"imported"}')); ?>" class="device_supp_item">
                <?php echo e(@$supply['note']); ?>

            </a>    
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/warehouses/view.blade.php ENDPATH**/ ?>