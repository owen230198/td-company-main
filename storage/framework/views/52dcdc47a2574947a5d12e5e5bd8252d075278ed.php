<?php if(@$button['type'] == 2): ?>
    <button type="button" class="table-btn mr-2 mb-2 <?php echo e(@$button['class']); ?>" title="<?php echo e(@$button['note']); ?>" data-table="<?php echo e($tableItem['name']); ?>" data-id="<?php echo e($data->id); ?>">
        <i class="fa fa-<?php echo e($button['icon']); ?> fs-14" aria-hidden="true"></i>
    </button>
<?php else: ?>
    <?php
        $link = $button['link'];
        if (str_contains($link, '<id>') || str_contains($link, '<table>')) {
            if (str_contains($link, '<id>')) {
            $link = str_replace('<id>', $data->id, $link);
            }
            if (str_contains($link, '<table>')) {
                $link = str_replace('<table>', $tableItem['name'], $link);
            }
        }else{
            $link = $link.''.$data->id;    
        }
    ?>
    <a href="<?php echo e(url(@$link)); ?>" class="table-btn mr-2 mb-2" title="<?php echo e(@$button['note']); ?>">
        <i class="fa fa-<?php echo e($button['icon']); ?> fs-14" aria-hidden="true"></i>
    </a>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/ext_func_btn.blade.php ENDPATH**/ ?>