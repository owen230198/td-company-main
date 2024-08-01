@php
    $check_disabled = @$attr['type_input'] == 'password' && @$value != '';
@endphp
<input type="{{ @$attr['type_input'] ?? 'text' }}" 
class="form-control{{ @$attr['inject_class'] ? ' '.$attr['inject_class'] : '' }}" name="{{ $name }}" value="{{ @$value }}"
{{ @$attr['disable_field'] == 1 || ($check_disabled) ? 'disabled' : '' }}
{{ @$attr['readonly'] == 1 || (@$attr['readonly'] == 2 && !empty($value)) ? 'readonly' : '' }}
{{ @$attr['type_input'] == 'number' ? 'min=0 step=any' : '' }} 
placeholder="{{ @$attr['placeholder'] ?? 'Nhập '.mb_strtolower($note) }}">
@if ($check_disabled)
    <button type="button" class="p-2 bg_green color_white box_shadow_3 ml-2 __pass_change"><i class="fa fa-pencil-square-o mr-1" aria-hidden="true"></i></button>    
@endif