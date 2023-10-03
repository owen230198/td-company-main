<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/admin/css/quote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/base/css/bootstrap-multiselect.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(!empty($link_action) ? $link_action : asset('insert/quotes?step=handle_config&id='.$data_quote['id'])); ?>" method="POST" 
    class="config_handle_form config_content baseAjaxForm" enctype="multipart/form-data" onkeydown="return event.key != 'Enter'">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('quotes.head_information', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="quote_handle_section handle_pro_section">
            <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
                <span>Khởi tạo sản phẩm</span>
            </h3>
            <?php
                $quote_pro_qty_field = [
                    'name' => 'quote[product_qty]',
                    'note' => 'Số đơn hàng',
                    'attr' => ['type_input' => 'number', 
                    'inject_class' => 'quote_set_qty_pro_input',
                    'disable_field' => @$product_qty ? 1 : 0 ],
                    'value' => @$product_qty
                ] 
            ?>
            <?php echo $__env->make('view_update.view', $quote_pro_qty_field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="ajax_product_quote_number">
                <?php if(!empty($products)): ?>
                    <?php echo $__env->make('quotes.products.ajax_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>       
            </div>
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
              <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            <a href="<?php echo e(url('update/quotes/'.$data_quote['id'])); ?>" class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Chọn khách hàng khác
            </a>
            <a href="<?php echo e(url('')); ?>" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
              <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>  
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('frontend/base/script/bootstrap-multiselect.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/admin/script/quote.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/quotes/handle_config.blade.php ENDPATH**/ ?>