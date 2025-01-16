<?php
	$default_data = json_decode($field['default_data'], true);
	$parent = $default_data['data'];
	$configs = $default_data['config'];
	$list_option = $parent['table']!=null?getOptionByTable($parent['table'], $parent['select']):$parent['option'];
	$list_option = $parent['table']!=null?recursive($list_option, 0, 0):$list_option;
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:0 ;
	}
?>
<div class="d-flex align-items-center w-100">
	<label class="mr-2 d-block mb-0 min_100"><?= $field['note'] ?>:</label>
	<select name="<?= $name ?>" class="form-control">
		<option value="0">Chọn</option>
		<?php foreach ($list_option as $option): ?>
			<?php if ($parent['table']!=null): ?>
	    		<option value="<?= $option['id'] ?>" <?= $value==$option['id']?'selected':'' ?>>
	    			<?= str_repeat('_', $option['level']).''.$option['name'] ?>
	    		</option>
			<?php else: ?>
				<option value="<?= $key ?>" <?= $value==$option['id']?'selected':'' ?>>
					<?= $option['name'] ?>
				</option>
			<?php endif ?>	
		<?php endforeach ?>
	</select>
</div>