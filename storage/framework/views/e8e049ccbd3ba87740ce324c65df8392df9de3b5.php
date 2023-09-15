<?php
    $base = 'product['.$pro_index.'][fill_finish][fill][stage]['.$findex.']';
    $data_select_fill = [
        'other_data' => [
            'config' => ['search' => 1], 
            'data' => ['table' => 'materals', 'where' => ['type' => \TDConst::FILL]]
        ],
        'note' => 'Tên giấy bồi',
        'value' => @$fill_data['materal'],
        'name' => $base.'[materal]'
    ];
    $fill_device_select = [
        'name' => $base.'[machine]',
        'type' => 'linking',
        'note' => 'Thiết bị máy bồi',
        'value' => @$fill_data['machine'] ?? getDeviceId(['key_device' => 'fill', 'supply' => 'fill_finish', 'default_device' => 1]),
        'other_data' => ['data' => ['table' => 'devices', 'where' => ['key_device' => 'fill', 'supply' => 'fill_finish'], 'select' => ['id', 'name']]]
    ];
?>
<div class="d-flex align-items-center mb-2 fs-13 quote_fill_finish_item position-relative" data-index=<?php echo e($findex); ?>>
    <?php if($findex > 0): ?>
        <span class="remove_ext_element_quote d-flex remove_ff_quote color_red smooth"><i class="fa fa-times" aria-hidden="true"></i></span> 
    <?php endif; ?>
    <label class="mb-0 min_210 text-capitalize text-right mr-3">
        <?php
            $num = $findex + 1;
        ?>
        ĐG các công đoạn bồi hộp <?php echo e($findex > 0 ? '('.$num.')' : ''); ?>

    </label>
    <div class="d-flex justify-content-between align-items-center">
        <input type="number" name = 'product[<?php echo e($pro_index); ?>][fill_finish][fill][stage][<?php echo e($findex); ?>][length]' placeholder="KT chiều dài (cm)" 
        class="form-control short_input" step="any" value="<?php echo e(@$fill_data['length']); ?>"> 
        <span class="mx-2">X</span>
        <input type="number" name = 'product[<?php echo e($pro_index); ?>][fill_finish][fill][stage][<?php echo e($findex); ?>][width]' placeholder="KT chiều rộng (cm)" 
        class="form-control short_input" step="any" value="<?php echo e(@$fill_data['width']); ?>"> 
        <span class="mx-2">||</span> 
        <?php echo $__env->make('view_update.linking', $data_select_fill, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="mx-2">||</span> 
        <?php echo $__env->make('view_update.linking', $fill_device_select, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/fill_finishes/ajax_fill.blade.php ENDPATH**/ ?>