<ul>
    <?php if(!empty($stage['supp_qty'])): ?>
        <li>
            <span>SL tờ in cả BH: </span>
            <strong class="color_red"><?php echo e($stage['supp_qty']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['type'])): ?>
        <li>
            <span>Kiểu in: </span>
            <strong class="color_red"><?php echo e(\TDConst::PRINT_TYPE[$stage['type']]); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['color'])): ?>
        <li>
            <span>Số màu: </span>
            <strong class="color_red"><?php echo e(\TDConst::PRINT_COLOR[$stage['color']]); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['machine'])): ?>
        <li>
            <span>Công nghệ in: </span>
            <strong class="color_red"><?php echo e(\TDConst::PRINT_TECH[$stage['machine']]); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['printer'])): ?>
        <li>
            <span>Thiết bị máy in: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'printers', $stage['printer'])); ?></strong>
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

    <?php if(!empty($stage['print_factor'])): ?>
        <li>
            <span>HS in: </span>
            <strong class="color_red"><?php echo e($stage['print_factor']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['apla_factor'])): ?>
        <li>
            <span>Đơn giá in apla: </span>
            <strong class="color_red"><?php echo e($stage['apla_factor']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['apla_plus'])): ?>
        <li>
            <span>Chi phí cộng thêm khi in apla: </span>
            <strong class="color_red"><?php echo e(number_format($stage['apla_plus'])); ?>đ</strong>
        </li>
    <?php endif; ?>


</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    <?php
        convertCmToMeter($size['length'], $size['width'])
    ?>
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <?php if(@$stage['color'] == \TDConst::APLA_PRINT_COLOR): ?>
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Chi phí in apla:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">Dài x Rộng x ĐG in apla x HS in </p>
                <p class="font_bold formula_result mr-2"> = <?php echo e($size['length']); ?> x <?php echo e($size['width']); ?> x <?php echo e($stage['apla_factor']); ?> x <?php echo e($stage['print_factor']); ?></p>
                <p class="font_bold formula_result"> = <?php echo e(number_format($stage['apla_price'])); ?>đ</p>
            </div>
        </div>
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Tổng chi phí:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">(Số lượng tờ in x Chi phí in apla) + Chi phí ộng thêm khi in apla</p>
                <p class="font_bold formula_result mr-2"> = (<?php echo e($stage['supp_qty']); ?> x <?php echo e($stage['apla_price']); ?>) + <?php echo e($stage['apla_plus']); ?></p>
                <p class="font_bold formula_result color_red"> = <?php echo e(number_format($stage['total'])); ?>đ</p>
            </div>
        </div>
    <?php else: ?>
        <?php if(@$stage['type'] == \TDConst::ONE_PRINT_TYPE): ?>
            <div class="formula_item d-flex align-items-center color_brown mb-1">
                <p class="formula_name font_bold">Tổng chi phí:</p>
                <div class="formula_content d-flex align-items-center">
                    <p class="formula_param mx-2">(SL tờ in x Số màu x ĐG lượt) + (ĐG chỉnh máy x số màu) + (ĐG Chi phí khuôn x Số màu) </p>
                    <p class="font_bold formula_result mr-2"> = 
                        (<?php echo e($stage['supp_qty']); ?> x <?php echo e($stage['color']); ?> x <?php echo e($stage['work_price']); ?>) + (<?php echo e($stage['shape_price']); ?> x <?php echo e($stage['color']); ?>) + (<?php echo e($stage['model_price']); ?> x <?php echo e($stage['color']); ?>)
                    </p>
                    <p class="font_bold formula_result color_red"> = <?php echo e(number_format($stage['total'])); ?>đ</p>
                </div>
            </div>    
        <?php else: ?>
            <div class="formula_item d-flex align-items-center color_brown mb-1">
                <p class="formula_name font_bold">Tổng chi phí:</p>
                <div class="formula_content d-flex align-items-center">
                    <p class="formula_param mx-2">(SL tờ in x Số màu x 2 x ĐG lượt) + ((ĐG chỉnh máy x số màu) + (ĐG Chi phí khuôn x số màu)) </p>
                    <p class="font_bold formula_result mr-2"> = 
                        (<?php echo e($stage['supp_qty']); ?> x <?php echo e($stage['color']); ?> x 2 x <?php echo e($stage['work_price']); ?>) + ((<?php echo e($stage['shape_price']); ?> x <?php echo e($stage['color']); ?>) + (<?php echo e($stage['model_price']); ?> x <?php echo e($stage['color']); ?>))
                    </p>
                    <p class="font_bold formula_result color_red"> = <?php echo e(number_format($stage['total'])); ?>đ</p>
                </div>
            </div>     
        <?php endif; ?>
    <?php endif; ?>
</div><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/quotes/profits/papers/print.blade.php ENDPATH**/ ?>