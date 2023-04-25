<ul>
    <?php if(!empty($stage['supp_qty'])): ?>
        <li>
            <span>SL tờ in: </span>
            <strong class="color_red"><?php echo e($stage['supp_qty']); ?></strong>
        </li>
    <?php endif; ?>

    <?php if(!empty($stage['machine'])): ?>
        <li>
            <span>Thiết bị: </span>
            <strong class="color_red"><?php echo e(getFieldDataById('name', 'devices', $stage['machine'])); ?></strong>
        </li>
    <?php endif; ?>

    <?php
        $float = !empty($stage['float']) ? $stage['float'] : []
    ?>

    <?php if(!empty($float)): ?>
        <?php if(!empty($float['price'])): ?>
            <li>
                <span>Chi phí thúc nổi 1 SP: </span>
                <strong class="color_red"><?php echo e(number_format((float) $float['price'])); ?>đ</strong>
            </li>
        <?php endif; ?>  
        <?php if(!empty($float['shape_price'])): ?>
            <li>
                <span>Giá khuôn thúc nổi 1 SP: </span>
                <strong class="color_red"><?php echo e(number_format((float) $float['shape_price'])); ?>đ</strong>
            </li>
        <?php endif; ?> 
        <?php if(!empty($float['nqty'])): ?>
            <li>
                <span>Số bát: </span>
                <strong class="color_red"><?php echo e($float['nqty']); ?></strong>
            </li>
        <?php endif; ?> 
        <?php if(!empty($float['qty_pro'])): ?>
            <li>
                <span>SL sản phẩm: </span>
                <strong class="color_red"><?php echo e($float['qty_pro']); ?></strong>
            </li>
        <?php endif; ?>           
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
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính Chi Phí Máy Bế</p>
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
                Dài (<?php echo e($size['length']); ?>) x Rộng x ĐG vật tư x SL tờ in cả BH  x Hệ số
            </p>
            <p class="font_bold formula_result mr-2"> = <?php echo e($size['length']); ?> x <?php echo e($size['width']); ?> x 0 x <?php echo e($stage['supp_qty']); ?> x 1</p>
            <p class="font_bold formula_result"> = 0đ</p>
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
                SL tờ in cả BH x ĐG lượt  x  Hệ số
            </p>
            <p class="font_bold formula_result"> = <?php echo e($stage['supp_qty']); ?> x <?php echo e($stage['work_price']); ?> x 1</p>
            <p class="font_bold formula_result"> = <?php echo e(number_format($stage['supp_qty'] * $stage['work_price'])); ?>đ</p>
        </div>
    </div>
    <p class="fs-15 font_bold">Tổng chi phí cho máy bế: (1) + (2) + (3) + (4) = <?php echo e(number_format($stage['cost'])); ?>đ</p>       
</div>

<?php if(!empty($float)): ?>
    <div class="mt-2 pt-2 border_top_thin formula_tab">
        <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính Chi Phí Thúc Nổi</p>
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Chi phí thúc nổi:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">(SL sản phẩm cả BH x Chi phí thúc nổi 1 SP) + (Số bát x Giá khuôn thúc nổi 1 SP)</p>
                <p class="font_bold formula_result mr-2"> = (<?php echo e($float['price']); ?> x <?php echo e($float['qty_pro']); ?>) x (<?php echo e($float['nqty']); ?> x <?php echo e($float['shape_price']); ?>)</p>
                <p class="font_bold formula_result"> = <?php echo e(number_format(($float['price'] * $float['qty_pro']) + ($float['nqty']) * $float['shape_price'])); ?>đ</p>
            </div>
        </div>
        <p class="fs-15 font_bold">Tổng chi phí thúc nổi: = <?php echo e(number_format($float['float_cost'])); ?>đ</p>       
    </div>    
<?php endif; ?>

<div class="mt-2 pt-2 border_top_thin">
    <p class="fs-15 font_bold color_red">Tổng chi phí : Tổng chi phí máy bế + Tổng chi phí thúc nổi = <?php echo e((int) @$stage['cost']); ?> + <?php echo e((int) @$float['float_cost']); ?> = <?php echo e(number_format($stage['total'])); ?>đ</p>       
</div>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/profits/papers/elevate.blade.php ENDPATH**/ ?>