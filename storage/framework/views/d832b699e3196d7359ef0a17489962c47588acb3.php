<div class="section_quote_print_paper">
    <div class="list_paper_config">
        <div class="quote_paper_item item_main">
            <?php echo $__env->make('quotes.products.papers.ajax_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>    
    </div>
    <div class="group_btn_action_form text-center mt-4">
        <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
          <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
        </button>
        <button type="button" data-product="<?php echo e($j); ?>" class="main_button color_white bg_green border_green radius_5 font_bold sooth add_print_paper_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm tờ in
        </button>
        <a href="" class="main_button color_white bg_green radius_5 font_bold smooth">
            <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Chọn khách hàng khác
        </a>
        <a href="<?php echo e(url('')); ?>" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
          <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
        </a>
    </div> 
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/papers/view.blade.php ENDPATH**/ ?>