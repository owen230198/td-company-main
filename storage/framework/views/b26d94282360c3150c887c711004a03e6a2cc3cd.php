<?php
    $key_stage = \TDConst::PEEL;
    $paper_nqty_peel = [
        'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][nqty]',
        'note' => 'Số bát lề',
        'attr' => ['type_input' => 'number'],
        'value' => @$data_handle['nqty'] ?? 1
    ] 
?>

<?php echo $__env->make('quotes.products.papers.handles.select_device', 
['key_device' => $key_stage, 
'value' => !empty($data_paper->id) ? @$data_handle['machine'] : getDeviceId(['key_device' => $key_stage, 'supply' => 'paper', 'default_device' => 1])], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="d-flex align-items-center">
    <?php echo $__env->make('view_update.view', $paper_nqty_peel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <span class="ml-1 color_red font-italic">Trường hợp hộp cứng ghép bát</span>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/handles/peel.blade.php ENDPATH**/ ?>