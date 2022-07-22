@php
	$default_data = json_decode($field['default_data'], true);
	$parent = $default_data['data'];
	$config = $default_data['config'];
	$list_option = $parent['table']!=null?getOptionByClass($parent['table']):$parent['option'];
	$list_option = $parent['table']!=null&&@$parent['recursive']?recursive($list_option, 0, 0):$list_option;
	$select_search = @$data_search[$id]?$data_search[$id]:0;
@endphp
<div class="d-flex align-items-center w-100">
	<label class="mr-2 d-block mb-0 min_100">{{ $field['note'] }}:</label>
	<select name="{{ $field['id'] }}" class="form-control {{ @$config['searchbox']?'select_config':'' }}">
		<option value="">Không xác định</option>
		@foreach ($list_option as $key => $option)
			@if ($parent['table']!=null)
				<option value="{{ $option['id'] }}" {{ $select_search==$option['id']?'selected':'' }}>
					{{ @$option['level']?str_repeat('_', $option['level']).''.$option['name']:$option['name'] }}
				</option>
			@else
				<option value="{{ $key }}" {{ $select_search==$key?'selected':'' }}>
					{{ $option }}
				</option>
			@endif
		@endforeach
	</select>
</div>