<?php
    $pro_per_price = (int) @$product['total_cost'] / (int) @$product['qty'];
    $ext_pro_fields_inf = [
        'per_price' => 
        [
            'name' => $pro_base_name_input.'[per_price]',
            'note' => 'Đơn giá sản phẩm',
            'attr' => ['disable_field' => 1],
            'value' => number_format($pro_per_price)
        ],
        'total_cost' =>
        [
            'name' => $pro_base_name_input.'[total_cost]',
            'note' => 'Tổng chi phí sản phẩm',
            'attr' => ['disable_field' => 1],
            'value' => number_format($product['total_cost'])
        ],
    ];
    
    $ext_pro_feild_file = \App\Models\Product::getFeildFileByStage(@$stage);
?>

<?php $__currentLoopData = $ext_pro_fields_inf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ext_pro_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('view_update.view', $ext_pro_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>     
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $ext_pro_feild_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ext_feild_file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $ext_feild_file['value'] = @$product[$key];
        $ext_feild_file['name'] = $pro_base_name_input.'['.$key.']';
        $ext_feild_file['table_map'] = 'products';
        $ext_feild_file['other_data']['field_name'] = $key;
        $ext_feild_file['other_data']['obj_id'] = @$product['id'];
    ?>
    <?php echo $__env->make('view_update.view', $ext_feild_file, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>     
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(@$stage == \App\Models\Order::TECH_SUBMITED): ?>
    <?php
        $product_note = !empty($product['note']) ? json_decode($product['note'], true) : [];
        $note_values = [
            'note_print' => 
            [
                'name' => $pro_base_name_input.'[note][print]',
                'note' => 'Ghi chú cho khâu in',
                'type' => 'linking',
                'other_data' => ['data' => ['table' => 'print_notes', 'select' => ['id', 'name']]],
                'value' => @$product_note['print']
            ],
            'note_handle' =>
            [
                'name' => $pro_base_name_input.'[note][handle]',
                'note' => 'Ghi chú cho khâu gia công',
                'type' => 'textarea',
                'value' => @$product_note['handle']
            ]
        ]
    ?>
    <?php $__currentLoopData = $note_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('view_update.view', $note_value, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>     
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/products/extend_info.blade.php ENDPATH**/ ?>