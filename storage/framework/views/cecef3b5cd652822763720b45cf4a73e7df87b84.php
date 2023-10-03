<ul class="nav nav-pills mb-3 pro_nav_link" id="quote-pro-tab" role="tablist">
    <label class="mb-0 min_210 mr-3"></label>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item">
            <a class="nav-link<?php echo e($i == 0 ? ' active' : ''); ?>" id="quote-pro-<?php echo e($i); ?>-tab" data-toggle="pill" href="#quote-pro-<?php echo e($i); ?>" 
            role="tab" aria-controls="quote-pro-<?php echo e($i); ?>" aria-selected="true">
                <?php echo e(@$product['name']); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/quotes/products/list_tab.blade.php ENDPATH**/ ?>