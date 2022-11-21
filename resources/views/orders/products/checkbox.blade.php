
<div class="checkbox_module d-flex align-items-center">
    <input type="hidden" name="{{ $name }}" value = "{{ (int)@$value }}">
    <input type="checkbox" name="" class="toggle" {{ (int)@$value==1?'checked':'' }}/>
</div>