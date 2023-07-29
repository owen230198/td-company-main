<div class="checkbox_module d-flex align-items-center">
	<input type="hidden" name="{{ $name }}" value = "{{ @$value }}" class="{{ @$attr['inject_class'] }}">
	<input type="checkbox" name="" class="toggle" {{ @$value == 1 ? 'checked' : '' }}/>
</div>