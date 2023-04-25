<ul>
    <?php if(!empty($stage['qty_pro'])): ?>
        <li>
            <span>SL sản phẩm: </span>
            <strong class="color_red"><?php echo e($stage['qty_pro']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['type'])): ?>
        <li>
            <span>Loại nam châm: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'supply_prices', $stage['type'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['qttv_price'])): ?>
        <li>
            <span>ĐG nam châm: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['qttv_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['qty'])): ?>
        <li>
            <span>SL nam châm/hộp: </span>
            <strong class="color_red"><?php echo e($stage['qty']); ?></strong>
        </li>
    <?php endif; ?>
</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">Chi phí vật tư nam châm:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">(SL sản phẩm x ĐG nam châm) x (SL nam châm/hộp x <?php echo e($stage['magnet_perc']); ?>%) </p>
            <p class="font_bold formula_result mr-2"> = (<?php echo e($stage['qty_pro']); ?> x <?php echo e($stage['qttv_price']); ?>) x (<?php echo e($stage['qty']); ?> x <?php echo e($stage['magnet_perc']); ?>%)</p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($stage['total'])); ?>đ</p>
        </div>
    </div>
    <p class="fs-15 color_red font_bold">Tổng chi phí cho vật tư nam châm: <?php echo e(number_format($stage['total'])); ?>đ</p>       
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/profits/fill_finishes/magnet.blade.php ENDPATH**/ ?>