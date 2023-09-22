<?php
    $file = !empty($value) ? json_decode($value, true) : [];
    $file_exists = !empty($file) && file_exists(getFullPathFileUpload(@$file['path']));
?>
<div class="d-flex align-items-center justify-content-center">
    <div class="__file_preview m-2 p-2 border_main text-center radius_5" style="display:<?php echo e($file_exists ? 'block' : 'none'); ?>">
        <i class="fa fa-file-archive-o fs-30" aria-hidden="true"></i>
        <p class="fs-13 font_bold __file_name"><?php echo e(mb_strimwidth(@$file['name'], 0, 18, '...')); ?></p>
    </div>
    <?php if($file_exists): ?>
        <a href="<?php echo e(url('file-download?path='.@$file['path'])); ?>" title = "<?php echo e(@$file['name']); ?>"
        class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
            <i class="fa fa-download mr-2 fs-14" aria-hidden="true"></i>Download
        </a>   
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_table/file.blade.php ENDPATH**/ ?>