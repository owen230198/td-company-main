<ul>
    <?php if(!empty($stage['qty_pro'])): ?>
        <li>
            <span>SL sản phẩm: </span>
            <strong class="color_red"><?php echo e($stage['qty_pro']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['machine'])): ?>
        <li>
            <span>Thiết bị: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'devices', $stage['machine'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['work_price'])): ?>
        <li>
            <span>ĐG lượt: </span>
            <strong class="color_red"><?php echo e($stage['work_price']); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['shape_price'])): ?>
        <li>
            <span>ĐG chỉnh máy: </span>
            <strong class="color_red"><?php echo e($stage['shape_price']); ?>đ</strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['ext_price'])): ?>
        <li>
            <span>ĐG Phát sinh chi tiết bồi khó: </span>
            <strong class="color_red"><?php echo e(number_format($stage['ext_price'])); ?>đ</strong>
        </li>
    <?php endif; ?>
</ul>
<div class="d-flex align-items-center mt-2 pt-2 border_top">
    <p class="font_bold">Các công đoạn bồi:</p>
    <ul class="ml-2 pl-2 list_stage_supply">
        <?php $__currentLoopData = $stage['stage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fstage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($fstage['cost'] > 0): ?>
                <li class="mb-1 pb-1">
                    <?php
                        convertCmToMeter($fstage['length'], $fstage['width'])
                    ?>
                    <div class="mb-2 d-flex align-items-center">
                        <span class="mr-1">Dài : </span>
                        <p class="font_bold"><?php echo e($fstage['length']); ?></p>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <span class="mr-1">Rộng : </span>
                        <p class="font_bold"><?php echo e($fstage['width']); ?></p>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <span class="mr-1">Giấy bồi : </span>
                        <p class="font_bold"><?php echo e(getFieldDataById('name', 'supply_prices', @$fstage['materal'])); ?></p>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <span class="mr-1">ĐG giấy bồi : </span>
                        <p class="font_bold"><?php echo e($fstage['qttv_price']); ?>đ</p>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <span class="mr-1">Chi phí : </span>
                        <p class="font_bold color_red">
                            ((Dài x Rộng x ĐG giấy bồi + ĐG lượt) x SL sản phẩm) + ĐG chỉnh máy = 
                            ((<?php echo e($fstage['length']); ?> x <?php echo e($fstage['width']); ?> x <?php echo e($fstage['qttv_price']); ?> + <?php echo e((float) @$stage['work_price']); ?>) x <?php echo e($stage['qty_pro']); ?>) + <?php echo e((float) @$stage['shape_price']); ?>

                             = <?php echo e(number_format((float) @$fstage['cost'])); ?>đ
                        </p>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>

<div class="mt-2 pt-2 border_top_thin formula_tab">
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">Chi phí bồi:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">Tổng chi phí công đoạn bồi + (SL sản phẩm x ĐG Phát sinh chi tiết bồi khó) </p>
            <p class="font_bold formula_result mr-2"> = <?php echo e($stage['fill_cost']); ?> + (<?php echo e($stage['qty_pro']); ?> x <?php echo e($stage['ext_price']); ?>)</p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($stage['total'])); ?>đ</p>
        </div>
    </div>
    <p class="fs-15 color_red font_bold">Tổng chi phí bồi: <?php echo e(number_format($stage['total'])); ?>đ</p>       
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/profits/fill_finishes/fill.blade.php ENDPATH**/ ?>