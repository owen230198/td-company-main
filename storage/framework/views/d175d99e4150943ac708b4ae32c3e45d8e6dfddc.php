<?php
	$default_data = json_decode($field['default_data'], true);
	$parent = $default_data['data'];
	$config = $default_data['config'];
	$ajaxChild = @$default_data['child'];
	$pData = @$default_data['parent'];
	$whereOption = @$pData['field'] && @$pData['p_field'] && @$data_search[$pData['field']]!=0?['act' => 1, $pData['p_field'] => $data_search[$pData['field']]]:['act'=>1]; 
	$list_option = $parent['table']!=null?getOptionByClass($parent['table'], $whereOption):$parent['option'];
	$list_option = $parent['table']!=null&&@$parent['recursive']?recursive($list_option, 0, 0):$list_option;
	$select_search = @$data_search[$field['id']]??0;
?>
<div class="d-flex align-items-center w-100">
	<label class="mr-2 d-block mb-0 min_100"><?php echo e($field['note']); ?>:</label>
	<select name="<?php echo e($field['id']); ?>" 
			class="form-control <?php echo e(@$config['searchbox']?'select_config':''); ?> <?php echo e(@$ajaxChild['ajax-child']?'tableSelectAjaxChild':''); ?>"
			<?php echo e(@$ajaxChild['table']?'data-child-table='.$ajaxChild['table']:''); ?>

			<?php echo e(@$ajaxChild['s_target']?'data-child-target='.$ajaxChild['s_target']:''); ?> 
			<?php echo e(@$ajaxChild['field']?'data-child-field='.$ajaxChild['field']:''); ?> >
		<option value="0">Không xác định</option>
		<?php $__currentLoopData = $list_option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($parent['table']!=null): ?>
				<option value="<?php echo e($option['id']); ?>" <?php echo e($select_search==$option['id']?'selected':''); ?>>
					<?php echo e(@$option['level']?str_repeat('_', $option['level']).''.$option['name']:$option['name']); ?>

				</option>
			<?php else: ?>
				<option value="<?php echo e($key); ?>" <?php echo e($select_search==$key?'selected':''); ?>>
					<?php echo e($option); ?>

				</option>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</select>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_search/select.blade.php ENDPATH**/ ?>