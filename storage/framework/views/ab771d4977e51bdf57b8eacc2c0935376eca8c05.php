<?php
    $fld_pro_qty = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][qty]',
        'note' => 'Số lượng sản phẩm',
        'value' => @$supply_obj->product_qty ?? @$pro_qty,
        'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input',
        'disable_field' => !empty($disable_all) || in_array('qty', @$arr_disable ?? []) ? 1 : 0]
    ];
    $fld_pro_nqty = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][nqty]',
        'note' => 'Số bát',
        'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input',
        'disable_field' => !empty($disable_all) || in_array('nqty', @$arr_disable ?? []) ? 1 : 0],
        'value' => @$supply_obj->nqty
    ];
    $fld_pro_qty_supp = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][supp_qty]',
        'note' => 'Tổng SL vật tư',
        'value' => @$supply_obj->supp_qty,
        'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input', 'readonly' => 1,
        'disable_field' => !empty($disable_all) || in_array('supp_qty', @$arr_disable ?? []) ? 1 : 0]
    ]; 
?>
<div class="quantity_paper_module quantity_supply_module" data-percent = <?php echo e($compen_percent); ?> data-num = "0">
    <?php echo $__env->make('view_update.view', $fld_pro_qty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('view_update.view', $fld_pro_nqty, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="d-flex">
        <?php echo $__env->make('view_update.view', $fld_pro_qty_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <span class="ml-1 color_gray mt-1"> x <?php echo e($compen_percent); ?> % BH</span>
    </div> 
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/supplies/quantity_config.blade.php ENDPATH**/ ?>