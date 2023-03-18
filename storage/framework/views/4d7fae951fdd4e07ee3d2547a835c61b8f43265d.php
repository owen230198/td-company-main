<div class="d-flex align-items-center">
    <?php
        $key_stage = \App\Constants\TDConstant::COMPRESS;
        $paper_compress_price = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
            'note' => 'Giá tiền 1 sản phẩm',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $paper_compress_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-2 fs-12 font-italic color_red">Giá lượt/bát sp (không phả giá lượt/ tờ in)</span>
</div>

<div class="d-flex align-items-center">
    <?php
        $paper_compress_shape_price = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][shape_price]',
            'note' => 'Giá khuôn 1 sản phẩm',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $paper_compress_shape_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-2 fs-12 font-italic color_red">Giá khuôn/bát sp (không phả giá khuôn/tờ in)</span>
</div>

<?php echo $__env->make('quotes.products.papers.handles.select_device', ['key_device' => $key_stage], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/compress.blade.php ENDPATH**/ ?>