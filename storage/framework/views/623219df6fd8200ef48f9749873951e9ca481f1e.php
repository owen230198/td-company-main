
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(url('supply-handle')); ?>" method="POST" class="baseAjaxForm config_content" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e(@$supply_obj->id); ?>">
        <input type="hidden" name="table" value="<?php echo e(@$table); ?>">
        <input type="hidden" name="order" value="<?php echo e(@$supply_obj->order); ?>">
        <?php echo $__env->yieldContent('process'); ?>
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
                <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i>In lệnh
            </button>
            <a href="<?php echo e(url('')); ?>" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>  
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('frontend/admin/script/quote.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/admin/script/order.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/supplies.blade.php ENDPATH**/ ?>