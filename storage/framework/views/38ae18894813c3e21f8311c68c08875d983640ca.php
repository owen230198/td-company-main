<div class="d-flex">
    <div class="d-block">
        <?php
            $key_stage = \TDConst::EXT_PRICE;
            $paper_ext_temp = [
                'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][temp_price]',
                'note' => '1. Chi phí tem',
                'attr' => ['type_input' => 'number'],
                'value' => @$data_handle['temp_price'] ?? 0
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $paper_ext_temp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
        <?php
            $paper_ext_prescript = [
                'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][prescript_price]',
                'note' => '2. Chi phí toa',
                'attr' => ['type_input' => 'number'],
                'value' => @$data_handle['prescript_price'] ?? 0
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $paper_ext_prescript, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
        <?php
            $paper_ext_supp = [
                'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$key_stage.'][supp_price]',
                'note' => '3. Chi phí vật tư khác',
                'attr' => ['type_input' => 'number'],
                'value' => @$data_handle['supp_price'] ?? 0
            ] 
        ?>
        <?php echo $__env->make('view_update.view', $paper_ext_supp, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="ml-5">
        <p class="font-italic color_red mb-1">Dành cho điền giá 1 sản phẩm.</p>
        <p class="font-italic color_red mb-1">1. Tem đi kèm hộp.</p>
        <p class="font-italic color_red mb-1">2. Toa đi kèm hộp.</p>
        <p class="font-italic color_red mb-1">3. Các chi phí phát sinh vật tư khác.</p>
    </div>
</div><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/quotes/products/papers/handles/ext_price.blade.php ENDPATH**/ ?>