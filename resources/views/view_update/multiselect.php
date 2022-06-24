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
		$value = @$data[$name]?$data[$name]:'' ;
	}
?>
<div class="multi_select_view" data-name="<?= $name ?>">
	<input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
	<?php $arr_value = $value!=''?explode(',', $value):array() ?>
	<?php foreach ($list_option as $item): ?>
	<label class="d-flex align-items-center multi_label list_multil_<?= $name ?>">
		<?= str_repeat('___', $item['level']) ?>
		<input type="checkbox" value="<?= $item['id'] ?>" class="mr-2 multi_check" <?= in_array($item['id'], $arr_value)?'checked':'' ?>>
		<?= $item['name'] ?>
	</label>		
	<?php endforeach ?>	
</div>

<script type="text/javascript">
	$(function() {
		$('body').on('click', '.list_multil_<?= $name ?> input', function(event) {
			var arr = $('.list_multil_<?= $name ?> input:checked');
			var str = "";
			for (var i = 0; i < arr.length; i++) {
				var item = arr[i];
				str += $(item).val();
				if(i<arr.length-1){
					str+=",";
				}
			};
			$('input[name=<?= $name ?>]').val(str);
		});
	});
</script>