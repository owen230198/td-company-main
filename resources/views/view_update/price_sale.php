<?php 
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = isset($data[$name])?$data[$name]:'';
	}
	$arr_value = json_decode($value); 
?>
<style type="text/css">
	.remove_price_sale{
		position: absolute;
		right: -5px;
		top: -5px;
	}
</style>
<input type="hidden" class="form-control" name="<?= $name ?>" value="<?= $value ?>">
<div class="json_price p-2 radius_5 bg_eb">
	<div class="list_price_json">
		<?php if ($arr_value==null): ?>
		<div class="mb-2 p-3 border_bot_white item_json_price position-relative">
			<span class="remove_price_sale color_red">
				<i class="fa fa-times mr-2 fs-16" aria-hidden="true"></i>
			</span>
			<div class="form-group d-flex align-items-center">
				<label class="mr-2 fs-13 mb-0 min_100">Số lượng</label>
				<input type="number" class="form-control sale_qty input_change">
			</div>
			<div class="form-group d-flex align-items-center mb-0">
				<label class="mr-2 fs-13 mb-0 min_100">Giá</label>
				<input type="number" class="form-control sale_price input_change">
			</div>	
		</div>
		<?php else: ?>
		<?php foreach ($arr_value as $item): ?>
		<div class="mb-2 p-3 border_bot_white item_json_price position-relative">
			<span class="remove_price_sale color_red">
				<i class="fa fa-times mr-2 fs-16" aria-hidden="true"></i>
			</span>
			<div class="form-group d-flex align-items-center">
				<label class="mr-2 fs-13 mb-0 min_100">Số lượng</label>
				<input type="number" value="<?= $item->sale_qty ?>" class="form-control sale_qty input_change">
			</div>
			<div class="form-group d-flex align-items-center mb-0">
				<label class="mr-2 fs-13 mb-0 min_100">Giá</label>
				<input type="number" value="<?= $item->sale_price ?>" class="form-control sale_price input_change">
			</div>	
		</div>	
		<?php endforeach ?>
		<?php endif ?>
	</div>
	<div class="text-center pt-2">
		<button onclick="add_<?= $name ?>(this);return false;" type="button" class="station-richmenu-main-btn-area py-1 px-2 height_auto add_json_price">
	        <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i>Thêm
	     </button>
	</div>			
</div>

<script type="text/javascript">
	function add_<?= $name ?>(_this)
	{
		var parent = $(_this).closest('.json_price');
		var item = parent.find('.item_json_price');
		var tempItem = item.first();
		var clone = tempItem.clone();
		clone.find('input').val('');
		parent.find('.list_price_json').append(clone);
		toJson<?= $name ?>();
	}

	$(document).on('input', '.item_json_price .input_change', function(event) {
	event.preventDefault();
		toJson<?= $name ?>()
	});

	$(document).on('click', '.remove_price_sale', function(event) {
	event.preventDefault();
		$(this).parent().remove();
		toJson<?= $name ?>();	
	});

	function toJson<?= $name ?>()
	{
		var arr = [];
		$('.item_json_price').each(function(){
			var sale_qty = $(this).find('.sale_qty').val();
			var sale_price = $(this).find('.sale_price').val();
			arr.push({
		        sale_qty: sale_qty,
		        sale_price: sale_price
		    });
		});
		var jsonString = JSON.stringify(arr);
		$('input[name=<?= $name ?>]').val(jsonString);
	}	
</script>