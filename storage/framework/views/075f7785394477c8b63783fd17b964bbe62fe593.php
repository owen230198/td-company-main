<?php
    $elements = isHardBox($cate) ? \TDConst::HARD_ELEMENT : \TDConst::PAPER_ELEMENT;
?>
<?php if(count($elements) > 1): ?>
    <ul class="nav nav-pills mb-3 quote_pro_strct_nav_link" id="quote-pro-<?php echo e($pro_index); ?>-struct-tab" role="tablist">
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link<?php echo e($key == 0 ? ' active' : ''); ?>" id="quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>-tab" data-toggle="pill" href="#quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>" 
                role="tab" aria-controls="quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>" aria-selected="true"><?php echo e($element['note']); ?></a>
            </li>   
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <div class="tab-content" id="quote-pro-<?php echo e($pro_index); ?>-struct-tabContent">
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade<?php echo e($key == 0 ? ' show active' : ''); ?> tab_pane_quote_pro" id="quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>" role="tabpanel" aria-labelledby="quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>-tab">
                <?php echo $__env->make('quotes.products.'.$element['key'].'.view', ['pindex' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <?php echo $__env->make('quotes.products.supplies.view', ['supp_view' => 'papers', 'data_supply' => @$product['paper']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/structure.blade.php ENDPATH**/ ?>