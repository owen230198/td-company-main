<?php
    $key_stage = \App\Constants\TDConstant::EXT_PRICE;
    $paper_ext_price = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
        'note' => 'Chi phí 1 sản phẩm',
        'attr' => ['type_input' => 'number'],
        'value' => 0
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_ext_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<p class="font-italic color_red mb-1">Dành cho điền giá 1 sản phẩm.</p>
<p class="font-italic color_red mb-1">1. Tem + toa đi kèm hộp.</p>
<p class="font-italic color_red mb-1">2. Các chi phí phát sinh vật tư khác.</p><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/ext_price.blade.php ENDPATH**/ ?>