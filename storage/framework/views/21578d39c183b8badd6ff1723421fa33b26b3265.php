<?php
    $field_supply_type = \App\Models\SupplyBuying::getFeildSupplyJson($index, @$value);
?>
<div class="item_supp_buy mb-3 pb-3 border_bot_main position-relative" data-index = <?php echo e($index); ?>>
    <span class="d-flex color_red smooth remove_parent_element_button"><i class="fa fa-times" aria-hidden="true"></i></span> 
    <?php $__currentLoopData = $field_supply_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $jname = $item['name'];
            $item['value'] = @$value[$jname]; 
            $item['name'] = 'supply['.$index.']['.$jname.']';
            $item['dataItem'] = @$value;
        ?>
        <?php echo $__env->make('view_update.view', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/supply_buyings/supply_item.blade.php ENDPATH**/ ?>