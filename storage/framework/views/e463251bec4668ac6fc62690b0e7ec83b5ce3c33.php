<?php
    $base_name = 'category';
    $data_value = !empty($data_search['category']) ? $data_search['category'] : [];
    $field_category = [
        'name' => $base_name.'[group]',
        'type' => 'linking',
        'attr' => ['inject_class' => '__select_product_category', 'placeholder' => 'Chọn nhóm sản phẩm'],
        'other_data' => ['data' => ['table' => 'product_categories']],
        'value' => @$data_value['group']
    ];
    $field_style = [
        'name' => $base_name.'[style]',
        'type' => 'linking',
        'attr' => [
            'inject_class' => '__select_product_style', 
            'placeholder' => 'Chọn kiểu hộp', 
            'disable_field' => 1
        ],
        'other_data' => ['data' => ['table' => 'product_styles']],
        'value' => @$data_value['style']
    ]
?>
<div class="w-100 __style_product_select_module">
    <?php echo $__env->make('view_update.linking', $field_category, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="__style_select mt-2" style="display: <?php echo e(!empty($data_value['group']) ? 'block' : 'none'); ?>">
        <?php echo $__env->make('view_update.linking', $field_style, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/view_search/group_product.blade.php ENDPATH**/ ?>