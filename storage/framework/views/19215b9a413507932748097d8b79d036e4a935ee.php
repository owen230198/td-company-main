<ul>
    <?php if(!empty($stage['price'])): ?>
        <li>
            <span>Chi phí thúc nổi 1 SP: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['price'])); ?>đ</strong>
        </li>
    <?php endif; ?>  
    <?php if(!empty($stage['shape_price'])): ?>
        <li>
            <span>Giá khuôn thúc nổi 1 SP: </span>
            <strong class="color_red"><?php echo e(number_format((float) $stage['shape_price'])); ?>đ</strong>
        </li>
    <?php endif; ?> 
    <?php if(!empty($stage['nqty'])): ?>
        <li>
            <span>Số bát: </span>
            <strong class="color_red"><?php echo e($stage['nqty']); ?></strong>
        </li>
    <?php endif; ?> 
    <?php if(!empty($stage['qty_pro'])): ?>
        <li>
            <span>SL sản phẩm: </span>
            <strong class="color_red"><?php echo e($stage['qty_pro']); ?></strong>
        </li>
    <?php endif; ?>
</ul>

<?php if(!empty($stage)): ?>
    <div class="mt-2 pt-2 border_top_thin formula_tab">
        <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính Chi Phí Thúc Nổi</p>
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Chi phí thúc nổi:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">(SL sản phẩm cả BH x Chi phí thúc nổi 1 SP) + (Số bát x Giá khuôn thúc nổi 1 SP)</p>
                <p class="font_bold formula_result mr-2"> = (<?php echo e($stage['price']); ?> x <?php echo e($stage['qty_pro']); ?>) + (<?php echo e($stage['nqty']); ?> x <?php echo e($stage['shape_price']); ?>)</p>
                <p class="font_bold formula_result"> = <?php echo e(number_format(($stage['price'] * $stage['qty_pro']) + ($stage['nqty']) * $stage['shape_price'])); ?>đ</p>
            </div>
        </div>
        <p class="fs-15 font_bold">Tổng chi phí thúc nổi: = <?php echo e(number_format($stage['total'])); ?>đ</p>       
    </div>    
<?php endif; ?>
<?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/quotes/profits/papers/float.blade.php ENDPATH**/ ?>