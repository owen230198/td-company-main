<div class="checkbox_module d-flex align-items-center">
	<input type="hidden" name="{{ $name }}" value = "{{ $value }}">
	<input type="checkbox" name="" class="toggle change_submit" {{ $value==1?'checked':'' }}/>
</div>