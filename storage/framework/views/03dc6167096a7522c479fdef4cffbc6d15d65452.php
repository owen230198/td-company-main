<?php
    $key_stage = \TDConst::PRINT;
    $paper_print_type = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][type]',
        'type' => 'select',
        'note' => 'kiểu in',
        'value' => @$data_handle['type'],
        'other_data' => ['data' => ['options' => \TDConst::PRINT_TYPE]]
    ];
    $paper_print_color = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][color]',
        'type' => 'select',
        'note' => 'số màu in',
        'value' => !empty($data_paper->id) ? @$data_handle['color'] : 4,
        'other_data' => ['data' => ['options' => \TDConst::PRINT_COLOR]]
    ];
    $paper_print_tech = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][machine]',
        'type' => 'select',
        'note' => 'công nghệ in',
        'value' => @$data_handle['machine'],
        'other_data' => ['data' => ['options' => \TDConst::PRINT_TECH]]
    ];
?>
<?php echo $__env->make('view_update.view', $paper_print_type, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('view_update.view', $paper_print_color, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('view_update.view', $paper_print_tech, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/quotes/products/papers/handles/print.blade.php ENDPATH**/ ?>