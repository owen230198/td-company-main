<?php if(@$attr['type_input'] == 'number' && !is_string($value)): ?>
    <?php dd(@$value); ?>;
<?php endif; ?>
<p class="mb-0 w_max_content"><?php echo e(@$attr['type_input'] == 'price' ? number_format(@$value) : @$value); ?></p><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_table/text.blade.php ENDPATH**/ ?>