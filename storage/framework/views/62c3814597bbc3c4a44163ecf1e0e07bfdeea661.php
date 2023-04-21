<ul>
    <?php if(!empty($stage['supp_qty'])): ?>
        <li>
            <span>SL tờ in: </span>
            <strong class="color_red"><?php echo e($stage['supp_qty']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['materal'])): ?>
        <li>
            <span>Chất liệu cán: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'materals', $stage['materal'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['materal_price'])): ?>
        <li>
            <span>ĐG chất liệu cán: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['materal_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['face'])): ?>
        <li>
            <span>Số mặt cán: </span>
            <strong class="color_red"><?php echo e($stage['face']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['machine'])): ?>
        <li>
            <span>Thiết bị: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'devices', $stage['machine'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['model_price'])): ?>
        <li>
            <span>Chi phí khuôn: </span>
            <strong class="color_red"><?php echo e(number_format((int) $stage['model_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['shape_price'])): ?>
        <li>
            <span>ĐG chỉnh máy: </span>
            <strong class="color_red"><?php echo e(number_format((int) $stage['shape_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['work_price'])): ?>
        <li>
            <span>ĐG lượt: </span>
            <strong class="color_red"><?php echo e(number_format((int) $stage['work_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>
</ul>
<div class="mt-3 p-2 formula_tab">
    <p class="fs-14 color_green mb-2">Công thức tính</p>
    <div class="formula_item d-flex align-items-center clor_brown">
        <p class="formula_name">(1) Chi phí vật tư khuôn:</p>
        <div class="formula_content">
            <?php
                convertCmToMeter($size['length'], $size['width'])
            ?>
            Dài (<?php echo e($size['length']); ?>) x Rộng (<?php echo e($size['width']); ?>)
        </div>
    </div>      
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/profits/papers/nilon.blade.php ENDPATH**/ ?>