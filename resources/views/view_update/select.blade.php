<?php
	$default_data = json_decode($field['default_data']);
	$name = @$field['name']?$field['name']:'';
	$value = @$data[$name]?$data[$name]:0 ;
	if (@$default_data->model) {
		$models = getModelByClass($default_data->model);
		$list_option = $models->select('_id', 'name')->get();	
	}else {
		$list_option = $default_data->option;
	}
?>
<div class="d-flex align-items-center w-100">
	<select name="<?= $name ?>" class="form-control">
		<option value="0">Không xác định</option>
		 @foreach ($list_option as $key => $option)
		 	@if (@$default_data->model)
	 		<option value="{{ $option['id'] }}" {{ $value==$option['_id']?'selected':'' }}>
    			{{ $option['name'] }}
    		</option>
			@else
			<option value="{{ $key }}" {{ $value==$key?'selected':'' }}>
				{{ $option }}
			</option>
		 	@endif
		 @endforeach
	</select>
</div>