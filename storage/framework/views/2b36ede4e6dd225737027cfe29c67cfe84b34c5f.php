<?php
    $data_stage = !empty($value) ? json_decode($value, true) : [];
    $icon = getIconByStageHandle(@$data_stage['act']);
?>
<div class="handle_stage_item color_white bg_<?php echo e($icon['color']); ?> box_shadow_3">
    <i class="fa fa-<?php echo e($icon['icon']); ?> mr-1" aria-hidden="true"></i>    
</div>  <?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_table/handle_stage.blade.php ENDPATH**/ ?>