
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/order.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(url('apply-to-worker-handle/'.$id)); ?>" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data" 
    onkeydown="return event.key != 'Enter'">
        <?php echo csrf_field(); ?>
        <?php if(count($products) > 1): ?>
            <h3 class="fs-14 text-uppercase mt-3 text-center handle_title">
                <span>Danh sách sản phẩm</span>
            </h3>
            <?php echo $__env->make('quotes.products.list_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <div class="tab-content" id="quote-pro-tabContent">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro_index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane fade<?php echo e($pro_index == 0 ? ' show active' : ''); ?> tab_pane_quote_pro" id="quote-pro-<?php echo e($pro_index); ?>" role="tabpanel" aria-labelledby="quote-pro-<?php echo e($pro_index); ?>-tab">
                    <div class="config_handle_paper_pro">
                        <div class="mb-2 base_product_config">
                            <?php
                                $pro_name_field = [
                                    'name' => '',
                                    'note' => 'Tên sản phẩm',
                                    'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name', 'placeholder' => 'Nhập tên', 'disable_field' => 1],
                                    'value' => !empty($product['id']) ? @$product['name'] : ''
                                ];
                                $pro_qty_field = [
                                    'name' => '',
                                    'note' => 'Số lượng sản phẩm',
                                    'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty', 'placeholder' => 'Nhập số lượng', 'disable_field' => 1],
                                    'value' => @$product['qty']
                                ];
                                $pro_category_field = [
                                    'name' => '',
                                    'type' => 'linking',
                                    'note' => 'Nhóm sản phẩm',
                                    'attr' => ['required' => 1, 'inject_class' => 'select_quote_procategory', 'inject_attr' => 'proindex='.$pro_index, 'disable_field' => 1],
                                    'other_data' => ['data' => ['table' => 'product_categories']],
                                    'value' => @$product['category']
                                ]
                            ?>
        
                            <?php echo $__env->make('view_update.view', $pro_name_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
                            <?php echo $__env->make('view_update.view', $pro_qty_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            
                            <?php echo $__env->make('view_update.view', $pro_category_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
                        <span>Danh sách yêu cầu xử lí vật tư</span>
                    </h3>
                    <?php
                        $elements = getProductElementData($product['category'], $product['id'], true);
                    ?>
                    <?php if(count($elements) > 0): ?>
                        <ul class="nav nav-pills mb-3 quote_pro_strct_nav_link" id="quote-pro-<?php echo e($pro_index); ?>-struct-tab" role="tablist">
                            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($element['data'])): ?>
                                    <li class="nav-item">
                                        <a class="nav-link<?php echo e($key == 0 ? ' active' : ''); ?>" id="quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>-tab" data-toggle="pill" href="#quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>" 
                                        role="tab" aria-controls="quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>" aria-selected="true"><?php echo e($element['note']); ?></a>
                                    </li>   
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="tab-content" id="quote-pro-<?php echo e($pro_index); ?>-struct-tabContent">
                            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($element['data'])): ?>
                                    <div class="tab-pane fade<?php echo e($key == 0 ? ' show active' : ''); ?> tab_pane_quote_pro" id="quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>" role="tabpanel" aria-labelledby="quote-pro-<?php echo e($pro_index); ?>-struct-<?php echo e($element['key']); ?>-tab">
                                        <?php echo $__env->make('orders.users.6.supply_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Xác nhận xuống xưởng SX
            </button>
            <a href="<?php echo e(url('')); ?>" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/orders/users/6/view.blade.php ENDPATH**/ ?>