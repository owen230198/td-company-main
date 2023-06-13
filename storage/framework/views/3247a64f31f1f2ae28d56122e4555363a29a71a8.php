<ul class="nav nav-pills mb-3 pro_nav_link" id="quote-pro-tab" role="tablist">
    <label class="mb-0 min_210 mr-3"></label>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item">
            <a class="nav-link<?php echo e($i == 0 ? ' active' : ''); ?>" id="quote-pro-<?php echo e($i); ?>-tab" data-toggle="pill" href="#quote-pro-<?php echo e($i); ?>" 
            role="tab" aria-controls="quote-pro-<?php echo e($i); ?>" aria-selected="true">
                <?php echo e(@$product['name']); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<div class="tab-content" id="quote-pro-tabContent">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro_index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tab-pane fade<?php echo e($pro_index == 0 ? ' show active' : ''); ?> tab_pane_quote_pro" id="quote-pro-<?php echo e($pro_index); ?>" role="tabpanel" aria-labelledby="quote-pro-<?php echo e($pro_index); ?>-tab">
            <div class="config_handle_paper_pro">
                <div class="mb-2 base_product_config">
                    <?php
                        $pro_base_name_input = 'product['.$pro_index.']';
                        $pro_name_field = [
                            'name' => $pro_base_name_input.'[name]',
                            'note' => 'Tên sản phẩm',
                            'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name', 'placeholder' => 'Nhập tên'],
                            'value' => !empty($product['id']) ? @$product['name'] : ''
                        ];
                        $pro_qty_field = [
                            'name' => $pro_base_name_input.'[qty]',
                            'note' => 'Số lượng sản phẩm',
                            'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty', 'placeholder' => 'Nhập số lượng'],
                            'value' => @$product['qty']
                        ];
                        $pro_category_field = [
                            'name' => $pro_base_name_input.'[category]',
                            'type' => 'linking',
                            'note' => 'Nhóm sản phẩm',
                            'attr' => ['required' => 1 , 'inject_class' => 'select_quote_procategory', 'inject_attr' => 'proindex='.$pro_index],
                            'other_data' => ['data' => ['table' => 'product_categories']],
                            'value' => @$product['category']
                        ];
                        $quote_pro_design = [
                            'name' => $pro_base_name_input.'[design]',
                            'note' => 'thiết kế',
                            'type' => 'linking',
                            'other_data' => ['data' => ['table' => 'design_types', 'select' => ['id', 'name']]],
                            'value' => @$product['design']
                        ];
                        $pro_size_field = [
                            'name' => $pro_base_name_input.'[size]',
                            'note' => 'Kích thước hộp',
                            'attr' => ['placeholder' => 'D x R x C (DVT cm)'],
                            'value' => @$product['size']
                        ];
                    ?>
                    <?php dump(1); ?>;
                    <?php echo $__env->yieldContent('base-field'); ?>
                </div>
                <div class="ajax_product_view_by_category">
                        
                </div>
                <?php if(empty($view_detail) && !empty($product['id'])): ?>
                    <input type="hidden" name="product[<?php echo e($pro_index); ?>][id]" value="<?php echo e($product['id']); ?>">
                    <div class="text-center">
                        <button type="button" 
                        class="main_button color_white bg_green border_green radius_5 font_bold smooth show_config_handle_quote"
                        proindex = <?php echo e($pro_index); ?> data-proid = <?php echo e($product['id']); ?> data-category = <?php echo e(@$product['category']); ?>>
                            <i class="fa fa-angle-double-down fs-14 mr-2" aria-hidden="true"></i>
                            <span>Xem chi tiết sản xuất</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/products/ajax_list.blade.php ENDPATH**/ ?>