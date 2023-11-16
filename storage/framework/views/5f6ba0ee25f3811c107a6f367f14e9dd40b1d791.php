<div class="list_table_func d-flex align-items-center justify-content-center">
	<?php
		$ext_action = !empty($tableItem['ext_action']) ? json_decode($tableItem['ext_action'], true) : []
 	?>
	<?php if(!empty($ext_action)): ?>
		<?php $__currentLoopData = $ext_action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if(empty($button['detailonly'])): ?>
				<?php if(!empty($button['condition'])): ?>
					<?php if(getBoolByCondArr($button['condition'], (array) $data)): ?>
						<?php echo $__env->make('table.ext_func_btn', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
					<?php endif; ?>
				<?php else: ?>
					<?php echo $__env->make('table.ext_func_btn', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>		
				<?php endif; ?>		
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
	<?php if($tableItem['update'] == 1): ?>
		<a href="<?php echo e(asset('update/'.$tableItem['name'].'/'.$data->id.''.@$param_action)); ?>" class="table-btn mr-2 mb-2" title="Xử lí <?php echo e($tableItem['note']); ?>">
			<i class="fa fa-pencil-square-o fs-14" aria-hidden="true"></i>
		</a>
	<?php endif; ?>
	<?php if($tableItem['copy'] == 1): ?>
	<a href="<?php echo e(asset('clone/'.$tableItem['name'].'/'.$data->id.''.@$param_action)); ?>" class="table-btn mr-2 mb-2" title="Sao chép <?php echo e($tableItem['note']); ?>">
		<i class="fa fa-clone fs-14" aria-hidden="true"></i>
	</a>	
	<?php endif; ?>
	<?php if($tableItem['remove'] == 1): ?>
		<button type="button" title="Xóa <?php echo e($tableItem['note']); ?>" class="btn btn-primary mb-2 table-btn delete_btn bg_red" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo e($data->id); ?>">
			<i class="fa fa-times fs-14" aria-hidden="true"></i>
		</button>
	<?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/func_btn.blade.php ENDPATH**/ ?>