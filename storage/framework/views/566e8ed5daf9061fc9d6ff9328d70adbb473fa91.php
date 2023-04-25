<ul>
    <?php if(!empty($stage['supp_qty'])): ?>
        <li>
            <span>SL vật tư cả BH: </span>
            <strong class="color_red"><?php echo e($stage['supp_qty']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['supply_type'])): ?>
        <li>
            <span>Loại vật tư: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'supplies', $stage['supply_type'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['supply_price'])): ?>
        <li>
            <span>Vật tư định lượng: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'supply_prices', $stage['supply_price'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['qttv_price'])): ?>
        <li>
            <span>ĐG vật tư: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['qttv_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($size['prescript_price'])): ?>
        <li>
            <span>Phát sinh vật tư cao cấp: </span>
            <strong class="color_red"><?php echo e(number_format((float) $size['prescript_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    <?php
        convertCmToMeter($size['length'], $size['width'])
    ?>
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">Chi phí vật tư:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">
                Dài x Rộng x ĐG x (SL vật tư + BH) <?php echo e(!empty($size['prescript_price']) ? ' + (Phát sinh vật tư cao cấp x SL vật tư)' : ''); ?>

            </p>
            <p class="font_bold formula_result mr-2"> = <?php echo e($size['length']); ?> x <?php echo e($size['width']); ?> x <?php echo e($stage['qttv_price']); ?> x <?php echo e($stage['supp_qty']); ?> <?php echo e(!empty($size['prescript_price']) ? ' + ('.$stage['prescript_price'].' x '. $stage['supp_qty'].')' : ''); ?></p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($stage['total'])); ?>đ</p>
        </div>
    </div>
    <p class="fs-15 color_red font_bold">Tổng chi phí cho vật tư: <?php echo e(number_format($stage['total'])); ?>đ</p>       
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/profits/supplies/size.blade.php ENDPATH**/ ?>