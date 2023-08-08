<div class="checkbox_module d-flex align-items-center">
	<input type="hidden" name="{{ $name }}" value = "{{ @$value }}" class="change_submit {{ @$attr['inject_class'] }}" {{ @$attr['inject_attr'] }}>
	<input type="checkbox" name="" class="toggle" {{ @$value == 1 ? 'checked' : '' }}/>
</div>