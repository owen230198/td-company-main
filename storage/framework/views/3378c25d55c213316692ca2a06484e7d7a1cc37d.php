<?php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_value = @$select_data['field_value'] ?? 'id';
    $table_linking = getTableLinkingWithData([], $select_data['table'])
?>

<?php if(@$select_config['search'] == 1): ?>
    <?php
        $url = asset('get-data-json-linking?table='.$table_linking.'&field_search='.$field_title);
        if (!empty($select_data['where'])) {
            foreach ($select_data['where'] as $key => $val) {
                $url .= '&'.$key.'='.$val;
            }
        }
        if (!empty($select_data['where_default'])) {
            foreach ($select_data['where_default'] as $key => $val) {
                if (!empty($default_field[$val])) {
                    $url .= '&'.$key.'='.$default_field[$val];
                }
            }
        }
        if (!empty($value)) {
            $data_id = $value;
            $data_label = getFieldDataById($field_title, $table_linking, [$field_value => $value]);
        }
    ?>
    <select name="<?php echo e($name); ?>" class="form-control select_ajax <?php echo e(@$attr['inject_class'] ? ' '.$attr['inject_class'] : ''); ?>"
    data-url="<?php echo e($url); ?>" data-id="<?php echo e(@$data_id); ?>", data-label = "<?php echo e(@$data_label); ?>" <?php echo e(@$attr['inject_attr'] ?? ''); ?> 
    <?php echo e(@$attr['disable_field'] == 1 ? 'disabled' : ''); ?>

    <?php echo e(@$attr['readonly'] == 1 ? 'readonly' : ''); ?>>
    </select>
<?php else: ?>
    <?php
        $list_options = getOptionDataField($select_data);
    ?>
    <select name="<?php echo e($name); ?>" 
            class="form-control <?php echo e(@$select_config['searchbox'] == 1 ? ' select_config' : ''); ?> <?php echo e(@$attr['inject_class']); ?>" 
            <?php echo e(@$attr['inject_attr'] ?? ''); ?>

            <?php echo e(@$attr['disable_field'] == 1 ? 'disabled' : ''); ?>

            <?php echo e(@$attr['readonly'] == 1 ? 'readonly' : ''); ?>

            >
        <option value="0">Chọn</option>
        <?php $__currentLoopData = $list_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($item->$field_value); ?>" <?php echo e($item->$field_value == @$value ? 'selected' : ''); ?>>
                <?php echo e($item->$field_title); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/linking.blade.php ENDPATH**/ ?>