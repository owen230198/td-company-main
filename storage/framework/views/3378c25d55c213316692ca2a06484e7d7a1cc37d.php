<?php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $url = asset('get-data-json-linking?table='.$select_data['table']);
    if (!empty($select_data['where'])) {
        foreach ($select_data['where'] as $key => $val) {
            $url .= '&'.$key.'='.$val;
        }
    }
    if (!empty($value)) {
        $data_id = $value;
        $data_label = getFieldDataById('name', $select_data['table'], $value);
    }
?>
<select name="<?php echo e(@$field['table_map']=='orders'?'order['.$name.']':$name); ?>" 
class="form-control<?php echo e(@$select_config['search'] == 1 ? ' select_ajax' : ''); ?>

<?php echo e(@$attr['inject_class'] ? ' '.$attr['inject_class'] : ''); ?>" name="<?php echo e($name); ?>"
data-url="<?php echo e($url); ?>" data-id="<?php echo e(@$data_id); ?>", data-label = "<?php echo e(@$data_label); ?>">
</select><?php /**PATH C:\xampp\htdocs\td-company-app\resources\views/view_update/linking.blade.php ENDPATH**/ ?>