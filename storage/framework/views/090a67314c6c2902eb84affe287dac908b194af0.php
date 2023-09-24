<?php
    $wh_name = 'over_supply['.$index.']';
    $field_warehouses = [
        [
            'name' => $wh_name.'[length]',
            'note' => 'Khổ chiều dài',
            'attr' => ['type_input' => 'number', 'inject_class' => 'plan_input_warehouse_size'],
            'type' => 'text',
            'value' => 0,
        ],
        [
            'name' => $wh_name.'[width]',
            'note' => 'Khổ chiều rộng',
            'attr' => ['type_input' => 'number', 'inject_class' => 'plan_input_warehouse_size'],
            'type' => 'text',
            'value' => 0,
        ],
        [
            'name' => $wh_name.'[qty]',
            'note' => 'SL nhập kho',
            'attr' => [ 'type_input' => 'number', 'inject_class' => 'plan_input_warehouse_qty', 'readonly' => 1],
            'type' => 'text',
            'value' => 0,
        ],
        [
            'name' => $wh_name.'[note]',
            'note' => 'Ghi chú',
            'type' => 'textarea',
            'value' => ''
        ]
    ]    
?>
<div class="__handle_supply_item position-relative <?php echo e($index > 0 ? 'mt-3 pt-3 border_top_eb' : ''); ?>" data-take = "0">
    <?php if($index > 0): ?>
        <button type="button" class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth __supply_handle_btn_remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button> 
    <?php endif; ?>
    <?php $__currentLoopData = $field_warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('view_update.view', $field_warehouse, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>     
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/supply_handles/view_handles/over_supplies/item.blade.php ENDPATH**/ ?>