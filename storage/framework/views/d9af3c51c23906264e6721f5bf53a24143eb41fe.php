<ul>
    <?php if(!empty($stage['supp_qty'])): ?>
        <li>
            <span>SL tờ in cả BH: </span>
            <strong class="color_red"><?php echo e($stage['supp_qty']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['materal'])): ?>
        <li>
            <span>Chất liệu giấy: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'paper_materals', $stage['materal'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['materal_price'])): ?>
        <li>
            <span>ĐG chất liệu giấy: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['materal_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['qttv'])): ?>
        <li>
            <span>Định lượng: </span>
            <strong class="color_red"><?php echo e($stage['qttv']); ?></strong>
        </li>
    <?php endif; ?>
</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    <?php
        convertCmToMeter($size['length'], $size['width'])
    ?>
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">Chi phí vật tư giấy in:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">Dài x Rộng x ĐG giấy in x Định lượng (SL tờ in + BH giấy in) </p>
            <p class="font_bold formula_result mr-2"> = <?php echo e($size['length']); ?> x <?php echo e($size['width']); ?> x <?php echo e($stage['materal_price']); ?> x <?php echo e($stage['qttv']); ?> x <?php echo e($stage['supp_qty']); ?></p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($size['length'] * $size['width'] * $stage['materal_price'] * $stage['qttv'] * $stage['supp_qty'])); ?>đ</p>
        </div>
    </div>
    <p class="fs-15 color_red font_bold">Tổng chi phí cho vật tư giấy in: <?php echo e(number_format($stage['total'])); ?>đ</p>       
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/profits/papers/size.blade.php ENDPATH**/ ?>