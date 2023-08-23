<ul>
    <?php if(!empty($stage['qty_pro'])): ?>
        <li>
            <span>SL sản phẩm: </span>
            <strong class="color_red"><?php echo e($stage['qty_pro']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['nqty'])): ?>
        <li>
            <span>SL sản phẩm: </span>
            <strong class="color_red"><?php echo e($stage['nqty']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['price'])): ?>
        <li>
            <span>Chi phí ép nhũ 1 SP: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['shape_price'])): ?>
        <li>
            <span>Giá khuôn ép nhũ 1 SP: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['shape_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['machine'])): ?>
        <li>
            <span>Thiết bị: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'devices', $stage['machine'])); ?></strong>
        </li>
    <?php endif; ?>
</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">Chi phí ép nhũ:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">(SL sản phẩm cả BH x Chi phí ép nhũ 1 SP) + (Số bát x Giá khuôn ép nhũ 1 SP) </p>
            <p class="font_bold formula_result mr-2"> = (<?php echo e($stage['qty_pro']); ?> x <?php echo e($stage['price']); ?>) + (<?php echo e($stage['nqty']); ?> x <?php echo e($stage['shape_price']); ?>)</p>
            <p class="font_bold formula_result"> = <?php echo e(number_format(($stage['qty_pro'] * $stage['price']) + ($stage['nqty'] * $stage['shape_price']))); ?>đ</p>
        </div>
    </div>
    <p class="fs-15 color_red font_bold">Tổng chi phí ép nhũ: = <?php echo e(number_format($stage['total'])); ?>đ</p>       
</div><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/quotes/profits/papers/compress.blade.php ENDPATH**/ ?>