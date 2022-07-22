@php
	$default_data = json_decode($field['default_data'], true);
	$parent = $default_data['data'];
	$configs = $default_data['config'];
	$list_option = $parent['table']!=null?getOptionByClass($parent['table']):$parent['option'];
	$list_option = $parent['table']!=null&&@$parent['recursive']?recursive($list_option, 0, 0):$list_option;
	if (@$config&&$config==1) {
		$name = $config_id;
		$value = $config_value;	
	}else{
		$name = @$field['name']?$field['name']:'';
		$value = @$data[$name]?$data[$name]:0 ;
	}
@endphp
<div class="d-flex align-items-center w-100">
	<select name="{{ $name }}" class="form-control {{ @$configs['searchbox']?'select_config':'' }}">
		@if ($name=='customer_id')
			<option value="0">Khách hàng mới</option>
		@else
			<option value="0">Không xác định</option>
		@endif
		@foreach ($list_option as $key => $option)
			@if ($parent['table']!=null)
	    		<option value="{{ $option['id'] }}" {{ $value==$option['id']?'selected':'' }}>
	    			{{ str_repeat('_', @$option['level']?$option['level']:0).''.$option['name'] }}
	    		</option>
	    	@else
				<option value="{{ $key }}" {{ $value==$key?'selected':'' }}>
					{{ $option }}
				</option>
			@endif
		@endforeach
	</select>
</div>