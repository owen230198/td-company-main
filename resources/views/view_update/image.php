<?php 
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:''; 
	}
	$media = $value!=null?getSrcMedia($value):array();
?>
<div class="img_show">
	<input type="hidden" name="<?= $name?>" value='<?= isset($value)?$value:''; ?>' class = "input_<?= $name ?>">
	<?php if (count($media)>0): ?>
	<img class="sys_img_action img_<?= $name ?>" src="<?= $media['src'] ?>" alt="<?= $media['alt'] ?>" title = "<?= $media['title'] ?>" caption = "<?= $media['caption'] ?>">
	<?php else: ?>
	<img class="sys_img_action img_<?= $name ?>" src="frontend/base/images/default.webp">	
	<?php endif ?>
	<button data-name="<?= $name?>" type="button" class="btn btn-primary brown_btn img_brown_btn" data-toggle="modal" data-target="#mediaModal">
	  Chọn ảnh
	</button>
	<button class="remove_img_btn btn btn-default">
		Xóa Ảnh	
	</button>
</div>