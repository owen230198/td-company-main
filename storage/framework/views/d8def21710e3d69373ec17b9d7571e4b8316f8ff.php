
<?php $__env->startSection('content'); ?>
    <div class=" row">
        <div class="col-6">
            <img src="<?php echo e(url('frontend/workers/images/auth_img.png')); ?>" alt="" class="w-100 mt-lg-4 mt-3">
        </div>
        <div class="col-6">
            <div class="mb-4 pb-4 border_bot_eb">
                <h3 class="fs-15 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                    Cập nhật thông tin
                </h3>
                <form action="<?php echo e(url('account-detail')); ?>" method="POST" class="baseAjaxForm">
                    <?php echo csrf_field(); ?>
                    <?php
                        $arr_field = [
                            [
                                'name' => 'name',
                                'note' => 'Tên',
                                'attr' => ['disable_field' => 1],
                                'value' => @$profile['name']
                            ],
                            [
                                'name' => 'group_user',
                                'note' => 'Bộ phận',
                                'type' => 'linking',
                                'other_data' => ['data' => ['table' => 'n_group_users']],
                                'attr' => ['disable_field' => 1],
                                'value' => @$profile['group_user']
                            ],
                            [
                                'name' => 'email',
                                'note' => 'Email',
                                'value' => @$profile['email']
                            ],
                            [
                                'name' => 'phone',
                                'note' => 'SĐT',
                                'value' => $profile['phone']
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
                    </div>
                </form>
            </div>
            <div class="mb-4 pb-4 border_bot_eb">
                <h3 class="fs-15 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                    Thay đổi mật khẩu
                </h3>
                 <?php echo $__env->make('change_password_base_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/acount_detail.blade.php ENDPATH**/ ?>