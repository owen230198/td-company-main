<?php
    $pro_size = !empty($product['size']) ? json_decode($product['size']) : [];
?>
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
        Nhập kích thước hộp
    </label>
    <div class="d-flex align-items-center">
        <div class="size_item_pro_structure">
            <p class="text-center color_gray">1</p>
            <div class="d-flex justify-content-between align-items-center">
                <input type="number" name = 'product[<?php echo e($pro_index); ?>][size][length]' 
                placeholder="Dài" class="form-control short_input text-center struture_pro_input" step="any"
                value="<?php echo e(@$pro_size['length']); ?>">
            </div>
            <p class="text-center color_gray"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
        </div>
        <span class="mx-3">X</span>
        <div class="size_item_pro_structure">
            <p class="text-center color_gray">2</p>
            <div class="d-flex justify-content-between align-items-center">
                <input type="number" name = 'product[<?php echo e($pro_index); ?>][size][width]' 
                placeholder="Rộng" class="form-control short_input text-center struture_pro_input" step="any"
                value="<?php echo e(@$pro_size['width']); ?>">
            </div>
            <p class="text-center color_gray"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
        </div>
        <span class="mx-3">X</span>
        <div class="size_item_pro_structure">
            <p class="text-center color_gray">3</p>
            <div class="d-flex justify-content-between align-items-center height_input">
                <input type="number" name = 'product[<?php echo e($pro_index); ?>][size][height]' 
                placeholder="Cao" class="form-control short_input text-center struture_pro_input" step="any"
                value="<?php echo e(@$pro_size['height']); ?>">
                <p class="text-center ml-1 color_gray"><i class="fa fa-arrows-v fs-18" aria-hidden="true"></i></p>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/size.blade.php ENDPATH**/ ?>