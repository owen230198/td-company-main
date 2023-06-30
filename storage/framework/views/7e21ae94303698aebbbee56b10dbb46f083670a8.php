
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/order.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(@$link_action); ?>" method="POST" class="baseAjaxForm config_content __form_order" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        <?php echo csrf_field(); ?>
        <?php if(!empty($data_quote['id'])): ?>
            <input type="hidden" name="quote" value="<?php echo e($data_quote['id']); ?>">
        <?php endif; ?>
        <?php if(!empty($data_order['id'])): ?>
            <input type="hidden" name="order[id]" value="<?php echo e($data_order['id']); ?>">     
        <?php endif; ?>
        <?php echo $__env->yieldContent('main'); ?>
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            <?php if(!empty($stage)): ?>
                <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2 __apply_order" 
                data-id=<?php echo e($id); ?> data-stage="<?php echo e($stage); ?>">
                    <i class="fa fa-thumbs-o-up mr-2 fs-14" aria-hidden="true"></i>
                    <?php echo e(getOrderNameStageByKey($stage)); ?>

                </button> 
            <?php endif; ?>
            <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
                <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i>In đơn
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
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/main.blade.php ENDPATH**/ ?>