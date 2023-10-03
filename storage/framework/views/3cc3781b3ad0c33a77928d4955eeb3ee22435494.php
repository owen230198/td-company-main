<div class="base_table_form_search">
  <form action="<?php echo e(asset('search-table/'.$tableItem['name'])); ?>" method="GET" class="mb-0" id="form-search">
    <?php if(!empty($param_default)): ?>
        <input type="hidden" name="default_data" value='<?php echo e($param_default); ?>'>
    <?php endif; ?>
    <?php if(!empty($nosidebar)): ?>
        <input type="hidden" name="nosidebar" value = '1'>
    <?php endif; ?>
    <?php
      $data_search = @$data_search?$data_search:array()
    ?>
    <?php $__currentLoopData = $field_searchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(@$field['type'] == 'group'): ?>
          <?php
              $type = !empty($field['type']) ? $field['type'] : 'text';
              $field['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
              $field['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
          ?>
          <?php echo $__env->make('view_search.'.$type, $field, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
        <?php else: ?>
          <?php echo $__env->make('view_search.view', ['field' => $field], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </form>
</div><?php /**PATH /home/dell/Desktop/code/td-company-app/resources/views/table/form_search.blade.php ENDPATH**/ ?>