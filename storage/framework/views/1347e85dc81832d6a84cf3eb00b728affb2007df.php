<?php
    $num = $findex + 1;
    $note =$findex > 0 ? 'ĐG các công đoạn hoàn thiện ('.$num.')' : 'ĐG các công đoạn hoàn thiện';
    $data_select_finish = [
        'other_data' => [
            'config' => ['search' => 1], 
            'data' => ['table' => 'supply_prices', 'where' => ['type' => \TDConst::FINISH]]
        ],
        'value' => @$finish_data['materal'],
        'name' => 'product['.$pro_index.'][fill_finish][finish][stage]['.$findex.'][materal]',
        'type' => 'linking',
        'note' => $note
    ]
?>
<div class="quote_fill_finish_item position-relative" data-index=<?php echo e($findex); ?>>
    <?php if($findex > 0): ?>
        <span class="remove_ext_element_quote d-flex remove_ff_quote color_red smooth"><i class="fa fa-times" aria-hidden="true"></i></span> 
    <?php endif; ?>
    <?php echo $__env->make('view_update.view', $data_select_finish, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/fill_finishes/ajax_finish.blade.php ENDPATH**/ ?>