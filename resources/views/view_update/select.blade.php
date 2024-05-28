@php
	$select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
	$list_options = !empty($select_data['options']) ? $select_data['options'] : [];
	$multiple = @$select_config['multiple'] == 1;
@endphp
<div class="d-flex align-items-center w-100">
	<select name="{{ $name }}" class="form-control 
	{{ $multiple ? 'length_input muptiple_select' : '' }}
	{{ @$select_config['searchbox'] == 1 ? ' select_config' : '' }}
	{{ @$attr['inject_class'] ? ' '.$attr['inject_class'] : '' }}
	{{ @$attr['class_on_search'] ? ' '.$attr['class_on_search'] : '' }}" 
	{{ @$attr['disable_field'] == 1 ? 'disabled' : '' }}
	{{ @$attr['readonly'] == 1 ? 'readonly' : '' }}
	{{ @$attr['placeholder'] ? 'placehoder='.$attr['placeholder'] : '' }} 
	{{ @$attr['inject_attr'] ?? '' }}
	{{ $multiple ? 'multiple' : '' }}>
		@foreach ($list_options as $key => $option)
			<option value="{{ $key }}" {{ @$value == $key ? 'selected' : '' }}>
				{{ $option }}
			</option>
		@endforeach
	</select>
</div>