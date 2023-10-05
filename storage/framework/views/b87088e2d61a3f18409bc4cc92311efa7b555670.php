
<?php $__env->startSection('content'); ?>
    <div class=" row">
        <div class="col-6">
            <img src="<?php echo e(url('frontend/workers/images/auth_img.png')); ?>" alt="" class="w-100 mt-lg-4 mt-3">
        </div>
        <div class="col-6">
            <h3 class="fs-15 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                <?php echo e($title); ?> - Nhân viên: <?php echo e(\User::getCurrent('name')); ?>

            </h3>
            <?php echo $__env->make('change_password_base_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views//change_password.blade.php ENDPATH**/ ?>