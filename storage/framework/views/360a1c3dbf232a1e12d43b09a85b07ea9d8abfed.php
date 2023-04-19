<?php
    $pro_supply = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][supply_type]',
        'type' => 'linking',
        'note' => 'Chọn vật tư',
        'attr' => ['required' => 1, 'inject_class' => 'select_supply_type'],
        'other_data' => ['config' => ['search' => 1], 
        'data' => ['table' => 'supply_types', 'where' => ['type' => $key_supp]]]
    ];
    
?>
<div class="module_select_supply_type">
    <?php echo $__env->make('view_update.view', $pro_supply, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(empty($select_qttv)): ?>
        <?php
            $pro_supp_price = [
                'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][supply_price]',
                'type' => 'select',
                'note' => 'Chọn định lượng',
                'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
                'other_data' => ['config' => ['search_box' => 1], 'data' => ['options' => ['Chọn định lượng']]]
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $pro_supp_price, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/supplies/select_supply_type.blade.php ENDPATH**/ ?>