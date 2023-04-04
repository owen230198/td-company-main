<div class="d-flex align-items-center w-100">
	<?php
		$id = $field['id']
	?>
	<label class="mr-2 d-block mb-0 min_100"><?php echo e($field['note']); ?>:</label>
	<input type="text" name="<?php echo e($id); ?>" class="form-control station-richmenu-main-search__set" placeholder="Nhập thông tin <?php echo e($field['note']); ?>" value = "<?php echo e(@$data_search[$id]?$data_search[$id]:''); ?>"/>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_search/text.blade.php ENDPATH**/ ?>