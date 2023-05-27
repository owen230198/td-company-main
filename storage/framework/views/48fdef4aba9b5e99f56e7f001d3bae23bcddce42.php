<?php
    $pro_per_price = (int) @$product['total_cost'] / (int) @$product['qty'];
    $product_note = !empty($product['note']) ? json_decode($product['note'], true) : [];
    $ext_pro_fields = [
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
        'custom_design_file' =>
        [
            'name' => $pro_base_name_input.'[custom_design_file]',
            'note' => 'File thiết kế khách gửi',
            'type' => 'file',
            'value' => @$product['custom_design_file']
        ],
        'sale_shape_file' =>
        [
            'name' => $pro_base_name_input.'[sale_shape_file]',
            'note' => 'Khuôn kinh doanh tính giá',
            'type' => 'file',
            'value' => @$product['sale_shape_file']
        ],
        'tech_shape_file' =>
        [
            'name' => $pro_base_name_input.'[tech_shape_file]',
            'note' => 'Khuôn sản xuất (Kỹ thuật)',
            'type' => 'file',
            'value' => @$product['tech_shape_file']
        ],
        'design_file' =>
        [
            'name' => $pro_base_name_input.'[design_file]',
            'note' => 'File gốc (P. Thiết kế)',
            'type' => 'file',
            'value' => @$product['design_file']
        ],
        'design_shape_file' =>
        [
            'name' => $pro_base_name_input.'[design_shape_file]',
            'note' => 'File bình theo khuôn (P. Thiết kế)',
            'type' => 'file',
            'value' => @$product['design_shape_file']
        ],
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
    ];
    if (in_array(\GroupUser::getCurrent(), [\GroupUser::SALE])) {
        unset($ext_pro_fields['tech_shape_file'], $ext_pro_fields['design_file'], $ext_pro_fields['design_shape_file']);    
    }elseif (in_array(\GroupUser::getCurrent(), [\GroupUser::TECH_APPLY])) {
        unset($ext_pro_fields['design_file'], $ext_pro_fields['design_shape_file']);    
    }elseif (in_array(\GroupUser::getCurrent(), [\GroupUser::DESIGN])) {
        unset($ext_pro_fields['design_file'], $ext_pro_fields['sale_shape_file']);    
    }
?>

<?php $__currentLoopData = $ext_pro_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ext_pro_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('view_update.view', $ext_pro_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>     
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/products/extend_info.blade.php ENDPATH**/ ?>