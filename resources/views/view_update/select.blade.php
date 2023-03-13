@php
	$select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
	$list_options = !empty($select_data['options']) ? $select_data['options'] : [];
@endphp
<div class="d-flex align-items-center w-100">
	<select name="{{ $name }}" class="form-control{{ @$configs['searchbox']?' select_config' : '' }}
	{{ @$attr['inject_class'] ? ' '.$attr['inject_class'] : '' }}">
		@foreach ($list_options as $key => $option)
			<option value="{{ $key }}" {{ @$value == $key ? 'selected' : '' }}>
				{{ $option }}
			</option>
		@endforeach
	</select>
</div>