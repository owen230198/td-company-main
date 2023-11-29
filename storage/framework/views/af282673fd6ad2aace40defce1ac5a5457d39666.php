<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
    <p class="mb-1"><?php echo e($supp_index == 0 ? 'Phần vật tư '.@$name : 'Vật tư '.@$name.' thêm '.$supp_index); ?></p>
    <?php if(!empty($divide)): ?>
        <p class="mb-1">Kích thước tấm <?php echo e(@$name); ?> là <?php echo e($divide[0]); ?> x <?php echo e($divide[1]); ?>cm</p>
    <?php endif; ?>
    <?php if(!empty($supply_obj->id)): ?>
        <a href="<?php echo e(url('print-data/supplies/'.$supply_obj->id)); ?>" target="_blank" class="main_button color_white bg_green border_green radius_5 font_bold sooth">
            <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i> In lệnh
        </a>
    <?php endif; ?>
</h3><?php /**PATH /var/www/html/td-company-app/resources/views/quotes/products/supplies/title_config.blade.php ENDPATH**/ ?>