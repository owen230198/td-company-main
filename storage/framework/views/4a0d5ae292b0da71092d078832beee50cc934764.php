<?php
    $base_name = 'size';
    $data_value = !empty($data_search['size']) ? $data_search['size'] : [];
?>
<div class="d-flex align-items-center">
    <input type="number" name = '<?php echo e($base_name); ?>[length]'  placeholder="Dài" class="form-control short_input text-center" step="any" value="<?php echo e(@$data_value['length']); ?>">
    <span class="mx-2">X</span>
    <input type="number" name = '<?php echo e($base_name); ?>[width]'  placeholder="Rộng" class="form-control short_input text-center" step="any" value="<?php echo e(@$data_value['width']); ?>">
    <span class="mx-2">X</span>
    <input type="number" name = '<?php echo e($base_name); ?>[height]'  placeholder="Cao" class="form-control short_input text-center" step="any" value="<?php echo e(@$data_value['height']); ?>">
</div><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/view_search/product_size.blade.php ENDPATH**/ ?>