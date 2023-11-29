<form action="<?php echo e(@$action_url ?? url('change-password')); ?>" method="POST" class="baseAjaxForm">
    <?php echo csrf_field(); ?>
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
                'note' => 'Xác nhận mật khẩu mới',
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
</form><?php /**PATH /var/www/html/td-company-app/resources/views/change_password_base_form.blade.php ENDPATH**/ ?>