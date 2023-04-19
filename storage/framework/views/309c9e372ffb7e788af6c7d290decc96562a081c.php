<div class="d-flex align-items-center">
    <?php
        $key_stage = \TDConst::OTHER_EXT;
        $paper_other_ext = [
            'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][price]',
            'note' => 'Chi phí 1 sản phẩm',
            'attr' => ['type_input' => 'number'],
            'value' => 0
        ] 
    ?>
    <?php echo $__env->make('view_update.view', $paper_other_ext, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-2 fs-12 font-italic color_red">Điền chi phí vật tư khác cho 1 sản phẩm nếu có phát sinh</span>
</div>
<?php
    $paper_other_note = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][note]',
        'type' => 'textarea',
        'note' => 'ghi chú'
    ] 
?>
<?php echo $__env->make('view_update.view', $paper_other_note, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/other_ext.blade.php ENDPATH**/ ?>