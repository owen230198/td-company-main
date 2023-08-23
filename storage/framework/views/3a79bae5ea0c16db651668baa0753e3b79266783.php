<div class="d-flex align-items-end">
    <div class="infor">
        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $field['value'] = !empty($data_customer[$field['name']]) ? $data_customer[$field['name']] : '';
            ?>
            <?php echo $__env->make('view_update.view', $field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="group_btn_action_form_chose_customer d-flex align-items-center mb-2 ml-5">
        <button type="submit" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-3">
        <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
        </button>
        <a href="<?php echo e(url('')); ?>" class="main_button bg_red color_white smooth radius_5 font_bold smooth red_btn">
        <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
        </a>
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/quotes/customer_info.blade.php ENDPATH**/ ?>