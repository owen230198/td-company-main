<?php
    $key_stage = \TDConst::ELEVATE;
    $paper_elevate_ext_price = [
            'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][ext_price]',
            'note' => 'Thêm giá cho khuôn phức tạp',
            'attr' => ['type_input' => 'number'],
            'value' => @$data_handle['ext_price'] ?? 0
        ] 
?>
<div class="d-flex align-items-center">
    <?php echo $__env->make('view_update.view', $paper_elevate_ext_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-2 font-italic color_red fs-12">Khuôn nhiều chi tiết khác thường</span>
</div>

<?php echo $__env->make('quotes.products.papers.handles.select_device', ['key_device' => $key_stage, 'value' => @$data_handle['machine']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(!isHardBox(@$cate)): ?>
    <div class="mt-2 pt-2 border_top_white">
        <?php echo $__env->make('quotes.products.papers.handles.float', ['data_handle' => @$data_handle['float']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/quotes/products/papers/handles/elevate.blade.php ENDPATH**/ ?>