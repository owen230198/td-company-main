
<?php $__env->startSection('content'); ?>
<div class="base_content_view">
    <div class="device_list_by_supply">
        <?php $__currentLoopData = $supply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(url('view/printers?device='.$key)); ?>" class="device_supp_item">
                <?php echo e($tech); ?>

            </a>    
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/config_devices/print_techs/view.blade.php ENDPATH**/ ?>