<?php 
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:''; 
	}
	$arr_photo = @$value?json_decode($value):array();
?>
<div class="photo_view_edit">
	<div class="img_show photo_gallery">
		<input type="hidden" name="<?= $name?>" value='<?= $value ?>' class = "input_<?= $name ?>">		
		<div class="list_gallery list_galeey_<?= $name ?>">
		<?php if ($arr_photo != null && count($arr_photo)>0): ?>
			<?php foreach ($arr_photo as $item): ?>
				<div class="media_img c-img photo_item">
					<i class="remove_photo_gall fa fa-times"></i>
		        	<?= generateImage($item, '200x0') ?>
		     	</div>			
			<?php endforeach ?>		
		<?php endif ?>	
		</div>
	</div>
	<button data-name="<?= $name?>" type="button" class="btn btn-primary brown_btn photo_brown_btn" data-toggle="modal" data-target="#mediaModal">
	  Thêm ảnh
	</button>
	<button class="btn btn-default apply_photo" data-name="<?= $name ?>">Apply Photo Gallery</button>
</div>