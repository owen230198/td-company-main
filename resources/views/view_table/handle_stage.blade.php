@php
    $data_stage = !empty($value) ? json_decode($value, true) : [];
    $icon = getIconByStageHandle(@$data_stage['act']);
@endphp
<div class="handle_stage_item color_white bg_{{ $icon['color'] }} box_shadow_3">
    <i class="fa fa-{{ $icon['icon'] }} mr-1" aria-hidden="true"></i>    
</div>  