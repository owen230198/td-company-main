<?php if(@$button['type'] == 2): ?>
    <button type="button" 
    class="main_button color_white bg_green border_green radius_5 mr-3 font_bold smooth <?php echo e(@$button['class']); ?>" 
    title="<?php echo e(@$button['note']); ?>" 
    data-table="<?php echo e($tableItem['name']); ?>" 
    data-id="<?php echo e(@$dataItem['id']); ?>">
        <i class="fa fa-<?php echo e($button['icon']); ?> mr-2 fs-14" aria-hidden="true"></i>
        <?php echo e(@$button['note']); ?>

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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/action/ext_func_btn.blade.php ENDPATH**/ ?>