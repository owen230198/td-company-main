
<?php $__env->startSection('content'); ?>
    <div class="dashborad_content">
        <ul class="nav nav-pills mb-3 quote_pro_strct_nav_link" id="element-tab" role="tablist">
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($element['data'])): ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo e($key == 0 ? ' active' : ''); ?>" id="element-<?php echo e($element['key']); ?>-tab" data-toggle="pill" href="#element-<?php echo e($element['key']); ?>" 
                        role="tab" aria-controls="element-<?php echo e($element['key']); ?>" aria-selected="true"><?php echo e($element['note']); ?></a>
                    </li>   
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>  
    </div>
    <div class="tab-content" id="element-tabContent">
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $admins = new \App\Services\AdminService;
                $table_arr = $admins->getBaseTable($element['table']);
                $table_arr['data_tables'] = $element['data'];
            ?>
            <?php if(!empty($element['data'])): ?>
                <div class="tab-pane fade<?php echo e($key == 0 ? ' show active' : ''); ?> tab_pane_quote_pro" id="element-<?php echo e($element['key']); ?>" role="tabpanel" aria-labelledby="element-<?php echo e($element['key']); ?>-tab">
                    <?php echo $__env->make('table.table_base_view', $table_arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/products/view.blade.php ENDPATH**/ ?>