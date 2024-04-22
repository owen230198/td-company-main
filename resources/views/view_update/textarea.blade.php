<textarea class="form-control{{ @$attr['inject_class'] ? ' '.$attr['inject_class'] : '' }}" 
name="{{ $name }}" {{ @$attr['disable_field'] == 1 ? 'disabled' : '' }}>{{ @$value }}</textarea>