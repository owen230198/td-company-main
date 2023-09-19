<?php if(@$attr['type_input'] == 'number'): ?>
    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
    <div style="my-3">
        <input type="number" min=0 max="9900" oninput="validity.valid || (value='0');" id="min_price" class="price-range-field" />
        <input type="number" min=0 max="10000" oninput="validity.valid || (value='10000');" id="max_price" class="price-range-field" />
    </div>
<?php else: ?>
    <input type="text" name="<?php echo e($name); ?>" class="form-control" placeholder="Nhập thông tin <?php echo e($note); ?>" value = "<?php echo e(@$data_search[$name]); ?>"/>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_search/text.blade.php ENDPATH**/ ?>