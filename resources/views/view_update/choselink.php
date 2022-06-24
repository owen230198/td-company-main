<?php 
	$list_table = new \App\Models\NTable;
	$table_has_slug = $list_table->where('chose_link', 1)->findAll();
	$admin_service = new  Modules\Admin\Service\AdminService;
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:''; 
	}
?>
<div class="chose_link_section w-100">
	<input class="form-control mb-3" type="text" name="<?= $name ?>" value="<?= isset($value)?$value:'' ?>">
	<div class="list_select_link list_choose_link_<?= $name ?> row row-7">
		<?php foreach ($table_has_slug as $item): ?>
			<?php
				$data_list_option = $admin_service->getListDataTable($item['name'], 3000, 0, 'name', 'asc', array(array('key'=>'act', 'value'=>1))); 
				$list_option = $data_list_option['data']; 
			?>
			<div class="col-4 mb-3">
				<label class="form-group d-flex item_slect_link mr-4">
					<p class="table_name mr-2 min_100"><?= $item['note'] ?></p>
					<select class="form-control select_link_<?= $name ?> action_view min_150">
						<option value="">Chọn Link</option>	
						<?php foreach ($list_option as $item_option): ?>
						<option value="<?= $item_option['slug'] ?>"><?= $item_option['name'] ?></option>	
						<?php endforeach ?>
					</select>		
				</label>
			</div>
		<?php endforeach ?>	
	</div>
</div>

<script type="text/javascript">
	$(function() {
		$('.select_link_<?= $name ?>').change(function() {
			slug = $(this).val();
			$('input[name=<?= $name ?>]').val(slug);
		});
	});
</script>