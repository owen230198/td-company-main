<?php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_query = @$select_data['field_query'];
    $field_linking = !empty($select_data['field_linking']) ? $select_data['field_linking'] : 'id';
    $childs = \DB::table($select_data['table'])->where(['act' => 1, $field_query => $data->{$field_linking}])->get();
    $child_field = \DB::table('n_detail_tables')->where(['act' => 1, 'table_map' => $select_data['table'], 'name' => $field_title])->first();
?>
<?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if(!empty($child_field)): ?>
        <?php
            $arr = (array) $child_field;
            $arr['obj_id'] = $child->id;
            $arr['value'] = @$child->{$field_title};
            $arr['other_data'] = !empty($child_field->other_data) ? json_decode($child_field->other_data, true) : [];
        ?>
        <div class="mb-1">
            <?php echo $__env->make('view_table.'.$child_field->type, $arr, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php else: ?>
        <p class="color_main radius_5 mb-2 text-center linking_table">
            <?php echo e($child->{$field_title}); ?>

        </p>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\td-app\td-company-app\resources\views/view_table/child_linking.blade.php ENDPATH**/ ?>