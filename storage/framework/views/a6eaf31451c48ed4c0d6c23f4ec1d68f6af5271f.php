<?php if(!empty($supply_obj->id) || $supp_index > 0): ?>
    <span class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth" data-id = "<?php echo e(@$supply_obj->id); ?>">
        <i class="fa fa-times" aria-hidden="true"></i>
    </span>   
<?php endif; ?>
<?php if(!empty($supply_obj->id)): ?>
    <input type="hidden" name="product[<?php echo e($pro_index); ?>][<?php echo e($key_supp); ?>][<?php echo e($supp_index); ?>][id]" value="<?php echo e($supply_obj->id); ?>">
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/quotes/products/supplies/check_index_data.blade.php ENDPATH**/ ?>