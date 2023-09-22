<?php
    $base_name = 'product['. $pro_index .']';
?>
<div class="d-flex align-items-center">
    <div class="size_item_pro_structure">
        <p class="text-center color_gray">1</p>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = '<?php echo e($base_name); ?>[length]' 
            placeholder="Dài" class="form-control short_input text-center __size_suggest_input __length_input" step="any"
            value="<?php echo e(@$product['length']); ?>">
        </div>
        <p class="text-center color_gray"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
    </div>
    <span class="mx-3">X</span>
    <div class="size_item_pro_structure">
        <p class="text-center color_gray">2</p>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = '<?php echo e($base_name); ?>[width]' 
            placeholder="Rộng" class="form-control short_input text-center __size_suggest_input __width_input" step="any"
            value="<?php echo e(@$product['width']); ?>">
        </div>
        <p class="text-center color_gray"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
    </div>
    <span class="mx-3">X</span>
    <div class="size_item_pro_structure">
        <p class="text-center color_gray">3</p>
        <div class="d-flex justify-content-between align-items-center height_input">
            <input type="number" name = '<?php echo e($base_name); ?>[height]' 
            placeholder="Cao" class="form-control short_input text-center __size_suggest_input __height_input" step="any"
            value="<?php echo e(@$product['height']); ?>">
            <p class="text-center ml-1 color_gray"><i class="fa fa-arrows-v fs-18" aria-hidden="true"></i></p>
            <p class="text-center ml-1 color_gray">cm</p>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/products/full_size.blade.php ENDPATH**/ ?>