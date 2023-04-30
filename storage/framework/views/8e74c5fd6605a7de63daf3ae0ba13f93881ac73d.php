<?php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_query = @$select_data['field_query'];
    $childs = \DB::table($select_data['table'])->where(['act' => 1, $field_query => $obj_id])->get($field_title);
?>
<?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<p class="color_main bg_eb px-3 py-1 radius_5 mb-2 text-center linking_table">
	<?php echo e($child->{$field_title}); ?>

</p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_table/child_linking.blade.php ENDPATH**/ ?>