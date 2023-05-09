
<?php $__env->startSection('content'); ?>
	<?php echo e(getBreadcrumb($tableItem['name'], 0, $tableItem['note'])); ?>

	<div class="dashborad_content pt-3 position-relative">
	  <form action="do-config-data/<?php echo e($tableItem['name']); ?>" method="POST" class="adminAjaxForm" enctype="multipart/form-data" data-table-name="no_reload">
	    <?php echo csrf_field(); ?>
	    <ul class="nav nav-tabs" id="myTab" role="tablist">
	      <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		      <li class="nav-item">
		        <a class="nav-link <?php echo e($key==0?'active':''); ?>" id="<?php echo e($region['id']); ?>-tab" data-toggle="tab" href="#<?php echo e($region['id']); ?>" role="tab" aria-controls="<?php echo e($region['id']); ?>" aria-selected="true"><?php echo e($region['name']); ?></a>
		      </li>
	      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    </ul>
	    <div class="tab-content px-3 py-4 bg_white content_form" id="myTabContent">
	      <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $c_region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	      	<div class="tab-pane fade <?php echo e($key==0?'show active':''); ?>" id="<?php echo e($c_region['id']); ?>" role="tabpanel" aria-labelledby="<?php echo e($c_region['id']); ?>-tab">
		        <?php $__currentLoopData = $data_tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        <?php
		        	$field = (array)$field;
		        ?>
			        <?php if($field['region']==$c_region['id']): ?>
				        <div class="form-group d-flex mb-4 pb-4 border_bot_eb">
				          <label class="mb-0 mr-3 min_210 fs-13 text-capitalize"><?php echo e($field['note']); ?></label>
				          <?php echo $__env->make('view_update.'.$field['view_type'].'',['config'=>1, 'config_id'=>$field['id'], 'config_value'=>$field['value']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				        </div>
			        <?php endif; ?>
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	      	</div>
	      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    </div>
	    <div class="group_btn_action_form">
	      <button type="submit" class="station-richmenu-main-btn-area">
	        <i class="fa fa-check mr-2 fs-15" aria-hidden="true"></i>Hoàn tất
	      </button>
	      <a href="<?php echo e(url('')); ?>" class="station-richmenu-main-btn-area mx-2">
	        <i class="fa fa-chevron-left mr-2 fs-15" aria-hidden="true"></i>Trở về
	      </a>
	      <a href="<?php echo e(url('')); ?>" class="station-richmenu-main-btn-area">
	        <i class="fa fa-times mr-2 fs-15" aria-hidden="true"></i>Hủy
	      </a>
	    </div>
	  </form>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/table/configs.blade.php ENDPATH**/ ?>