<ul>
    <?php if(!empty($stage['supp_qty'])): ?>
        <li>
            <span>SL tờ in: </span>
            <strong class="color_red"><?php echo e($stage['supp_qty']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['materal'])): ?>
        <li>
            <span>Mực in: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'materals', $stage['materal'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['materal_price'])): ?>
        <li>
            <span>ĐG mực in: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['materal_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['face'])): ?>
        <li>
            <span>Số mặt in: </span>
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
            <span>ĐG Chi phí khuôn: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['model_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['shape_price'])): ?>
        <li>
            <span>ĐG chỉnh máy: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['shape_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['work_price'])): ?>
        <li>
            <span>ĐG lượt: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['work_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>
</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    <?php
        convertCmToMeter($size['length'], $size['width'])
    ?>
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">(1) Chi phí vật tư khuôn:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">Dài x Rộng x ĐG Chi phí khuôn </p>
            <p class="font_bold formula_result mr-2"> = <?php echo e($size['length']); ?> x <?php echo e($size['width']); ?> x <?php echo e($stage['model_price']); ?></p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($size['length'] * $size['width'] * $stage['model_price'])); ?>đ</p>
        </div>
    </div>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">(2) Chi phí vật tư:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">
                Dài (<?php echo e($size['length']); ?>) x Rộng x ĐG mực in x SL tờ in cả BH  x Số mặt in
            </p>
            <p class="font_bold formula_result mr-2"> = <?php echo e($size['length']); ?> x <?php echo e($size['width']); ?> x <?php echo e($stage['materal_price']); ?> x <?php echo e($stage['supp_qty']); ?> x <?php echo e($stage['face']); ?></p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($size['length'] * $size['width'] * $stage['materal_price'] * $stage['supp_qty'] * $stage['face'])); ?>đ</p>
        </div>
    </div>   
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">(3) Chi phí chỉnh máy:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">
                ĐG chỉnh máy (<?php echo e($stage['shape_price']); ?>)
            </p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($stage['shape_price'])); ?>đ</p>
        </div>
    </div> 
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">(4) Chi phí lượt:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">
                SL tờ in cả BH x ĐG lượt  x  Số mặt in
            </p>
            <p class="font_bold formula_result"> = <?php echo e($stage['supp_qty']); ?> x <?php echo e($stage['work_price']); ?> x <?php echo e($stage['face']); ?></p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($stage['supp_qty'] * $stage['work_price'] * $stage['face'])); ?>đ</p>
        </div>
    </div>
    <p class="fs-15 color_red font_bold">Tổng chi phí cho máy in UV: (1) + (2) + (3) + (4) = <?php echo e(number_format($stage['total'])); ?>đ</p>       
</div><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/quotes/profits/papers/uv.blade.php ENDPATH**/ ?>