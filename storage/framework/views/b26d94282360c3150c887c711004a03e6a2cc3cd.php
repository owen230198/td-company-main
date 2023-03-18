<?php
    $key_stage = \App\Constants\TDConstant::PEEL;
    $paper_nqty_peel = [
        'name' => 'product['.$j.'][paper]['.$pindex.']['.$key_stage.'][nqty]',
        'note' => 'Số bát lề',
        'attr' => ['type_input' => 'number'],
        'value' => 0
    ] 
?>

<?php echo $__env->make('quotes.products.papers.handles.select_device', 
['key_device' => $key_stage, 'value' => getDeviceIdByKey($key_stage, \App\Constants\TDConstant::SEMI_AUTO_DEVICE)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $key_stage = \App\Constants\TDConstant::EXT_PRICE;
    
?>
<div class="d-flex align-items-center">
    <?php echo $__env->make('view_update.view', $paper_nqty_peel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-1 color_red font-italic">Trường hợp hộp cứng ghép bát</span>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/peel.blade.php ENDPATH**/ ?>