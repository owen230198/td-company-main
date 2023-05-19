<ul class="nav nav-pills mb-3" id="order-pro-tab" role="tablist">
    <label class="mb-0 min_210 mr-3"></label>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item">
            <a class="nav-link<?php echo e($i == 0 ? ' active' : ''); ?>" id="order-pro-<?php echo e($i); ?>-tab" data-toggle="pill" href="#order-pro-<?php echo e($i); ?>" 
            role="tab" aria-controls="order-pro-<?php echo e($i); ?>" aria-selected="true">
                <?php echo e(@$product['name']); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<div class="tab-content" id="order-pro-tabContent">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro_index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tab-pane fade<?php echo e($pro_index == 0 ? ' show active' : ''); ?> tab_pane_order_pro" id="order-pro-<?php echo e($pro_index); ?>" role="tabpanel" aria-labelledby="order-pro-<?php echo e($pro_index); ?>-tab">
            <div class="base_info_section mb-3">
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Tên sản phẩm: </label>
                    <p class="font_italic"><?php echo e($product['name']); ?></p>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Số lượng: </label>
                    <p class="font_italic"><?php echo e($product['qty']); ?></p>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Nhóm sản phẩm: </label>
                    <p class="font_italic">
                        <?php echo e(getFieldDataById('name', 'product_categories', $product['category'])); ?>   
                    </p>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Thiết kế: </label>
                    <p class="font_italic">
                        <?php echo e(getFieldDataById('name', 'design_types', $product['design'])); ?>   
                    </p>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Kích thước hộp: </label>
                    <p class="font_italic"><?php echo e($product['size']); ?></p>
                </div>
            </div>    
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/products/list.blade.php ENDPATH**/ ?>