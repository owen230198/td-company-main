<ul class="nav nav-pills mb-3 quote_pro_nav_link" id="quote-pro-tab" role="tablist">
    <label class="mb-0 min_150 mr-3"></label>
    <?php for($i = 0; $i < $qty; $i++): ?>
    <li class="nav-item">
        <a class="nav-link<?php echo e($i == 0 ? ' active' : ''); ?>" id="quote-pro-<?php echo e($i); ?>-tab" data-toggle="pill" href="#quote-pro-<?php echo e($i); ?>" role="tab" aria-controls="quote-pro-<?php echo e($i); ?>" aria-selected="true">Sản phẩm <?php echo e($i+1); ?></a>
    </li>
    <?php endfor; ?>
</ul>

<div class="tab-content" id="quote-pro-tabContent">
    <?php for($j = 0; $j < $qty; $j++): ?>
        <div class="tab-pane fade<?php echo e($j == 0 ? ' show active' : ''); ?> tab_pane_quote_pro" id="quote-pro-<?php echo e($j); ?>" role="tabpanel" aria-labelledby="quote-pro-<?php echo e($j); ?>-tab">
            <div class="config_handle_paper_pro">
                <div class="mb-2 base_product_config">
                    <?php
                        $pro_name_field = [
                            'name' => 'product['.$j.'][name]',
                            'note' => 'Tên sản phẩm',
                            'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name']
                        ] 
                    ?>
                    <?php echo $__env->make('view_update.view', $pro_name_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                    <?php
                        $pro_group_field = [
                            'name' => 'product['.$j.'][group]',
                            'type' => 'linking',
                            'note' => 'Nhóm sản phẩm',
                            'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'product_categories']]
                        ] 
                    ?>
                    <?php echo $__env->make('view_update.view', $pro_group_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <?php echo $__env->make('quotes.products.papers.view', ['pindex' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    <?php endfor; ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/ajax_view.blade.php ENDPATH**/ ?>