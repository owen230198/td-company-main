<div class="module_quote_supp_config">
    <div class="list_supp_item">
        <?php if(!empty($data_supply)): ?>
            <?php $__currentLoopData = $data_supply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supp_index => $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $supply->size = !empty($supply->size) ? json_decode($supply->size, true) : [];
                ?>
                <?php echo $__env->make('quotes.products.'.$supp_view.'.ajax_view', ['supp_index' => $supp_index, 'supply_obj' => $supply, 'supply_size' => $supply->size], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php echo $__env->make('quotes.products.'.$supp_view.'.ajax_view', ['supp_index' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
        <?php endif; ?>
    </div>
    <div class="text-center my-3">
        <button type="button" data-product="<?php echo e($pro_index); ?>" data-key=<?php echo e($supp_view); ?>

        class="main_button color_white bg_green border_green radius_5 font_bold sooth add_supp_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm vật tư
        </button>
    </div> 
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/supplies/view.blade.php ENDPATH**/ ?>