<?php
    $pro_temp_length = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][temp_length]',
        'note' => 'KT chiều dài sơ bộ',
        'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT(cm)', 'inject_class' => 'temp_size_length'],
    ];
    $pro_length = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][length]',
        'note' => 'KT chiều dài tối ưu',
        'attr' => ['type_input' => 'number', 'placeholder' => 'Đơn vị cm', 'inject_class' => 'otm_size_length'],
    ];
    $pro_width = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][width]',
        'note' => 'Kích thước chiều rộng',
        'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
    ]; 
?>
<div class="calc_size_module" data-plus = <?php echo e($plus); ?> data-divide = <?php echo e($divide[0]); ?>>
    <div class="d-flex alig-items-center">
        <?php echo $__env->make('view_update.view', $pro_temp_length, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="ml-1 color_gray mt-1"> + <?php echo e($plus); ?>cm</span>
    </div>
    
    <?php echo $__env->make('view_update.view', $pro_length, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>


<div class="d-flex">
    <?php echo $__env->make('view_update.view', $pro_width, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-1 color_gray mt-1"> + <?php echo e($plus); ?>cm BH</span>
</div> <?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/supplies/size_config.blade.php ENDPATH**/ ?>