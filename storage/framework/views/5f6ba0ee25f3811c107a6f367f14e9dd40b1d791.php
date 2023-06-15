<div class="list_table_func d-flex align-items-center justify-content-center">
	<?php
		$ext_action = !empty($tableItem['ext_action']) ? json_decode($tableItem['ext_action'], true) : []
 	?>
	<?php if(!empty($ext_action)): ?>
		<?php $__currentLoopData = $ext_action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if(@$button['type'] == 2): ?>
				<button type="button" class="table-btn mr-2 mb-2 <?php echo e(@$button['class']); ?>" title="<?php echo e(@$button['note']); ?>" data-table="<?php echo e($tableItem['name']); ?>" data-id="<?php echo e($data->id); ?>">
					<i class="fa fa-<?php echo e($button['icon']); ?> fs-14" aria-hidden="true"></i>
				</button>
			<?php else: ?>
				<a href="<?php echo e(url(@$button['link'].''.$data->id)); ?>" class="table-btn mr-2 mb-2" title="<?php echo e(@$button['note']); ?>">
					<i class="fa fa-<?php echo e($button['icon']); ?> fs-14" aria-hidden="true"></i>
				</a>
			<?php endif; ?>	
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
	<?php if($tableItem['update'] == 1): ?>
		<a href="<?php echo e(asset('update/'.$tableItem['name'].'/'.$data->id.''.@$param_action)); ?>" class="table-btn mr-2 mb-2" title="Sửa">
			<i class="fa fa-pencil-square-o fs-14" aria-hidden="true"></i>
		</a>
	<?php endif; ?>
	<?php if($tableItem['copy'] == 1): ?>
		
	<?php endif; ?>
	<?php if($tableItem['remove'] == 1): ?>
		<button type="button" title="Xóa" class="btn btn-primary mb-2 table-btn delete_btn bg_red" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo e($data->id); ?>">
			<i class="fa fa-times fs-14" aria-hidden="true"></i>
		</button>
	<?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/func_btn.blade.php ENDPATH**/ ?>