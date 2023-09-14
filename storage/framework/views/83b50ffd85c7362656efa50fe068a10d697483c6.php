
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6">
            <img src="<?php echo e(url('frontend/workers/images/auth_img.png')); ?>" alt="" class="w-100 mt-lg-4 mt-3">
        </div>
        <div class="col-lg-6">
            <h3 class="fs-15 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                <?php echo e($title); ?> - Công nhân: <?php echo e(\Worker::getCurrent('name')); ?>

            </h3>
            <p class="d-flex justify-content-center color_green mb-1 fs-14">
                <i class="fa fa-asterisk mr-1 color_yellow" aria-hidden="true"></i>
                Tên công nhân : <?php echo e(\Worker::getCurrent('name')); ?>

            </p> 
            <p class="d-flex justify-content-center color_green mb-1 fs-14">
                <i class="fa fa-asterisk mr-1 color_yellow" aria-hidden="true"></i>
                Số điện thoại : <?php echo e(\Worker::getCurrent('phone')); ?>

            </p> 
            <p class="d-flex justify-content-center color_green mb-1 fs-14">
                <i class="fa fa-asterisk mr-1 color_yellow" aria-hidden="true"></i>
                Tổ máy : <?php echo e(getDeviceGroupName(\Worker::getCurrent('type'), \Worker::getCurrent('device'))); ?>

            </p> 
            <form action="<?php echo e(url('Worker/change-password')); ?>" method="POST" class="baseAjaxForm mt-lg-4 mt-3">
                <?php
                    $arr_field = [
                        [
                            'name' => 'old_pass',
                            'note' => 'Mật khẩu cũ',
                            'attr' => ['type_input' => 'password']
                        ],
                        [
                            'name' => 'new_pass',
                            'note' => 'Mật khẩu mới',
                            'attr' => ['type_input' => 'password']
                        ],
                        [
                            'name' => 'confirm_pass',
                            'note' => 'Xác nhận mật hẩu mới',
                            'attr' => ['type_input' => 'password']
                        ],
                    ]
                ?> 
                <?php $__currentLoopData = $arr_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('view_update.view', $field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="mt-lg-4 mt-3 text-right">
                    <button type="submit" class="radius_5 box_shadow_3 main_button smooth mr-2 font_bold text-center bg_green color_white">
                        <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Hoàn tất
                    </button>  
                    <a href="<?php echo e(url('/Worker')); ?>" class="radius_5 box_shadow_3 main_button smooth font_bold text-center bg_red color_white">
                        <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Hủy
                    </a> 
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Worker::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\app/Modules/Worker/Views//change_password.blade.php ENDPATH**/ ?>