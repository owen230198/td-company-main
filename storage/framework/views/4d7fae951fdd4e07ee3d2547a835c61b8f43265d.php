<?php
    $key_stage = \TDConst::COMPRESS;
    $paper_compress_price = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][price]',
        'note' => 'Giá tiền 1 sản phẩm',
        'attr' => ['type_input' => 'number'],
        'value' => @$data_handle['price'] ?? 0
    ];
    $paper_compress_shape_price = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][shape_price]',
        'note' => 'Giá khuôn 1 sản phẩm',
        'attr' => ['type_input' => 'number'],
        'value' => @$data_handle['shape_price'] ?? 0
    ] 
?>
<div class="d-flex align-items-center">
    <?php echo $__env->make('view_update.view', $paper_compress_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-2 fs-12 font-italic color_red">Giá lượt/bát sp (không phải giá lượt/ tờ in)</span>
</div>

<div class="d-flex align-items-center">
    <?php echo $__env->make('view_update.view', $paper_compress_shape_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-2 fs-12 font-italic color_red">Giá khuôn/bát sp (không phải giá khuôn/tờ in)</span>
</div>

<?php echo $__env->make('quotes.products.papers.handles.select_device', ['key_device' => $key_stage, 'value' => @$data_handle['machine']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/compress.blade.php ENDPATH**/ ?>