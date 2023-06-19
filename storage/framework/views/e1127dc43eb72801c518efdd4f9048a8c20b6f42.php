<div class="order_field_update __order_field_module mt- pt-3 border_top_eb">
    <input type="hidden" name="order[quote]" value="<?php echo e($data_quote['id']); ?>">
    <?php
        $order_field_update = [
            [
                'name' => '',
                'note' => 'Tổng tiền (chưa bao gồm VAT)',
                'attr' => ['disable_field' => 1, 'inject_class' => '__order_total_input'],
                'value' => round(@$data_quote['total_amount'])
            ],
            [
                'name' => 'order[advance]',
                'note' => 'Tạm ứng đơn hàng',
                'attr' => ['type_input' => 'number', 'inject_class' => '__order_advance_input'],
                'value' => @$data_order['advance'] ?? 0
            ],
            [
                'name' => 'order[rest]',
                'note' => 'Chi phí còn lại',
                'attr' => ['readonly' => 1, 'inject_class' => '__order_rest_input'],
                'value' => @$data_order['rest'] ?? round(@$data_quote['total_amount'])
            ],
            [
                'name' => 'order[rest_bill]',
                'note' => 'File bill tạm ứng',
                'type' => 'file',
                'value' => @$data_order['rest_bill']
            ],
            [
                'name' => 'order[rest_note]',
                'note' => 'Ghi chú công nợ',
                'type' => 'textarea',
                'value' => @$data_order['rest_note']
            ],
            [
                'name' => 'order[ship_note]',
                'note' => 'Ghi chú giao hàng',
                'type' => 'textarea',
                'value' => @$data_order['ship_note']
            ]
        ]
    ?>
    <?php $__currentLoopData = $order_field_update; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('view_update.view', $order_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/base_field.blade.php ENDPATH**/ ?>