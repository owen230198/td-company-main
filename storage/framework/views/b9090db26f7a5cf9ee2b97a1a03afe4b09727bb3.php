<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
    <p class="mb-1"><?php echo e($supp_index == 0 ? 'Phần vật tư '.@$name : 'Vật tư '.@$name.' thêm '.$supp_index); ?></p>
    <?php if(!empty($divide)): ?>
        <p class="mb-1">Kích thước tấm <?php echo e(@$name); ?> là <?php echo e($divide[0]); ?> x <?php echo e($divide[1]); ?>cm</p>
    <?php endif; ?>
</h3><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/quotes/products/supplies/title_config.blade.php ENDPATH**/ ?>