<?php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $list_options = !empty($select_data['options']) ? $select_data['options'] : [];
?>
<p class="color_main radius_5 mb-0 text-center linking_table">
	<?php echo e(!empty($list_options[$value]) ? $list_options[$value] : 'Không xác định'); ?>

</p><?php /**PATH /var/www/html/td-company-app/resources/views/view_table/select.blade.php ENDPATH**/ ?>